<?php

use Illuminate\Database\Seeder;

class MigrateProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Permissions table seeder
         *
         * 
         * 
         */

        $permissions = [
        	['name' => 'Create Users', 'slug' => 'users.create'],
        	['name' => 'View Users', 'slug' => 'users.view'],
        	['name' => 'Update Users', 'slug' => 'users.update'],
        	['name' => 'Delete Users', 'slug' => 'users.delete'],
        	['name' => 'Create Roles', 'slug' => 'roles.create'],
        	['name' => 'View Roles', 'slug' => 'roles.view'],
        	['name' => 'Update Roles', 'slug' => 'roles.update'],
        	['name' => 'Delete Roles', 'slug' => 'roles.delete'],
        	['name' => 'Create Permissions', 'slug' => 'permissions.create'],
        	['name' => 'View Permissions', 'slug' => 'permissions.view'],
        	['name' => 'Update Permissions', 'slug' => 'permissions.update'],
        	['name' => 'Delete Permissions', 'slug' => 'permissions.delete'],
        	/*
        	['name' => '', 'slug' => ''],*/
        ];

        foreach ($permissions as $permission) {
			DB::table('permissions')->insert([
	            'name' => $permission['name'],
	            'slug' => $permission['slug'],
	        ]);
        }

        $roles = [
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Editor', 'slug' => 'editor'],            
            /*
            ['name' => '', 'slug' => ''],*/
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role['name'],
                'slug' => $role['slug'],
            ]);
        }
	        
    }
}
