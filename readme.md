# Larval 5.3 Rbac 后台实例

## 说明

基于laravel 5.3 与 自带的gate来做权限认证 ( 之前5.2的是用的zizaco/entrust,查询次数太多我只建议用来学习)
开箱即用的后台模板,菜单栏都是基于权限来生成
前后端用户分表分别登录
集成了laravel-debugbar 超好用调试工具
带有日志解析查看模块
###### 本项目可以用于生产

## 截图

## ![laravel rbac](http://o7ze7op4t.bkt.clouddn.com/QQ20161111-1.png)



![rbac](http://o7ze7op4t.bkt.clouddn.com/QQ20161111-2.png)



## 安装

- git clone 到本地
- 执行 `composer install`,创建好数据库
- 配置 **.env** 中数据库连接信息,没有.env请复制.env.example命名为.env
- 执行 `php artisan key:generate`
- 执行 `php artisan migrate`
- 执行 `php artisan db:seed --class=AdminInitSeeder`
- 键入 '域名/admin'
- 默认后台账号:root@admin.com 密码:root


## 使用
- 用户管理中的权限管理添加顶级权限
   比如用户管理, 'admin.user' 只有两段的做左边的菜单栏, 列表页统一为'admin.XXXX.index'
   具体部分可以参照路由与源码,也可以QQ我176608671
