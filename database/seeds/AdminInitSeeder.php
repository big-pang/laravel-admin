<?php

use Illuminate\Database\Seeder;

class AdminInitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin\AdminUser::truncate();
        \App\Models\Admin\Permission::truncate();
        \DB::select(
            <<<SQL
                INSERT INTO `admin_permissions` (`id`, `name`, `label`, `description`, `cid`, `icon`, `created_at`, `updated_at`)
VALUES
	(1, 'admin.permission', '权限管理', '', 0, 'fa-users', '2016-05-21 10:06:50', '2016-06-22 13:49:09'),
	(2, 'admin.permission.index', '权限列表', '', 1, '', '2016-05-21 10:08:04', '2016-05-21 10:08:04'),
	(3, 'admin.permission.create', '权限添加', '', 1, '', '2016-05-21 10:08:18', '2016-05-21 10:08:18'),
	(4, 'admin.permission.edit', '权限修改', '', 1, '', '2016-05-21 10:08:35', '2016-05-21 10:08:35'),
	(5, 'admin.permission.destroy ', '权限删除', '', 1, '', '2016-05-21 10:09:57', '2016-05-21 10:09:57'),
	(6, 'admin.role.index', '角色列表', '', 1, '', '2016-05-23 10:36:40', '2016-05-23 10:36:40'),
	(7, 'admin.role.create', '角色添加', '', 1, '', '2016-05-23 10:37:07', '2016-05-23 10:37:07'),
	(8, 'admin.role.edit', '角色修改', '', 1, '', '2016-05-23 10:37:22', '2016-05-23 10:37:22'),
	(9, 'admin.role.destroy', '角色删除', '', 1, '', '2016-05-23 10:37:48', '2016-05-23 10:37:48'),
	(10, 'admin.user.index', '用户管理', '', 1, '', '2016-05-23 10:38:52', '2016-05-23 10:38:52'),
	(11, 'admin.user.create', '用户添加', '', 1, '', '2016-05-23 10:39:21', '2016-06-22 13:49:29'),
	(12, 'admin.user.edit', '用户编辑', '', 1, '', '2016-05-23 10:39:52', '2016-05-23 10:39:52'),
	(13, 'admin.user.destroy', '用户删除', '', 1, '', '2016-05-23 10:40:36', '2016-05-23 10:40:36');
SQL
        );
        $admin = new \App\Models\Admin\AdminUser();
        $admin->
        id = 1;
        $admin->name = 'root';
        $admin->email = 'root@admin.com';
        $admin->password = bcrypt('root');
        $admin->save();
    }
}
