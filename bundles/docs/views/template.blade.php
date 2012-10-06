<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Laravel 中文手册 - 巨匠级PHP开发框架</title>
	<meta name="viewport" content="width=device-width">

	{{ HTML::style(URL::$base.'/laravel/css/style1.css') }}
	{{ HTML::script(URL::$base.'/laravel/js/modernizr-2.5.3.min.js') }}
</head>
<body onload="prettyPrint()">
	<div class="wrapper">
		<header>
			<div class="container">
				<h1>{{ HTML::link('http://laravel.com' , 'Laravel' , array('title'=>'点击去往-英文官方网站')) }}</h1>
				<h2>巨匠级PHP开发框架</h2>
				{{ HTML::link(URL::$base , '<-返回Laravel中国首页' , array('title'=>'返回Laravel中国首页' , 'style'=>'float:right;padding-top:40px;')) }}
				<p class="intro-text">
				</p>
			</div>
		</header>
		<div class="mid-content">
			<div role="main" class="container main">
				<div class="row">
					<aside id="docs-sidebar" class="sidebar docs span3">
						{{ $sidebar }}
					</aside>
					<div class="content docs span9">
						<div class="well">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js') }}
	{{ HTML::script(URL::$base.'/laravel/js/prettify.js') }}
	{{ HTML::script(URL::$base.'/laravel/js/scroll.js') }}
	{{ HTML::script(URL::$base.'/laravel/js/main.min.js') }}
</body>
<script type="text/javascript">
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fcbd85e238f6c8a54c657bdd653d81015' type='text/javascript'%3E%3C/script%3E"));
</script>
</html>
