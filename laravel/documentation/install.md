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
- Laravel 使用 [Mcrypt library](http://php.net/manual/en/book.mcrypt.php) 来进行加密和哈希生成。 Mcrypt 通常是预安装好的。 如果你使用 phpinfo() 显示的输出结果中找不到 Mcrypt , 那么检查你LAMP服务的主机供应商网站或参见 [installation / configuration details on PHP.net](http://php.net/manual/en/book.mcrypt.php)。

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
## Server Configuration

Like most web-development frameworks, Laravel is designed to protect your application code, bundles, and local storage by placing only files that are necessarily public in the web server's DocumentRoot. This prevents some types of server misconfiguration from making your code (including database passwords and other configuration data) accessible through the web server. It's best to be safe. 

In this example let's imagine that we installed Laravel to the directory **/Users/JonSnow/Sites/MySite**.

A very basic example of an Apache VirtualHost configuration for MySite might look like this.

	<VirtualHost *:80>
		DocumentRoot /Users/JonSnow/Sites/MySite/public
		ServerName mysite.dev
	</VirtualHost>

Notice that while we installed to **/Users/JonSnow/Sites/MySite** our DocumentRoot points to **/Users/JonSnow/Sites/MySite/public**.

While pointing the DocumentRoot to the public folder is a commonly used best-practice, it's possible that you may need to use Laravel on a host that does not allow you to update your DocumentRoot. A collection of algorithms to circumvent this need can be found [on the Laravel forums.](http://forums.laravel.com/viewtopic.php?id=1258)

<a name="basic-configuration"></a>
## Basic Configuration

All of the configuration provided are located in your applications config/ directory. We recommend that you read through these files just to get a basic understanding of the options available to you. Pay special attention to the **application/config/application.php** file as it contains the basic configuration options for your application.

It's **extremely** important that you change the **application key** option before working on your site. This key is used throughout the framework for encryption, hashing, etc. It lives in the **config/application.php** file and should be set to a random, 32 character string. A standards-compliant application key can be automatically generated using the Artisan command-line utility.  More information can be found in the [Artisan command index](/docs/artisan/commands).

> **Note:** If you are using mod_rewrite, you should set the index option to an empty string.

<a name="environments"></a>
## Environments

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
## Cleaner URLs

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