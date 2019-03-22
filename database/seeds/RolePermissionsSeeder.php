<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_has_permissions')->insert($this->getAdminPermissionsSeederArray());
        DB::table('role_has_permissions')->insert($this->getModeratorPermissionsSeederArray());
        DB::table('role_has_permissions')->insert($this->getCollegeAdminPermissionSeederArray());
        DB::table('role_has_permissions')->insert($this->getStudentPermissionSeederArray());
        DB::table('role_has_permissions')->insert($this->getTeacherPermissionSeederArray());
    }

    public static function getAdminPermissionsSeederArray(){
        $permissions = Permission::all();
        $role = Role::findByName('admin');
        $permissionArray = [];
        foreach($permissions as $permission){
            array_push($permissionArray , [
                'permission_id' => $permission->id,
                'role_id' => $role->id
            ]);
        }
        return $permissionArray;
    }

    public static function getModeratorPermissionsSeederArray(){
        $permissionsArray = [];
        $role = Role::findByName('moderator');
        $permissions = Permission::where('name', 'create_post')
                                ->orWhere('name', 'assign_user_status')
                                ->orWhere('name', 'block_post')
                                ->orWhere('name', 'unblock_post')
                                ->orWhere('name', 'assign_teacher')
                                ->orWhere('name', 'revoke_teacher')
                                ->orWhere('name', 'verify_institute')
                                ->orWhere('name', 'revoke_institute_verification')
                                ->orWhere('name', 'block_institute')
                                ->orWhere('name', 'create_institute')
                                ->orWhere('name', 'unblock_institute')
                                ->get();
        foreach($permissions as $permission){
            array_push($permissionsArray, [
                'role_id' => $role->id,
                'permission_id' => $permission->id
            ]);
        }
        return $permissionsArray;
    }
    public static function getCollegeAdminPermissionSeederArray(){
        $permissionsArray = [];
        $role = Role::findByName('college admin');
        $permissions = Permission::where('name', 'create_post')
                                ->orWhere('name', 'block_post')
                                ->orWhere('name', 'unblock_post')
                                ->orWhere('name', 'delete_post')
                                ->orWhere('name', 'edit_post')
                                ->orWhere('name', 'assign_teacher')
                                ->orWhere('name', 'revoke_teacher')
                                ->orWhere('name', 'edit_institute')
                                ->orWhere('name', 'delete_institute')
                                ->orWhere('name', 'block_institute')
                                ->orWhere('name', 'unblock_institute')
                                ->orWhere('name', 'assign_user_status')
                                ->get();
        foreach($permissions as $permission){
            array_push($permissionsArray, [
                'role_id' => $role->id,
                'permission_id' => $permission->id
            ]);
        }
        return $permissionsArray;
    }

    public static function getStudentPermissionSeederArray(){
        $permissionsArray = [];
        $role = Role::findByName('student');
        $permissions = Permission::where('name', 'create_post')
                                ->orWhere('name', 'delete_post')
                                ->orWhere('name', 'edit_post')
                                ->orWhere('name', 'view_post')
                                ->get();
        foreach($permissions as $permission){
            array_push($permissionsArray, [
                'role_id' => $role->id,
                'permission_id' => $permission->id
            ]);
        }
        return $permissionsArray;
    }

    public static function getTeacherPermissionSeederArray(){
        $permissionsArray = [];
        $role = Role::findByName('teacher');
        $permissions = Permission::where('name', 'create_post')
                                ->orWhere('name', 'delete_post')
                                ->orWhere('name', 'edit_post')
                                ->orWhere('name', 'view_post')
                                ->orWhere('name', 'approve_post')
                                ->orWhere('name', 'assign_user_status')
                                ->get();
        foreach($permissions as $permission){
            array_push($permissionsArray, [
                'role_id' => $role->id,
                'permission_id' => $permission->id
            ]);
        }
        return $permissionsArray;
    }
}
