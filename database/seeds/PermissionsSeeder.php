<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User Permissions
        DB::table('permissions')->insert([
            'name' => 'create_user',
            'guard_name' => 'web'
        ]);

        DB::table('permissions')->insert([
            'name' => 'edit_user',
            'guard_name' => 'web'
        ]);

        DB::table('permissions')->insert([
            'name' => 'delete_user',
            'guard_name' => 'web'
        ]);

        DB::table('permissions')->insert([
            'name' => 'assign_role',
            'guard_name' => 'web'
        ]);

        DB::table('permissions')->insert([
            'name' => 'assign_status',
            'guard_name' => 'web'
        ]);

        // User Roles

        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        DB::table('roles')->insert([
            'name' => 'staff',
            'guard_name' => 'web'
        ]);

        DB::table('roles')->insert([
            'name' => 'student',
            'guard_name' => 'web'
        ]);


    }
}
