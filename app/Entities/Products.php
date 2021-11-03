<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\HTTP\Files\UploadedFile;

class Products extends Entity
{
    protected $attributes = [
        'id' => null,
        'photo' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    protected $datamap = [];
    protected $dates   = [];
    protected $casts   = [
        'price'          => 'double',
        'cost'           => 'double',
    ];

    public function getPhoto()
    {
        if (isset($this->attributes['photo']))
            $this->attributes['photo'] = "uploads/img/products/" . $this->attributes['photo'];
        return $this->attributes['photo'];
    }

    public function saveImage(UploadedFile $image)
    {
        $new = $this->storeImage($image);
        log_message('info', "File created: " . $new . "For this Product: " . $this->name);
        $file = $this->photo;
        if ($file !== null)
            if ($file !== 'default.png')
                if (!$this->deleteImage($file))
                    log_message('error', 'Image was not delete');
        return $new;
    }

    private function storeImage(UploadedFile $image)
    {
        $new = $image->getRandomName();
        if (!$image->isValid() || $image->hasMoved())
            return false;
        try {
            $image->move(APPIMGS . "products/", $new);;
        } catch (\Throwable $th) {
            return false;
        }
        return $new;
    }

    private function deleteImage(string $file): bool
    {
        $path    = WRITEPATH . $file;
        if (!file_exists($path))
            return false;
        return unlink($path);
    }
}
