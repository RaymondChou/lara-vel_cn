# 安装与设置

## 目录

- [系统需求](#requirements)
- [安装说明](#installation)
- [服务器配置](#server-configuration)
- [基本配置](#basic-configuration)
- [环境说明](#environments)
- [URL重写](#cleaner-urls)

<a name="requirements"></a>
## 系统需求

- Apache, nginx, 或其他兼容的WEB服务器环境。
- Laravel 充分利用了 PHP 5.3 之后版本的强大特性。 因此, 需要PHP 5.3 以上版本。
- Laravel 使用 [FileInfo library](http://php.net/manual/en/book.fileinfo.php) 来检测 mime-types 文件。 这个是PHP 5.3默认包含的功能。但是, Windows 系统用户可能需要向 php.ini 文件中添加一行配置才能将 Fileinfo 启用。 更多信息请参见 [installation / configuration details on PHP.net](http://php.net/manual/en/fileinfo.installation.php)。
- Laravel 使用 [Mcrypt library](http://php.net/manual/en/book.mcrypt.php) 来进行加密和哈希生成。 Mcrypt 通常是预安装好的。 如果你使用 phpinfo() 显示的输出结果中找不到 Mcrypt , 那么检查你的主机供应商是否安装了LAMP的Mcrypt组件 , 或参见 [installation / configuration details on PHP.net](http://php.net/manual/en/book.mcrypt.php)。

<a name="installation"></a>
## 安装说明

1. [下载 Laravel](http://laravel.com/download)
2. 解压 Laravel 压缩包，上传内容到你的WEB服务器上。
3. 将 **config/application.php** 文件中的 **key** 项目设置为一个随机的、长度为32字节的字符串。
4. 确认 `storage/views` 目录是可写的。
5. 从浏览器中定位到你的应用。

如果以上步骤都做好了 , 那么你应该看到一个可爱的 Laravel 引导页。准备好 , 这里有更多可学的东西！

### 附加组件

安装以下组件能帮助你充分利用 Laravel 的优势 , 但它们并不是必需的:

- SQLite, MySQL, PostgreSQL, 或 SQL Server PDO drivers.
- Memcached 或 APC.

### 安装出现了问题?

如果你在安装过程中遇到了问题，请尝试以下步骤:

- 确保 **public** 目录是WEB服务器的文档根目录。 (见: 下文服务器配置)
- 如果你在使用 mod_rewrite, 设置  **application/config/application.php** 中 **index** 的值为空字符串。
- 确认你WEB服务器的存储目录和其中的子目录都是可写的。

<a name="server-configuration"></a>
## 服务器配置

和众多WEB开发框架一样 , Laravel 是设计用来保护你的应用代码 , 封装 , 公开在WEB服务器文档文件夹中必须用物理文件的本地存储。 它能阻止你在WEB服务器上可访问的代码 (包括数据库密码和其他配置数据) 被篡改. 所以说，这是一个安全性非常高的框架。

这是一个演示，让我们想像一下，我们将 Laravel 安装到目录 **/Users/JonSnow/Sites/MySite**。

一个非常基本的 Apache 虚拟主机网站配置应该看上去像这个样子：

	<VirtualHost *:80>
		DocumentRoot /Users/JonSnow/Sites/MySite/public
		ServerName mysite.dev
	</VirtualHost>

注意，当我们安装的目录是 **/Users/JonSnow/Sites/MySite** 文档根目录指向的是 **/Users/JonSnow/Sites/MySite/public**。

当文档根目录指向公开的目录是最优方法。当然也有可能你需要在不允许更新文档根目录的主机上使用 Laravel . 一系列的算法可以用来避免问题的发生，参见 [Laravel 官方论坛.](http://forums.laravel.com/viewtopic.php?id=1258)

<a name="basic-configuration"></a>
## 基本配置

所有提供的配置文件都位于你应用的 config/ 目录。 我们推荐你先阅读一下这些文件，以获得对可用配置项的简单了解。 特别注意下 **application/config/application.php** 文件，因为它包括你应用的基础设置项。

**极其重要** 最好在网站上线之前修改掉配置文件里的 **application key** 。 这个键值用于整个框架之内的加密算法、哈希算法等。它位于 **config/application.php** 文件，并且最好设置未随机的32位字符串。 一个符合规范的应用密钥(Key)最好是使用专门的命令行工具自动生成的。更多关于命令行工具的信息请参考 [Artisan command index](/docs/artisan/commands).

> **注意:** 如果你使用了 mod_rewrite, 你需要把 **index option** 设置为空字符串。

<a name="environments"></a>
## 环境说明

Most likely, the configuration options you need for local development are not the same as the options you need on your production server. Laravel's default environment handling mechanism is URL based, which will make setting up environments a breeze. Pop open the `paths.php` file in the root of your Laravel installation. You should see an array like this:

	$environments = array(

		'local' => array('http://localhost*', '*.dev'),

	);

This tells Laravel that any URLs beginning with "localhost" or ending with ".dev" should be considered part of the "local" environment.

Next, create an **application/config/local** directory. Any files and options you place in this directory will override the options in the base **application/config** directory. For example, you may wish to create an **application.php** file within your new **local** configuration directory:

	return array(

		'url' => 'http://localhost/laravel/public',

	);

In this example, the local **URL** option will override the **URL** option in **application/config/application.php**. Notice that you only need to specify the options you wish to override.

Isn't it easy? Of course, you are free to create as many environments as you wish!

<a name="cleaner-urls"></a>
## URL重写

Most likely, you do not want your application URLs to contain "index.php". You can remove it using HTTP rewrite rules. If you are using Apache to serve your application, make sure to enable mod_rewrite and create a **.htaccess** file like this one in your **public** directory:

	<IfModule mod_rewrite.c>
	     RewriteEngine on

	     RewriteCond %{REQUEST_FILENAME} !-f
	     RewriteCond %{REQUEST_FILENAME} !-d

	     RewriteRule ^(.*)$ index.php/$1 [L]
	</IfModule>

Is the .htaccess file above not working for you? Try this one:

	Options +FollowSymLinks
	RewriteEngine on

	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d

	RewriteRule . index.php [L]

After setting up HTTP rewriting, you should set the **index** configuration option in **application/config/application.php** to an empty string.

> **Note:** Each web server has a different method of doing HTTP rewrites, and may require a slightly different .htaccess file.