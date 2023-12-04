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
        //一個のデータのみの記述
        // DB::table('users')->insert([
        //     'username' => Str::random(5),
        //     'mail' => Str::random(10).'@gmail.com',
        //     'password' => bcrypt('secret'),
        //     'created_at' => new DateTime(),
        //     'updated_at' => new DateTime(),
        // ]);

        //複数データはfor文で記述
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'username'       => 'testuser' .$i,
                'mail'           => 'testuser'.$i.'@gmail.com',
                'password'       => Hash::make('testtest'),
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }

}