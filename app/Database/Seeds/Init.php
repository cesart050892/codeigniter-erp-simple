<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Init extends Seeder
{
	public function run()
	{
		//
		$this->call('App\Database\Seeds\Data\Permissions');
		$this->call('App\Database\Seeds\Data\Sections');
		$this->call('App\Database\Seeds\Data\Rols');
		$this->call('App\Database\Seeds\Data\PivotRolsSectionsPermissions');
		$this->call('App\Database\Seeds\Data\Auth');
		$this->call('App\Database\Seeds\Data\Users');
	}
}