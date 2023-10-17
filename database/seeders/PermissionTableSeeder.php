<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'invoices',
            'invoice list',
            'paid invoices',
            'partally paid invoices',
            'unpaid invoices',
            'invoice archive',
            'reportd',
            'invoice reports',
            'client reposts',
            'users',
            'users list',
            'user permission',
            'setting',
            'products',
            'sections',
            'add invoice',
            'delet invoice',
            // 'تصدير EXCEL',
            'chang payment status',
            'edit invoice',
            'archive invoice',
            'print invoice',
            'add attachment',
            'delet attachment',
            'add user',
            'edit user',
            'delet user',
            'show permission',
            'add persmission',
            'edit permission',
            'delet permission',
            'add product',
            'edit product',
            'delet product',
            'add section',
            'edit section',
            'delet section',
            'notification',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
