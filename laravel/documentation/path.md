# 跟目录结构

	/application
	/bundles
	/laravel
	/public
	/storage
	artisan
	paths.php

## 1./application
整个Laravel 目录中最需要我们注意的地方，包含设置(config)、路由(routing)、MVC 模型的三大模块皆在此，这个目录结构会具体在下文介紹。

## 2./bundles
Bundles 是放置laravel扩展包的目录，放置好后，就要使用工匠指令 – artisan 来将扩展包安装进去。另外，每一个 bundle 的结构与 application 目录是类似的，只是会根据 bundle 的需求，将一些不必要的目录省略。简单的说，原生的 application 本身就是一个完整的 bundle！

## 3./laravel
Laravel 框架的核心！所有的元件皆可在 Laravel API 中找到说明。

## 4./public
这个目录是网站的访问入口，存放所有对外开放的资源目录，如 CSS、JavaScript 以及图片等等皆被存放在此。

## 5./storage
此目录用于存放 Session、Cache 这类临时文件,包含渲染后的View, 该目录可能需要可写权限。

## 6.artisan
工匠指令，这是 Laravel 框架里的命令行工具.

## 7.paths.php
此文件用于定义Laravel中的所有文件路径，我们可以使用 path(‘目录名’)这样的方式，取得该路径下我们所需要的內容。



# Application 目录结构
Applicaiton 目录是我们最需要关注的目录，他是我们网站程序实现的核心。

	/config
	/controllers
	/language
	/libraries
	/migrations
	/models
	/tasks
	/tests
	/views
	bundles.php
	routes.php
	start.php

## 1./config
虽然 Laravel 程序在一开始的使用可以不做任何设置，但我们肯定还需要更多的设置来完成业务上的需求,所有的设置都放在这个目录中.

## 2./controllers
顾名思义，这个目录放 MVC 模型中的 C – 控制器(controller) 。

## 3./language
语言目录，Laravel 框架的语系采用文字格式，先用目录做各语系的分别，再依所需要的文件来存放, 默认是英文(“en”)。转换语言的方法是 config 目录下的 application.php 文件中的language ，设定值与语言文件夹名相同即可。

## 4./libraries
Libraries 也是存放扩展功能的目录，他和 Bundles 最大的不同是，这里要放的是某特定功能，属于单一的功能类型，放在这里的扩展库不用再安裝，因为 Laravel 框架的 auto-loading 的功能会将libraries的内容自动加载。

## 5./migrations
定义表结构(table schema)，可以把这个目录当做表结构的版本控制。利用工匠指令： php artisan migrate:make [migration_name] 能够将我们定义好的表结构(migration_name)保存下来。

## 6./models
MVC 模型中的 M，就是我们的业务逻辑(business logic)，基本上就是定义了我们要从数据库中取出的内容、通过 web service 要传出的内容…等。原则上，也是搭配著 Laravel 框架中 EloquentORM 对数据库进行存取，他和 libraries 一样，都是在包含在 auto-loading 之中。

## 7./tasks
建立自定义可以使用工匠指令执行的任务。

## 8./tests
Laravel 框架整合了 PHPUnit 方便我们对专门的程序进行单元测试，所以我们可以直接參考PHPUnit 文件来编写单元测试，在全新的文件目录中含有 example.test.php 的基本范例。

## 9./views
HTML 的模板(template)，也就是 MVC 模型中的 V。而模板除了原始的 HTML 格式外，Laravel 框架提供了 Blade Template Engine ，让我们可以用比较简洁的方式编写模板文件，而这些文件只要的扩展名改为 .blade.php ，例如 index.blade.php，模板引擎就会自动帮我们编译了，想要了解更多的內容，说明文件 – Blade Template Engine 中有详细介绍。

## 10.bundles.php
这个文件 key-value 的数组格式，将已经安装的 bundel 进行注册说明。

## 11.routes.php
路由设置，接收请求，再根据我们的设定调用相应的程序进行回应。若是请求不存在或请求失败则返回 404 或 500 的错误回应。

## 12.start.php
是整个程序的入口，在这里调用了config设置、设定了自动加载器(auto-loader)的目录…等动作。