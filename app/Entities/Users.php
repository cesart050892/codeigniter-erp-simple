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

        $new = $this->storeImage($image);

        if ($this->photo !== USERSIMG.'profile_default.jpg') {
            $this->deleteImage();
        }

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

    private function deleteImage(): bool
    {
        $file    = USERSIMG.'profile_default.jpg';
        if (!file_exists($file)) 
            return false;
        return unlink($file);
    }
}