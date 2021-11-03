<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\HTTP\Files\UploadedFile;

class Users extends Entity
{
    protected $attributes = [
        'id' => null,
        'name' => null,
        'surname' => null,
        'address' => null,
        'photo' => null,
        'phone' => null,
        'fullname' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    protected $datamap = [];

    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts   = [];


    public function getPhoto()
    {
        if (isset($this->attributes['photo']))
            $this->attributes['photo'] = "uploads/img/users/" . $this->attributes['photo'];
        return $this->attributes['photo'];
    }

    public function saveProfileImage(UploadedFile $image)
    {
        $new = $this->storeImage($image);
        log_message('info',"File created: ".$new."For this User: ".$this->fullname);
        $file = $this->photo;
        if ($file !== 'profile_default.png')
            if(!$this->deleteImage($file))
                log_message(9,'Image was not delete');
        return $new;
    }

    private function storeImage(UploadedFile $image)
    {
        $new = $image->getRandomName();
        if (!$image->isValid() || $image->hasMoved())
            return false;
        try {
            $image->move(USERSIMG, $new);;
        } catch (\Throwable $th) {
            return false;
        }
        return $new;
    }

    private function deleteImage(string $file): bool
    {
        $path    = WRITEPATH.$file;
        if (!file_exists($path))
            return false;
        return unlink($path);
    }
}
