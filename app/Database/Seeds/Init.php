<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Init extends Seeder
{
	public function run()
	{
		//
		$this->call('App\Database\Seeds\Data\Settings');
		$this->call('App\Database\Seeds\Data\Companies');
		$this->call('App\Database\Seeds\Data\CompaniesSettings');
		$this->call('App\Database\Seeds\Data\Permissions');
		$this->call('App\Database\Seeds\Data\Sections');
		$this->call('App\Database\Seeds\Data\Rols');
		$this->call('App\Database\Seeds\Data\PivotRols');
		$this->call('App\Database\Seeds\Data\Auth');
		$this->call('App\Database\Seeds\Data\Users');
		//$this->call('App\Database\Seeds\Data\Clients');
		//$this->call('App\Database\Seeds\Data\Suppliers');
		//$this->call('App\Database\Seeds\Data\Products');
	}
}
