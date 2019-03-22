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
            'name' => 'assign_user_status',
            'guard_name' => 'web'
        ]);


        // Module Permissions

        DB::table('permissions')->insert([
            0 => [
                'name' => 'activate_module',
                'guard_name' => 'web'
            ],
            1 => [
                'name' => 'deactivate_module',
                'guard_name' => 'web'
            ],
            2 => [
                'name' => '',
                'guard_name' => 'web'
            ]
        ]);

        // Institute Permissions

        DB::table('permissions')->insert([
            0 => [
                'name' => 'create_institute',
                'guard_name' => 'web'
            ],
            1 => [
                'name' => 'edit_institute',
                'guard_name' => 'web'
            ],
            2 => [
                'name' => 'delete_institute',
                'guard_name' => 'web'
            ],
            3 => [
                'name' => 'verify_institute',
                'guard_name' => 'web'
            ],
            4 =>[
                'name' => 'block_institute',
                'guard_name' => 'web'
            ],
            5 => [
                'name' => 'unblock_institute',
                'guard_name' => 'web'
            ]
        ]);

        // Teacher Permissions

        DB::table('permissions')->insert([
            0 => [
                'name' => 'assign_teacher',
                'guard_name' => 'web'
            ],
            1 => [
                'name' => 'revoke_teacher',
                'guard_name' => 'web'
            ]
        ]);

        // Moderator Permissions

        DB::table('permissions')->insert([
            0 => [
                'name' => 'assign_moderator',
                'guard_name' => 'web'
            ],
            1 => [
                'name' => 'revoke_moderator',
                'guard_name' => 'web'
            ]
        ]);

        // Post Permissions

        DB::table('permissions')->insert([
            0 => [
                'name' => 'create_post',
                'guard_name' => 'web'
            ],
            1 => [
                'name' => 'edit_post',
                'guard_name' => 'web'
            ],
            2 => [
                'name' => 'delete_post',
                'guard_name' => 'web'
            ],
            3 => [
                'name' => 'block_post',
                'guard_name' => 'web'
            ],
            4 => [
                'name' => 'unblock_post',
                'guard_name' => 'web'
            ],
            5 => [
                'name' => 'view_post',
                'guard_name' => 'web'
            ]
        ]);

        // Role & Permission Permissions

        DB::table('permissions')->insert([
            0 => [
                'name' => 'assign_role',
                'guard_name' => 'web'
            ],
            1 => [
                'name' => 'revoke_role',
                'guard_name' => 'web'
            ],
            2 => [
                'name' => 'assign_permission',
                'guard_name' => 'web'
            ],
            3 => [
                'name' => 'revoke_permission',
                'guard_name' => 'web'
            ]
        ]);

    }
}
