#安装完本包后需要修改的地方
1. 在app user model文件的fillable属性中增加wechat_id、mobile、username
2. 发布迁移，php artisan vendor:publish --tag=migrations
