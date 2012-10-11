# 控制器

## 目录

- [基础](#the-basics)
- [控制器路由](#controller-routing)
- [Bundle 控制器](#bundle-controllers)
- [方法过滤器](#action-filters)
- [内嵌的控制器](#nested-controllers)
- [控制器布局](#controller-layouts)
- [RESTful 控制器](#restful-controllers)
- [依赖性注入模式](#dependency-injection)
- [控制器工厂](#controller-factory)

<a name="the-basics"></a>
## 基础

控制器是负责处理用户提交的信息，并且管理模型（models）、类库（libraries）和视图（views）之间相互关系的集成类。 通常, 它会向模型请求一个数据, 然后返回一个包含用户需要数据的视图。

对控制器的使用，是现代网络开发中最常见的体现实现应用思想的方法。 然而， Laravel还支持开发者通过声明路由的方式来实现自己的应用逻辑。这部分应用的详细介绍请查看   [路由文档](/docs/routing)。建议新手从控制器开始学习和使用此框架。 没有什么应用是使用路由能实现，而使用控制其实现不了的。

控制器类必须保存在 **application/controllers** 路径下，并且必须继承 Base\_Controller 类。 Laravel 在此路径下默认包含一个名叫 Home\_Controller 的控制器类示例文件。

#### 创建一个简单的控制器:

	class Admin_Controller extends Base_Controller
	{

		public function action_index()
		{
			//
		}

	}

**Actions** 是用来表示能被网路访问的控制器方法名。  Actions 的方法（能被网路访问的方法）之前应该加有 "action\_" 前缀。其他没有前缀的方法，无论任何范围，都不能被访问。

> **注释:**  Base\_Controller 类继承  main Laravel 控制类， 并且提供一个添加对许多控制类相同的方法的地方。

<a name="controller-routing"></a>
## 控制器路由

需要特别注意的是，在 Laravel 中所有的路由都必须明确定义，包括指向控制器的路由。

这就意味着没有通过路由注册声明的控制器方法是不能够被使用的。通过注册控制器路由就能够自动的声明控制器中的所有方法。控制器路由的注册通常是在 **application/routes.php** 文件中。

查看 [路由文档](/docs/routing#controller-routing) 来获得更多关于控制器路由的信息。

<a name="bundle-controllers"></a>
## Bundle 控制器

Bundles 是 Laravel 的模块化组件系统。Bundles 通过非常简单的配置就可以处理你的应用请求。我们可以查看 [bundles 的更多信息](/docs/bundles) 在其他文档中。

创建一个 bundles 控制器和创建一个普通的应用控制器几乎是一样的。 只需在控制器类名之前加上 bundles 的名称作为前缀， 比如你的 bundles 称为"admin"，那么你的控制器类将会像这样：

#### 创建一个 bundles 控制器类:

	class Admin_Home_Controller extends Base_Controller
	{

		public function action_index()
		{
			return "Hello Admin!";
		}

	}

但是, 如何使用路由来注册一个 bundles 控制器呢？ 这很简单，就像下面这样:

#### 通过路由来建立一个集束式控制器:

	Route::controller('admin::home');

恭喜你! 现在你已经可以通过网络来访问属于"admin" bundles 的 home 控制器了!

> **注释:** 在整个Laravel之中双冒号都是用来表示 bundles 的。 你可以去[bundle 文档](/docs/bundles)了解更多关于 bundles 的信息。

<a name="action-filters"></a>
## 方法过滤器

方法过滤器是一种可以在某个控制器方法之前或之后运行的方法。  使用 Laravel 你不仅可以控制属于某个方法的过滤器，并且可以选择一种超文本传输协议(post, get, put, and delete)来激活一个过滤器。

你可你通过控制器构造函数给控制器方法分配 "before" 和"after" 过滤器。

#### 为所有的方法附上过滤器:

	$this->filter('before', 'auth');

在这个例子中'auth'过滤器将会在这个控制器中所有方法之前运行。 auth方法是被Laravel封装好的可直接使用的，可以在**application/routes.php**之中找到 。auth可以验证一个用户是否已经登陆，如果没有登陆将重定向至'login'。

#### 只为某些方法附上过滤器:

	$this->filter('before', 'auth')->only(array('index', 'list'));

在这个例子中 auth过滤器将会在action_index() 或 action_list() 方法运行之前运行，  用户必须在登录后才有权限访问这些页面。  然而， 这个控制器内的其他方法被访问则不需要验证SESSION。

#### 给除了某些方法之外的其他所有方法附上过滤器:

	$this->filter('before', 'auth')->except(array('add', 'posts'));

和之前的例子一样， 这个声明确保auth 过滤器只作用于这个控制器内的一些方法。  除了排除某些方法被访问时不需要被过滤器验证会话，有时使用 'except' 方法还可以作为一种安全机制，防止你添加的某个新方法因为你忘记了将其用only()函数限制，而被没有权限的用户无意访问。

#### 为利用POST传输协议的地方加上过滤器:

	$this->filter('before', 'csrf')->on('post');

这个例子向我们展示如何让一个过滤器只在特定的HTTP协议下运行。  在这个案例中我们只在POST协议数据传输产生的情况下运行 csrf 过滤器。   csrf 过滤器是被设计用来防止来自其他系统的PSOT 垃圾数据请求和利用其本身系统制造的POST数据垃圾。  你可以在 **application/routes.php**之中找到csrf过滤器。

*延伸阅读:*

- *[Route Filters](/docs/routing#filters)*

<a name="nested-controllers"></a>
## 嵌套的控制器

控制器可能位于主目录**application/controllers**之下无限级的子目录之中。

定义一个放置在**controllers/admin/panel.php**之中的控制器。

	class Admin_Panel_Controller extends Base_Controller
	{

		public function action_index()
		{
			//
		}

	}

#### 使用"点"连接来完成嵌套控制器的路由注册:

	Route::controller('admin.panel');

> **注释:** 当使用嵌套控制器的时候, always register your controllers from most nested to least nested in order to avoid shadowing controller routes.

#### 访问控制器里的"index"方法:

	http://localhost/admin/panel

<a name="controller-layouts"></a>
## 控制器布局

完整的控制器布局的文档 [可以在模板页说明中找见](http://laravel.com/docs/views/templating).

<a name="restful-controllers"></a>
## RESTful 控制器

控制器的方法名前缀除了"action_"之外， 你还可以使用HTTP传输协议作为前缀，来设置该方法的响应方式。

#### 给控制器增加 RESTful 属性 :

	class Home_Controller extends Base_Controller
	{

		public $restful = true;

	}

#### 建立一个 RESTful 控制器方法:

	class Home_Controller extends Base_Controller
	{

		public $restful = true;

		public function get_index()
		{
			//
		}

		public function post_index()
		{
			//
		}

	}

这个方法在你创建"增删改查"同时又想将你填充和渲染表单的逻辑与确认和储存结果的逻辑分离时会显得特别有用。

<a name="dependency-injection"></a>
## 依赖性注入模式

如果你专注于写你的测试性代码，你可能想给你的控制器的构造函数注入依赖性。 这个没任何问题。 只需在 [控制反转容器](/docs/ioc)中定义你的控制器。 当需要使用容器来定义控制器时， 我们需要在 **controller**之前加上关键字前缀。 这样， 在我们的 **application/start.php** 文件里我们可以像这样定义我们的控制器:

	IoC::register('controller: user', function()
	{
		return new User_Controller;
	});

当一个调用控制器的请求出现在你的应用里时，, Laravel 会自动确认这个控制器是否在容器之中已经定义，如果定义了便会使用容器来实例化一个这个控制器的对象。

> **注释:** 在正式使用控制器依赖模式前，你或许想在 [IoC container](/docs/ioc)之中了解更多.

<a name="controller-factory"></a>
## 控制器工厂
如果你想在实例化你的控制器时进行更多的操作，比如使用一个第三方控制反转容器， 你将会用到 Laravel 的控制器工厂。

**定义一个事件来负责控制器实例化:**

	Event::listen(Controller::factory, function($controller)
	{
		return new $controller;
	});

这个事件将会接收一个需要实例化的控制器的名称，你只需返回一个控制器的实例对象。
