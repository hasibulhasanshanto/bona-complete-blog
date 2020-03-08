<?php

use Illuminate\Support\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
           'role_id' => '1',
           'name' => 'Hasibul Hasan',
           'username' => 'shanto',
           'email' => 'admin@admin.com',
           'password' => bcrypt('12345678'), 
           'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
           
        ]);

        DB::table('users')->insert([
           'role_id' => '2',
           'name' => 'Nayeem Islam',
           'username' => 'nayeem',
           'email' => 'author@author.com',
           'password' => bcrypt('12345678'), 
           'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
           
        ]);

        DB::table('users')->insert([
            'role_id' => '3',
            'name' => 'Maruf Hasan',
            'username' => 'maruf',
            'email' => 'user@user.com',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
    }
}
