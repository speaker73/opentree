<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		 $this->call('CompanyTableSeeder');
	}


}
class CompanyTableSeeder extends Seeder {

	public function run()
	{
		DB::table('companies')->insert([
			'id' => 1,
			'name' => 'Company1',
			'amount' => 25,
			'total_amount' => 53,
			'parent' => 1
		]);
		DB::table('companies')->insert([
			'id' => 2,
			'name' => 'Company2',
			'amount' => 13,
			'total_amount' => 18,
			'parent' => 1
		]);
		DB::table('companies')->insert([
			'id' => 3,
			'name' => 'Company3',
			'amount' => 5,
			'total_amount' => 5,
			'parent' => 2
		]);
		DB::table('companies')->insert([
			'id' => 4,
			'name' => 'Company4',
			'amount' => 10,
			'total_amount' => 10,
			'parent' => 1
		]);
	}

}