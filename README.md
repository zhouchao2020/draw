## 说明文档
### 导入mysql 
    mysql 文件：draw_table.sql

### 环境说明
lnmp环境 + redis

### 文件
1. 文件夹说明  
    1.1. lib 代码为 redis/mysql 连接操作等  
    1.2. conf mysql/redis配置信息  
    1.3. views 前端页面文件  
    1.4. Smarty smarty源码  
    1.5. Smarty.ini.php smarty公共配置 
2. 文件说明：   
    2.1  index.php 入口文件  
    2.2  draw.php 抽奖页面  
    2.3  admin.php 后台页面（两个导出功能）  
    2.4  getDraw.php 抽奖逻辑  
    2.5  getCode.php 获取验证码逻辑  
    2.6  exportDrawList.php 导出获奖记录  
    2.7  exportArticle.php  导出投稿


### 功能使用：
1.nginx配置到指定目录(eg: /home/www/draw, url: www.draw.com)  
2. 用户访问 www.draw.com  
3. 当用户提交完文章之后跳转到抽奖页面 www.draw.com/draw.php  
4. 访问www.draw.com/admin.php 进行结果导出
