<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Laravel 中文手册 - 巨匠级PHP开发框架</title>
	<meta name="viewport" content="width=device-width">

	{{ HTML::style(URL::$base.'/laravel/css/style.css') }}
	{{ HTML::script(URL::$base.'/laravel/js/modernizr-2.5.3.min.js') }}
</head>
<body onload="prettyPrint()">
	<div class="wrapper">
		<header>
			<h1>Laravel</h1>
			<h2>巨匠级PHP开发框架</h2>
            <a href="http://laravel-cn.com"><-返回Laravel中国首页</a>

			<p class="intro-text">
			</p>
		</header>
		<div role="main" class="main">
			<aside class="sidebar">
				{{ $sidebar }}
			</aside>
			<div class="content">
				@yield('content')
			</div>
		</div>
	</div>
	{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js') }}
	{{ HTML::script(URL::$base.'/laravel/js/prettify.js') }}
	{{ HTML::script(URL::$base.'/laravel/js/scroll.js') }}
</body>
<script type="text/javascript">
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fcbd85e238f6c8a54c657bdd653d81015' type='text/javascript'%3E%3C/script%3E"));
</script>
</html>
