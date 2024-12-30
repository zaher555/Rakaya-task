<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Create users
       $admin = User::create([
           'name' => 'admin',
           'email' => 'admin@example.com',
           'password' => bcrypt('admin123'),
           'role'=>'admin'
       ]);
   
       $user = User::create([
           'name' => 'user',
           'email' => 'user@example.com',
           'password' => bcrypt('user123'),
       ]);
       $user->book()->create([
        'title'=>'book1',
        'authour'=>'zaher',
        'availability_status'=>0
       ]);
}
}