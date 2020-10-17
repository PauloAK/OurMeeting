<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin OurMeeting',
            'email' => 'admin@ourmeeting.com',
            'phone' => '(51) 9 9999-9999',
            'password' => Hash::make('admin123'),
            'admin' => true
        ]);
    }
}
