# Input & Cookies

## 目录

- [Input](#input)
- [JSON Input](#json)
- [Files](#files)
- [Old Input](#old-input)
- [Redirecting With Old Input](#redirecting-with-old-input)
- [Cookies](#cookies)
- [Merging & Replacing](#merge)

<a name="input"></a>
## Input

**Input**类会处理应用程序中来自GET、POST、PUT或者DELETE类型的请求。下面是一些用Input类来访问Input数据的例子：

#### 获取input数组中指定的值：

	$email = Input::get('email');

> **Note:** "get"方法适用于所有类型(GET,POST,PUT和DELETE)的请求，而不仅仅是指GET请求。

#### 获取input数组中的所有数据：

	$input = Input::get();

#### 获取所有input数据，包括$_FILES数组：

	$input = Input::all();

默认情况下，如果获取的input数据不存在时会返回*null*值。不过你可以通过给函数传递第二个参数来替代*null*值：

#### 当请求的数据不存在时返回一个默认值：

	$name = Input::get('name', 'Fred');

#### 把匿名函数作为默认返回值：

	$name = Input::get('name', function() {return 'Fred';});

#### 检查input数组中是否包含指定条目：

	if (Input::has('name')) ...

> **Note:** 当检查的数据不存在的时候"has"方法会返回*false*。

<a name="json"></a>
## JSON Input

当使用像Backbone.js这样的JavaScript MVC框架时，你可能需要获取应用程序发送的JSON数据。Laravel框架提供了'Input::json'方法使你的工作更加轻松：

#### 获取来自应用程序的JSON数据：

	$data = Input::json();

<a name="files"></a>
## 文件类

#### 获取$_FILES数组：

	$files = Input::file();

#### 获取$_FILES数组中的指定数据：

	$picture = Input::file('picture');

#### 获取$_FILES数组中特定条目的size:

	$size = Input::file('picture.size');

<a name="old-input"></a>
## Old Input

You'll commonly need to re-populate forms after invalid form submissions. Laravel's Input class was designed with this problem in mind. Here's an example of how you can easily retrieve the input from the previous request. First, you need to flash the input data to the session:

#### Flashing input to the session:

	Input::flash();

#### Flashing selected input to the session:

	Input::flash('only', array('username', 'email'));

	Input::flash('except', array('password', 'credit_card'));

#### Retrieving a flashed input item from the previous request:

	$name = Input::old('name');

> **Note:** You must specify a session driver before using the "old" method.

*Further Reading:*

- *[Sessions](/docs/session/config)*

<a name="redirecting-with-old-input"></a>
## Redirecting With Old Input

Now that you know how to flash input to the session. Here's a shortcut that you can use when redirecting that prevents you from having to micro-manage your old input in that way:

#### Flashing input from a Redirect instance:

	return Redirect::to('login')->with_input();

#### Flashing selected input from a Redirect instance:

	return Redirect::to('login')->with_input('only', array('username'));

	return Redirect::to('login')->with_input('except', array('password'));

<a name="cookies"></a>
## Cookies

Laravel provides a nice wrapper around the $_COOKIE array. However, there are a few things you should be aware of before using it. First, all Laravel cookies contain a "signature hash". This allows the framework to verify that the cookie has not been modified on the client. Secondly, when setting cookies, the cookies are not immediately sent to the browser, but are pooled until the end of the request and then sent together. This means that you will not be able to both set a cookie and retrieve the value that you set in the same request.

#### Retrieving a cookie value:

	$name = Cookie::get('name');

#### Returning a default value if the requested cookie doesn't exist:

	$name = Cookie::get('name', 'Fred');

#### Setting a cookie that lasts for 60 minutes:

	Cookie::put('name', 'Fred', 60);

#### Creating a "permanent" cookie that lasts five years:

	Cookie::forever('name', 'Fred');

#### Deleting a cookie:

	Cookie::forget('name');

<a name="merge"></a>
## Merging & Replacing

Sometimes you may wish to merge or replace the current input. Here's how:

#### Merging new data into the current input:

	Input::merge(array('name' => 'Spock'));

#### Replacing the entire input array with new data:

	Input::merge(array('doctor' => 'Bones', 'captain' => 'Kirk'));
