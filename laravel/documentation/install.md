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

多数情况，你本地开发环境的配置选项和你实际产品服务器需要的配置是不一样的。 Laravel默认的环境处理机制是基于URL的, 设置好环境是轻而易举的事情。 打开Laravel安装根目录下的 `paths.php` 文件，你将会看到这么样的一个数组：

	$environments = array(

		'local' => array('http://localhost*', '*.dev'),

	);

这告诉给 Laravel 所有以 "localhost" 开头或者以 ".dev" 结尾的URL应该被认定成 "local" 环境。

其次， 创建一个 **application/config/local** 目录。 所有你放置到这个目录的文件和选项会重写 **application/config** 目录中的基本设置。 比如 , 你可能希望创建一个 **application.php** 文件放到你的新 **local** 配置目录:

	return array(

		'url' => 'http://localhost/laravel/public',

	);

在这个例子中，**application/config/application.php** 中的 **URL** 将会被 local中的 **URL** 重写。 注意，你只需要声明你希望重写的选项。

是不是很简单？ 当然，你也可以自由创建多个环境，只要你想的话！

<a name="cleaner-urls"></a>
## URL重写

多半情况, 你不希望你的访问路径中出现 "index.php"。 你可以通过HTTP rewrite 规则将其去掉。 如果你使用的是Apache服务器环境，确保已经开启了 enable mod_rewrite 并且创建了 **.htaccess** 文件到你的 **public** 目录:

	<IfModule mod_rewrite.c>
	     RewriteEngine on

	     RewriteCond %{REQUEST_FILENAME} !-f
	     RewriteCond %{REQUEST_FILENAME} !-d

	     RewriteRule ^(.*)$ index.php/$1 [L]
	</IfModule>

这个.htaccess文件在你的环境中没有效果? 那试试这个:

	Options +FollowSymLinks
	RewriteEngine on

	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d

	RewriteRule . index.php [L]

设置好 HTTP rewriting之后 , 你应该设置 **application/config/application.php** 中的 **index** 值为空字符串。

> **注意:** 每个WEB服务器都有一个不同的方法去处理 HTTP rewrites , 并且可能需要一个稍微有些区别的 .htaccess 文件。