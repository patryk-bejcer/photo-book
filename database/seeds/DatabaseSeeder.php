<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    // Reset cached roles and permissions
	    app()['cache']->forget('spatie.permission.cache');

	    // create permissions
	    Permission::create(['name' => 'Administer roles & permissions']);
	    Permission::create(['name' => 'Edit gallery']);
	    Permission::create(['name' => 'Add gallery']);

	    // create roles and assign existing permissions
	    $role = Role::create(['name' => 'Administrator']);
	    $role->givePermissionTo('Administer roles & permissions');

	    $role = Role::create(['name' => 'User']);


	    //Admin user
	    User::create([
		    'email'     =>  'admin@gmail.com',
		    'name'      =>  'Patryk Bejcer',
		    'password'  =>  bcrypt('pass')
	    ])->assignRole('Administrator');

    }
}
