<?php

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        Role::create([
            'id' => 1,
            'name' => 'Administrator',
        ]);

//        Role::create([
//            'id' => config('boilerplate.access.role.default'),
//            'name' => 'Member',
//        ]);

        Role::create([
            'id' => config('boilerplate.access.role.seller'),
            'name' => 'Seller',
        ]);

        Role::create([
            'id' => config('boilerplate.access.role.customer'),
            'name' => 'Customer',
        ]);

        // Non Grouped Permissions
        Permission::create([
            'name' => 'view backend',
            'description' => 'Access Administration',
        ]);

        // Grouped permissions
        // Users category
        $users = Permission::create([
            'name' => 'access.user',
            'description' => 'All User Permissions',
        ]);

        $users->children()->saveMany([
            new Permission([
                'name' => 'access.user.list',
                'description' => 'View Users',
            ]),
            new Permission([
                'name' => 'access.user.deactivate',
                'description' => 'Deactivate Users',
                'sort' => 2,
            ]),
            new Permission([
                'name' => 'access.user.reactivate',
                'description' => 'Reactivate Users',
                'sort' => 3,
            ]),
            new Permission([
                'name' => 'access.user.clear-session',
                'description' => 'Clear User Sessions',
                'sort' => 4,
            ]),
            new Permission([
                'name' => 'access.user.impersonate',
                'description' => 'Impersonate Users',
                'sort' => 5,
            ]),
            new Permission([
                'name' => 'access.user.change-password',
                'description' => 'Change User Passwords',
                'sort' => 6,
            ]),
        ]);

        // Users category
        $product = Permission::create([
            'name' => 'product.all',
            'description' => 'All Product Permissions',
        ]);

        $product->children()->saveMany([
            new Permission([
                'name' => 'product.view',
                'description' => 'View Product',
            ]),
            new Permission([
                'name' => 'product.add',
                'description' => 'Add Product',
                'sort' => 2,
            ]),
            new Permission([
                'name' => 'product.edit',
                'description' => 'Product Edit',
                'sort' => 3,
            ]),
            new Permission([
                'name' => 'product.update',
                'description' => 'Product Update',
                'sort' => 4,
            ]),
            new Permission([
                'name' => 'product.delete',
                'description' => 'Product Delete',
                'sort' => 4,
            ]),
        ]);

        // Assign Permissions to other Roles
        // Note: Admin (User 1) Has all permissions via a gate in the AuthServiceProvider
        // $user->givePermissionTo('view backend');

        $this->enableForeignKeys();
    }
}
