<?php

namespace App\Models;

use App\Models\Model;
use App\Core\DBH;
use App\Core\Enums\UserStateEnum;
use PDOException;

use function Latitude\QueryBuilder\field;

class User extends Model
{
    const TABLE = 'users';
    const SCHEMA = <<<'JSON'
    {
        "username": {
            "type": "string",
            "minLength": 3,
            "maxLength": 24
        },
        "password": {
            "type": "string",
            "minLength": 8,
            "maxLength": 128
        },
        "email": {
            "type": "string",
            "format": "email"
        },
        "state": {
            "type": {"$ref": "#/definitions/userStateEnum"}
        }
    }
    JSON;

    public function get_all_active(?int $cursor, int $limit, $order = "desc")
    {
        $query = self::QueryFactory()
            ->select('id', 'username', 'email', 'avatar', 'role')
            ->from(self::TABLE)
            ->where(field('state')
                ->eq(UserStateEnum::ACTIVE()->getValue()))
            ->orderBy('id', $order)
            ->limit($limit);

        if (!is_null($cursor)) {
            $query = $order === 'desc'
                ? $query->where(field('id')->lt($cursor))
                : $query->where(field('id')->gt($cursor));
        }

        $query = $query->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());

        return $stmt->fetchAll();
    }

    public function insert(object $values)
    {
        $changeset = $this->changeset($values)
            ->required("username", "password", "email")
            ->add_definition(UserStateEnum::get_json_def())
            ->validate();

        if ($changeset->isValid() === false) {
            return ["errors" => $changeset->getErrors()];
        }

        $values = $this->set_password($values);

        $query = self::QueryFactory()->insert(self::TABLE, (array) $values)->compile();

        $stmt = DBH::connect()->prepare($query->sql());

        try {
            return $stmt->execute($query->params());
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                if (preg_match("/key 'users.(?P<field>.+)'/", $e->getMessage(), $match)) {
                    return ["errors" => [[
                        'property' => $match["field"],
                        'message' => sprintf("%s already exists", $match["field"])
                    ]]];
                }
            }
        }
    }

    private function set_password($values)
    {
        $values->password_hash = password_hash(
            $values->password,
            PASSWORD_DEFAULT,
        );
        unset($values->password);
        return $values;
    }

    public function delete(int $id)
    {
        $query = self::QueryFactory()
            ->delete(self::TABLE)
            ->where(field("id")->eq($id))
            ->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        return $stmt->execute($query->params());
    }

    public function update(int $id, object $values)
    {
        // TODO: add cast
        $changeset = $this->changeset($values)
            ->add_definition(UserStateEnum::get_json_def())
            ->validate();

        if ($changeset->isValid() === false) {
            return $changeset->getErrors();
        }

        $query = self::QueryFactory()
            ->update(self::TABLE, (array) $values)
            ->where(field('id')->eq($id))
            ->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        return $stmt->execute($query->params());
    }

    public function get_user_by_field($name, $value, $with_password = false)
    {
        $fields = ['id', 'username', 'email', 'avatar', 'role', 'state'];
        if ($with_password) array_push($fields, 'password_hash');

        $query = self::QueryFactory()
            ->select(...$fields)
            ->from(self::TABLE)
            ->where(field($name)->eq($value))
            ->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());

        return $stmt->fetch();
    }
}
