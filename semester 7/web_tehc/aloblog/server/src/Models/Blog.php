<?php

namespace App\Models;

use App\Models\Model;
use App\Core\DBH;
use App\Core\Enums\BlogStateEnum;

use function Latitude\QueryBuilder\express;
use function Latitude\QueryBuilder\field;
use function Latitude\QueryBuilder\param;
use function Latitude\QueryBuilder\func;
use function Latitude\QueryBuilder\criteria;
use function Latitude\QueryBuilder\literal;

class Blog extends Model
{
    const TABLE = 'blogs';
    const SCHEMA = <<<'JSON'
    {
        "title": {
            "type": "string",
            "minLength": 8,
            "maxLength": 128
        },
        "content": {
            "type": "string",
            "minLength": 255,
            "maxLength": 65536
        },
        "thumbnail": {
            "type": "string",
            "format": "uuid"
        },
        "state":{
            "type": {
                "$ref": "#/definitions/blogStateEnum"
            }
        },
        "user_id": {
            "type": {
                "$ref": "#/definitions/naturalInt"
            }
        }
    }
    JSON;

    public function get_all_listed(?int $cursor, int $limit, string $order, ?string $q)
    {
        $query = self::QueryFactory()
            ->select()
            ->from(self::TABLE)
            ->where(field('state')
                ->eq(BlogStateEnum::LISTED()->getValue()))
            ->orderBy('id', $order)
            ->limit($limit);

        if (!is_null($cursor)) {
            $query = $order === 'desc'
                ? $query->where(field('id')->lt($cursor))
                : $query->where(field('id')->gt($cursor));
        }
        if (!is_null($q)) $query = $query->andWhere(criteria("MATCH (title,content) AGAINST (%s)", $q));

        $query = $query->compile();
        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());

        return $stmt->fetchAll();
    }

    public function get(int $id)
    {
        // NOTE: for OBE... raw sql :)
        $query = "SELECT * from %s WHERE id = :id";

        $stmt = DBH::connect()->prepare(sprintf($query, self::TABLE));
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();
    }

    public function insert(object $values)
    {
        $changeset = $this->changeset($values)
            ->add_definition(BlogStateEnum::get_json_def())
            ->required("content", "title", "user_id")
            ->validate();

        if ($changeset->isValid() === false) {
            return ["errors" => $changeset->getErrors()];
        }

        $word_per_minute = 275;
        $values->read_time = ceil(str_word_count($values->content) / $word_per_minute);

        $query = self::QueryFactory()->insert(self::TABLE, (array) $values)->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());
        return DBH::connect()->lastInsertId();
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
        $changeset = $this->changeset($values)->validate();

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
}
