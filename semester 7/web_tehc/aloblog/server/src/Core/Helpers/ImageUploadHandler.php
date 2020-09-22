<?php

namespace App\Core\Helpers;

class ImageUploadHandler
{
    public static function persist(string $key, string $dir)
    {
        // https://www.php.net/manual/en/features.file-upload.php#114004
        try {
            if (
                !isset($_FILES[$key]['error']) ||
                is_array($_FILES[$key]['error'])
            ) {
                throw new \RuntimeException('Invalid parameters.');
            }

            switch ($_FILES[$key]['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new \RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new \RuntimeException('Exceeded filesize limit.');
                default:
                    throw new \RuntimeException('Unknown errors.');
            }

            if ($_FILES[$key]['size'] > 1000000) {
                throw new \RuntimeException('Exceeded filesize limit.');
            }

            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES[$key]['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png'
                ),
                true
            )) {
                throw new \RuntimeException('Invalid file format.');
            }

            $file_hash = md5_file($_FILES[$key]['tmp_name']);
            if (!move_uploaded_file(
                $_FILES[$key]['tmp_name'],
                sprintf(
                    './uploads/img/%s/%s',
                    $dir,
                    $file_hash
                )
            )) {
                throw new \RuntimeException('Failed to move uploaded file.');
            }

            return $file_hash;
        } catch (\RuntimeException $e) {
            return ['errors' => [['property' => $key, 'message' => $e->getMessage()]]];
        }
    }
}
