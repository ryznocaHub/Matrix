<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'staffName' => 'John Doe',
                'email'     => 'johndoe@gmail.com',
                'role'      => '1',
                'password'  => bcrypt('johndoe'),
                'staffId'   => 'MTX-001',
                'departureName' => 'System Development',
                'position'  => 'Application Developer',
                'currency'  => 'IDR/USD',
                'salary'    => 4500000,
                'resume'    => 'ss',
                'phoneNumber' => '087770562940'
            ]
        );
    }
}
