<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'name' => 'college admin',
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'name' => 'teacher',
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'name' => 'student',
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'name' => 'moderator',
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'name' => 'staff',
            'guard_name' => 'web'
        ]);
    }
    
}
