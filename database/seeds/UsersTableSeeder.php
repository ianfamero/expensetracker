<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ian Benedict Famero',
            'email' => 'ianfamero@gmail.com',
            'username' => 'ianfamero',
            'password' => bcrypt('goldfish1'),
            'savings_amount' => 0,
            'spendable_amount' => 0,
            'receivable_amount' => 0
        ]);
    }
}
