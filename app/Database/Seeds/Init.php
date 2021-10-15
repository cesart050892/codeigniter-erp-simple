<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Init extends Seeder
{
	public function run()
	{
		//
		$this->call('App\Database\Seeds\Data\Rols');
		$this->call('App\Database\Seeds\Data\Credentials');
		$this->call('App\Database\Seeds\Data\Users');
	}
}