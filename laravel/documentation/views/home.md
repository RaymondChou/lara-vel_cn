# 视图和响应(Response)

## 目录

- [基础](#the-basics)
- [给视图绑定数据](#binding-data-to-views)
- [内嵌视图(Nesting View)](#nesting-views)
- [命名视图](#named-views)
- [视图合成器](#view-composers)
- [重定向](#redirects)
- [Flash(临时)数据重定向](#redirecting-with-flash-data)
- [下载](#downloads)
- [错误](#errors)

<a name="the-basics"></a>
## 基础

视图包含了发送到你的客户那里去的HTML代码。将视图和业务逻辑从你的程序中分享开来将使得你的代码更加清晰和易维护。

所有的视图都位于**application/views**目录中，并且使用PHP作为扩展名（.php）。**View**类提供了一个简单的获取并返回客户端的方法，让我们看个例子！

#### 创建视图：

	<html>
		I'm stored in views/home/index.php!
	</html>

#### 从一个路由返回视图：

	Route::get('/', function()
	{
		return View::make('home.index');
	});

#### 从一个控制器返回视图：

	public function action_index()
	{
		return View::make('home.index');
	});

#### 判断一个视图是否存在：

	$exists = View::exists('home.index');

有是你可能需要更进一步控制返回给浏览器的内容。例如，在内容之前发送一个自定义的header，或者改变HTTP状态(HTTP Status)的状态，请看下面：

#### 返回一个自定义响应(Response)：

	Route::get('/', function()
	{
		$headers = array('foo' => 'bar');

		return Response::make('Hello World!', 200, $headers);
	});

#### 返回一个自定义的包含绑定数据的视图：

	return Response::view('home', array('foo' => 'bar'));

#### 返回一个JSON格式的响应：

	return Response::json(array('name' => 'Batman'));

#### 返回一个Eloquent模型的JSON数据：

	return Response::eloquent(User::find(1));

<a name="binding-data-to-views"></a>
## 给视图绑定数据

典型地，一个路由或控制器将从模型取得视图需要显示的数据，所以我们需要一种把数据传递给视图的方法。有几种方法可以完成这个任务，你可以选择你最喜欢的方式！

#### 绑定数据到一个视图：

	Route::get('/', function()
	{
		return View::make('home')->with('name', 'James');
	});

#### 在视图中访问被绑定的数据：

	<html>
		Hello, <?php echo $name; ?>.
	</html>

#### 更改绑定到视图的数据：

	View::make('home')
		->with('name', 'James')
		->with('votes', 25);

#### 传递一个数组以绑定数据：

	View::make('home', array('name' => 'James'));

#### 使用魔术方法绑定数据：

	$view->name  = 'James';
	$view->email = 'example@example.com';

#### 使用ArrayAccess接口绑定数据：

	$view['name']  = 'James';
	$view['email'] = 'example@example.com';

<a name="nesting-views"></a>
## 内嵌视图

你可能经常需要在视图中内嵌视图，内嵌视图有时被称为“partials”（下面翻译为小视图，有的地方说是部件），它可以使视图相对较小而模块化。

#### 使用“nest”方法绑定内嵌视图到视图：

	View::make('home')->nest('footer', 'partials.footer');

#### 传递数组给内嵌视图：

	$view = View::make('home');

	$view->nest('content', 'orders', array('orders' => $orders));

有时，你需要直接在视图中包含另一个视图，你可以使用**render** helper方法来做：

#### 使用“render”方法绑定视图：

	<div class="content">
		<?php echo render('user.profile'); ?>
	</div>

使用一个小视图显示一个列表的数据也是很常见的，例如，你建立了一个小视图来显示一个订单，然后在一个循环中使用此视图来输出每一个订单。使用**render_each**可以简化操作：

#### 使用小视图循环输出数组数据

	<div class="orders">
		<?php echo render_each('partials.order', $orders, 'order');
	</div>

第一个参数是小视图的名称，第二个参数是数据，第三个参数是将数据传递给小视图的变量名。

<a name="named-views"></a>
## 命名视图

命名视图可以使你的代码更具表现力也可以更好的被组织。使用也很简单：

#### 注册一个命名视图：

	View::name('layouts.default', 'layout');

#### 获取一个命名视图：

	return View::of('layout');

#### 绑定数据到一个命名视图：

	return View::of('layout', array('orders' => $orders));

<a name="view-composers"></a>
## 视图合成器

每次你的视图被创建时，他的合成器(composer)事件就被触发，你可以监听这个事件来绑定一些资源和通用数据到每次创建的视图。一个常见的例子是，侧栏的显示随机博文列表的小视图，你可以将它内嵌到你的模板视图中，然后为之定义一个合成器。合成器之后可以查询博文数据库，得到视图所需信息。你不需要到处理随机的逻辑！视图合成器一般是定义在**application/routes.php**中，这里有个例子：

#### 为"home"视图定义一个视图合成器

	View::composer('home', function($view)
	{
		$view->nest('footer', 'partials.footer');
	});

现在每当“home”视图被创建时，一个此视图的实例将被传递给注册了的闭包，这将允许你任意准备你的视图。

#### 注册一个处理多个视图的合成器：

	View::composer(array('home', 'profile'), function($view)
	{
		//
	});

> **注意:** 一个视图可以有多个合成器，试试看吧。

<a name="redirects"></a>
## 重定向

有一点非常重要，路由和控制器都必须通过"return"返回内容，因此当需要重定向时，你应该通过“return Redirect::to()”来重定向地址，而不能指望仅通过调用Redirect::to()达到重定向的效果。这一点跟其它框架不同，需要多加注意。

#### 重定向到另一个URI

	return Redirect::to('user/profile');

#### 重定向时带HTTP状态：

	return Redirect::to('user/profile', 301);

#### 重定向到一个安全链接（HTTPS）：

	return Redirect::to_secure('user/profile');

#### 重定向到根目录：

	return Redirect::home();

#### Redirecting back to the previous action:

	return Redirect::back();

#### 重定向到一个命名路由：

	return Redirect::to_route('profile');

#### 重定向到一个控制器：

	return Redirect::to_action('home@index');

有时你需要重定向到一个命名路由，但你也需要指定一些不同于路由接受的普通字符串（点位符？）的数据，可以简单的指定需要的数据：

#### 重定向到一个命名路由并传入数据：

	return Redirect::to_route('profile', array($username));

#### 重定向到控制器并传入数据：

	return Redirect::to_action('user@profile', array($username));

<a name="redirecting-with-flash-data"></a>
## Flash(临时)数据重定向

在创建一个用户账户之后，或者注册一个用户之后，通常会显示一个欢迎消息或状态消息。但该如何来设置消息的内容以保证下一次请求可以读取并显示呢？使用with方法可以重定向时发送临时数据。

	return Redirect::to('profile')->with('status', 'Welcome Back!');

你可以在视图中通过Session::get来读取值。

	$status = Session::get('status');

*延伸阅读:*

- *[会话](/docs/session/config)*

<a name="downloads"></a>
## 下载

#### 返回一个文件下载响应：

	return Response::download('file/path.jpg');

#### 返回一个文件下载响应并指定文件名：

	return Response::download('file/path.jpg', 'photo.jpg');

<a name="errors"></a>
## 错误

发送错误消息只需要简单地使用Response的**error**方法并指定错误码。对应位于**views/error**的视图会被自动返回。

#### 产生404错误：

	return Response::error('404');

#### 产生500错误：

	return Response::error('500');
