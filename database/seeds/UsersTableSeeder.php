<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::table('role_user')->delete();
        DB::table('permission_role')->delete();

        $faker = Faker::create('en_US');
        $limit = 48;

        /*
         * Base User Accounts
         */

        // Administrator (User)
        $adminU = User::create([
            'name' => 'Naresh Rawat',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Manager (User)
        $managerU = User::create([
            'name' => 'Jon Doe',
            'email' => 'manager@manager.com',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Administrator (Role)
        $adminR = Role::create([
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'description' => 'User is the Administrator of a given project',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Administrator (Role)
        $managerR = Role::create([
            'name' => 'manager',
            'display_name' => 'Manager',
            'description' => 'User is the Manager of a given project',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $createPost = new Permission();
        $createPost->name = 'create-post';
        $createPost->display_name = 'Create Posts'; // optional Allow a user to...
        $createPost->description = 'create new blog posts'; // optional $createPost->save();
        $createPost->created_at = Carbon::now();
        $createPost->updated_at = Carbon::now();
        $createPost->save();

        $editUser = new Permission();
        $editUser->name = 'edit-user';
        $editUser->display_name = 'Edit Users'; // optional Allow a user to...
        $editUser->description = 'edit existing users'; // optional
        $editUser->created_at = Carbon::now();
        $editUser->updated_at = Carbon::now();
        $editUser->save();

        $adminU->attachRole($adminR);
        $managerU->attachRole($managerR);
        $adminR->attachPermission($createPost);
        $adminR->attachPermission($editUser);
        $managerR->attachPermission($createPost);

        /*
         * Dummy User accounts
         */
        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => bcrypt('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
