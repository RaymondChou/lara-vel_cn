# 使用Auth

## 目录

- [加盐及散列](#hash)
- [登录](#login)
- [保护路由(URL)](#filter)
- [获取已登录用户](#user)
- [退出登录](#logout)
- [设计Auth驱动](#drivers)

> **注意:** 在你使用Auth类之前，你必须[指定一个驱动](/docs/session/config)。

<a name="hash"></a>
## 加盐及散列

如果你在使用Auth类，强烈建议你对所有的用户密码做散列并加盐。Web必须被负责任地开发。加盐并散列的密码使彩虹表攻击失去实践意义。

通过使用**Hash**类可以加盐并散列用户密码，Hash类使用**bcrypt**散列算法，请看下面的例子：

	$password = Hash::make('secret');

Hash的**make**方法将返回60个散列字符。

你可以使用**Hash**的**check**函数来比较一个没有被散列的值是否和一个经过散列的值一致（不是“一样”，一致的意思是原文一样）。

	if (Hash::check('secret', $hashed_value))
	{
		return 'The password is valid!';
	}

<a name="login"></a>
## 登录

使一个用户登录到你的系统，只需要调用Auth类的**attempt**方法，并将用户名和密码传递进去。凭证应该被放在一个数组中，这样最大程度上给予不同的驱动以灵活性，因为有些驱动可能需要不同数量的参数。如果登录成功，此登录函数将返回**true**，否则返回**false**：

	$credentials = array('username' => 'example@gmail.com', 'password' => 'secret');

	if (Auth::attempt($credentials))
	{
	     return Redirect::to('user/profile');
	}

如果用户的凭证有效，用户的ID将被存入session，用户之后的操作将被视为“已登录”。

检查一个用户是否登录可以可用**check**方法：

	if (Auth::check())
	{
	     return "You're logged in!";
	}

使用**login**方法可以使一个用户直接登录而无须其提供凭证，比如当用户完成注册时。使用**login**，你只需要传入用户模型对象或者ID：

	Auth::login($user);

	Auth::login(15);

<a name="filter"></a>
## 保护路由(URL)

限制一些路由（URL）仅当用户已经登录才能访问是很常见的设计，在Laravel中可以使用[auth过滤器](/docs/routing#filters)实现。如果用户已经登录请求就会被正常处理，如果用户没有登录，他们将被重定向到“login”[命名路由](/docs/routing#named-routes)。

通过绑定**auth**过滤器来保护URL：

	Route::get('admin', array('before' => 'auth', function() {}));

> **注意:** 你可以任意修改**auth**过滤器，在 **application/routes.php**中有一个默认的实现。

<a name="user"></a>
## 获取已登录用户

一旦用户登录到系统，你就可以对过Auth类的**user**方法来访问用户模型：

	return Auth::user()->email;

> **注意:** 如果用户没有登录，user方法将返回空(NULL)。

<a name="logout"></a>
## 退出登录

要使用户退出登录，只需要调用**logout**方法：

	Auth::logout();

此方法将会移除用户session的数据，此后用户的访问将不再被当作“已登录”状态。