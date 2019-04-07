<?php

namespace Modules\Course\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CoursePermissionsSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
//        Permission::create([
//            'name' => 'create_course',
//            'guard_name' => 'web'
//        ]);
//        Permission::create([
//            'name' => 'edit_course',
//            'guard_name' => 'web'
//        ]);
//        Permission::create([
//            'name' => 'delete_course',
//            'guard_name' => 'web'
//        ]);
        DB::table('role_has_permissions')->insert([
            'role_id' => Role::findOrFail('admin')->first()->id,
            'permission_id' => Permission::findOrFail('create_course')->first()->id
        ]);
        DB::table('role_has_permissions')->insert([
            'role_id' => Role::findOrFail('admin')->first()->id,
            'permission_id' => Permission::findOrFail('edit_course')->first()->id
        ]);
        DB::table('role_has_permissions')->insert([
            'role_id' => Role::findOrFail('admin')->first()->id,
            'permission_id' => Permission::findOrFail('delete_course')->first()->id
        ]);
    }
}
