<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\HTTP\Files\UploadedFile;

class Users extends Entity
{
    protected $datamap = [];
    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts   = [];

    public function saveProfileImage(UploadedFile $image)
    {

        $newImage = $this->storeImage($image);

        if ($this->img !== '/img/default/profile.jpg') {
            $this->deleteImage();
        }

        return $newImage;
    }

    private function storeImage(UploadedFile $image)
    {

        $pathImage = "/img/users/{$this->nick}_{$image->getRandomName()}";

        if (!$image->isValid() || $image->hasMoved()) {
            return false;
        }

        try {
            $image->move(".", $pathImage);
        } catch (\Throwable $th) {
            return false;
        }

        return $pathImage;
    }

    private function deleteImage(): bool
    {

        $baseDir = realpath($_SERVER["DOCUMENT_ROOT"]);
        $file    = "{$baseDir}/{$this->img}";

        if (!file_exists($file)) {
            return false;
        }

        return unlink($file);
    }
}
