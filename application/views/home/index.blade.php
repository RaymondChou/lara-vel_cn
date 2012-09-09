<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Laravel 中国 - 巨匠级PHP开发框架 Laravel 中国社区</title>
    <meta name="keywords" content="Laravel,laravel,php,框架,MVC,简单,易用,最好" />
    <meta name="description" content="Laravel 是一个简单优雅的 PHP WEB 开发框架，将你从意大利面条式的代码中解放出来。通过简单的、高雅、表达式语法开发出很棒的 Web 应用。">
    <meta name="author" content="Zhouyt">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- LOCAL VERSION - This version doesn't require a web server to show the page properly -->
    <link rel="stylesheet" href="css/skeleton-v1.1.css">
    <link rel="stylesheet" href="css/flexslider-v1.8.css">
    <link rel="stylesheet" href="css/main-r6.css">
    <link rel="stylesheet" href="css/media-queries-r6.css">
    <link rel="stylesheet" href="css/sprites-r6.css">
    <link rel="stylesheet" href="css/theme-default-r6.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,400italic' rel='stylesheet' type='text/css'>

    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">

    <!-- Allow IE to render HTML5 -->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<div id="main" role="main">

<header>
    <div class="container">
        <h1 class="logo one-third column alpha">
            <a href="/">
                <img src="img/logo.png" alt="Spark" class="scale-with-grid" />
                <img src="img/logo-mobile.png" alt="Spark" class="scale-with-grid mobile-only" /><!-- Alternative image for mobile devices -->
            </a>
        </h1>

        <nav class="menu two-thirds column omega">
            <ul>
                <li><a href="#home" class="active">首页<br /><span></span></a></li>
                <li><a href="#features">特点<br /><span></span></a></li>
                <li><a href="#pricing">下载<br /><span></span></a></li>
                <li><a href="#contact">关于<br /><span></span></a></li>
                <li><a href="docs">中文手册<br /><span></span></a></li>
                <li><a href="#contact">中文社区<br /><span></span></a></li>
            </ul>
        </nav>
    </div><!-- .container -->

    <div class="bottom-gradient">
        <span class="left"></span>
        <span class="center"></span>
        <span class="right"></span>
    </div>
</header>

<article id="home">
    <div class="container">
        <div class="row box dark">
            <div class="seven columns">
                <div class="welcome-container">
                    <h1>巨匠级PHP开发框架</h1>
                    <p>Laravel 是一个简单优雅的 PHP WEB 开发框架，将你从意大利面条式的代码中解放出来。通过简单、高雅、表达式语法开发出很棒的 WEB应用!</p>
                    <p class="hide-for-mobile">开发应该是一个创造性的过程,
                        让你你享受，而不是让你很痛苦的事情。Laravel让你享受新鲜的空气。
                    </p>
                    <a href="http://laravel.com/download" target="_blank" class="button call-to-action animate" style="color: #FBCC62">下载最新版 3.2.7</a>
                </div>
            </div>

            <div class="nine columns">
                <div class="flexslider">
                    <ul class="slides notloaded">
                        <li><img src="img/slides/silde1.jpg" alt="" /></li>
                        <li><img src="img/slides/comu.jpg" alt="" /></li>
                        <li><img src="img/slides/slide2.jpg" alt="" /></li>
                    </ul>
                </div>
            </div>
        </div><!-- .row -->

        <div class="row">
            <div class="one-third column headset">
                <img src="img/empty.gif" alt="" class="large-icons icon-menu" />
                <h4>英文官网</h4>
                <p>Go Ahead, <a href="http://laravel.com" target="_blank" class="animate">Laravel.com</a></p>
            </div>

            <div class="one-third column headset">
                <img src="img/empty.gif" alt="" class="large-icons icon-layers" />
                <h4>开源,并托管于GitHub</h4>
                <p>Go Ahead, <a href="https://github.com/laravel/laravel" target="_blank" class="animate">GitHub</a></p>
            </div>

            <div class="one-third column headset">
                <img src="img/empty.gif" alt="" class="large-icons icon-resize" />
                <h4>丰富的文档</h4>
                <p>Go Ahead, <a href="docs" class="animate">中文手册</a> <a href="http://laravel.com/api/" class="animate" target="_blank">API</a></p>
            </div>
        </div><!-- .row -->

        <div class="bottom-gradient between-rows">
            <span class="left"></span>
            <span class="center"></span>
            <span class="right"></span>
        </div>

        <div class="row">
            <div class="two-thirds column">
                <h4>为什么选择 Laravel?</h4>
                <p>为什么选择Laravel而不是 CodeIgniter, Fuel, {其他框架…}.这里是我选择Laravel的几个主要原因:</p>
                <ul class="tabs">
                    <li><a class="active" href="#simple">表现力</a></li>
                    <li><a href="#lightweight">简单性</a></li>
                    <li><a href="#mobileFriendly">可用性</a></li>
                </ul>

                <ul class="tabs-content">
                    <li class="active" id="simple">你知道下面这行代码里 “true” 代表什么意思么?<br>

                        $uri = Uri::create(‘some/uri’, array(), array(), true);<br>

                        另外，你知道其他参数在这里的意思么（除了第一个）？当然你不知道。因为这行代码没有表现力。 表现力 （形容词）： 有效地表达的思想或意思 再看看这段代码:<br>

                        $url = URL::to_secure(‘some/uri’);<br>

                        这个表达式使用HTTPS协议创建了一条URL链接， 事实上，上面两种写法都在做同样的事情，但那一个更一目了然，更富有表现力呢？<br>

                    </li>
                    <li id="lightweight">我们还需要实现其他功能，如验证、 分页等。所有这一切在 Laravel 中都实现的更简单，没有让人抓狂的的配置文件。想要进行用户信息分页显示时预加载用户发布的文章么？没问题：<br>

                        $users = User::with(‘posts’)->paginate();<br>

                        echo $users->links();<br>
                    </li>
                    <li id="mobileFriendly">CodeIgniter非常流行原因之一是它有良好的文档。这对程序员来说是十分方便的。相比之下，Kohana一个在技术上比CodeIgniter更加优秀的框架，但你猜怎么着？ 大家不在乎Kohana技术有多强，因为Kohana的文档实在是太糟了。<br>
                        Laravel 有一个非常棒的的社区支持。Laravel代码本身的表现力和良好的文档使PHP程序编写令人愉快。
                    </li>
                </ul>
                <p class="add-top">The tabs are built from two list elements, take a look at the source code, it's really simple!</p>
            </div><!-- .columns -->

            <div class="one-third column">
                <h4>Laravel有一个健壮的开发团队</h4>
                <p>Taylor Otwell于2011年4月创造了Laravel.</p>
                <p>Laravel是一个致力于优雅和简洁的PHP框架。编程不必须是痛苦的。事实上，Laravel是可以让你享受的工具。</p>
                <img src="img/modern.jpg" alt="" class="scale-with-grid featured" />
            </div><!-- .columns -->
        </div><!-- .row -->

    </div><!-- .container -->
</article>


<article id="features" class="dark">
    <div class="container">
        <div class="sixteen columns titleset">
            <h2 class="remove-bottom">特点</h2>
            <h6 class="subheader">There are many ways in which Laravel differentiates itself from other frameworks.</h6>
        </div>

        <div class="row">
            <div class="one-third column headset">
                <img src="img/empty.gif" alt="" class="large-icons icon-dashboard" />
                <h3>Application Logic</h3>
                <p>在您的应用程序可以使用控制器，或直接进入路由的声明语法,类似Sinatra的框架，可以实现应用程序逻辑。 Laravel的设计与开发人员提供他们所需要的灵活性，方便创造从非常小的网站到大型的企业应用程序。</p>
            </div>

            <div class="one-third column headset">
                <img src="img/empty.gif" alt="" class="large-icons icon-globe" />
                <h3>路由Reverse Route</h3>
                <p>反向路由使您可以创建链接到已命名路由规则上。创建链接时使用路由的名称,Laravel会自动插入正确的URI。这可以让你改变你的路由,在稍后的时间Laravel将更新站点范围内的所有相关链接。</p>
            </div>

            <div class="one-third column headset">
                <img src="img/empty.gif" alt="" class="large-icons icon-link" />
                <h3>控制器Restful</h3>
                <p>Restful Controllers是一个可选的方式,分离你的请求逻辑。在一个登录的例子中,你控制器里get_login()的动作将显示登陆页,你控制器的post_login()动作会接受的登陆，验证，和或者重定向到其他页面。</p>
            </div>
        </div><!-- .row -->

        <div class="row">
            <div class="one-third column headset">
                <img src="img/empty.gif" alt="" class="large-icons icon-grid" />
                <h3>ELOQUENT ORM</h3>
                <p>ELOQUENT ORM是最先进的PHP ActiveRecord实现。ELOQUENT ORM拥有所有ActiveRecord的便利，你可以完全控制你的数据。ELOQUENT ORM支持Fluent query-builder的所有原生方法</p>
            </div>

            <div class="one-third column headset">
                <img src="img/empty.gif" alt="" class="large-icons icon-cloud" />
                <h3>扩展包Bundles</h3>
                <p>Bundles是Laravel的组件包系统。Laravel的Bundles已填充了相当多的功能，可以很容易地添加到您的应用程序。您可以Artisan命令行工具来自动安装它们。</p>
            </div>

            <div class="one-third column headset">
                <img src="img/empty.gif" alt="" class="large-icons icon-cert" />
                <h3>View Composers</h3>
                <p>View Composers是一个当视图中可以运行的代码块. 一个博客的随机博客文章列表是一个很好的例子。Composers将包含逻辑加载的博客文章，这一切都为你准备好了,只要调用您的模型即可</p>
            </div>
        </div><!-- .row -->
    </div><!-- container -->
</article>


<article id="pricing">
    <div class="container">

        <div class="sixteen columns titleset">
            <h2 class="remove-bottom">下载</h2>
            <h6 class="subheader">Laravel资源</h6>
        </div>


        <div class="one-third column">
            <div class="headset price clearfix">
                <img src="img/empty.gif" alt="" class="large-icons icon-font" />
                <h4>扩展包Bundles</h4>
                <span></span>
            </div>
            <div class="bottom-gradient add-top add-bottom">
                <span class="left"></span>
                <span class="center"></span>
                <span class="right"></span>
            </div>
            <p>This section offers great possibilities to compare plans, products, subscriptions or to just price your services in a clear and distinguish way.</p>
            <ul class="disc">
                <li>Cross-browser</li>
                <li>Fast-loading</li>
                <li>Bookmarkable URLs</li>
                <li>W3C Standards</li>
            </ul>
            <a href="http://bundles.laravel.com/" target="_blank" class="button featured animate">官网</a>
        </div><!-- .columns -->

        <div class="one-third column box light featured">
            <div class="headset price clearfix">
                <img src="img/empty.gif" alt="" class="large-icons icon-pin" />
                <h4>Laravel 3.2.7</h4>
                <span></span>
            </div>
            <div class="bottom-gradient add-top add-bottom">
                <span class="left"></span>
                <span class="center"></span>
                <span class="right"></span>
            </div>
            <p>This section offers great possibilities to compare plans, products, subscriptions or to just price your services in a clear and distinguish way.</p>
            <ul class="disc">
                <li>SEO Optimised</li>
                <li>Browser History</li>
                <li>Enterprise-level Website</li>
                <li>Accessibility</li>
            </ul>
            <a href="http://laravel.com/download" target="_blank" class="button featured animate">下载</a>
        </div><!-- .columns -->

        <div class="one-third column">
            <div class="headset price clearfix">
                <img src="img/empty.gif" alt="" class="large-icons icon-burst" />
                <h4>离线中文文档包</h4>
                <span></span>
            </div>
            <div class="bottom-gradient add-top add-bottom">
                <span class="left"></span>
                <span class="center"></span>
                <span class="right"></span>
            </div>
            <p>This section offers great possibilities to compare plans, products, subscriptions or to just price your services in a clear and distinguish way.</p>
            <ul class="disc">
                <li>Grid System Layout</li>
                <li>Built for Performance</li>
                <li>Focus on flow and conversions</li>
                <li>Dynamic URL update</li>
            </ul>
            <a href="#contact" class="button featured animate">敬请期待</a>
        </div><!-- .columns -->

    </div><!-- container -->
</article>


<article id="contact" class="dark">
    <div class="container">

        <div class="sixteen columns titleset">
            <h2 class="remove-bottom">Contact Us</h2>
            <h6 class="subheader">We'd love to hear from you!</h6>
        </div>

        <div class="two-thirds column">
            <h3>Talk to Us</h3>
            <p>This form uses the newest HTML5 tags and has graceful fallback for old browsers (ie. the email field requires to be filled with an email). It is sent through Ajax using the jQuery.post() method - <strong>Simple and Effective</strong>.</p>

            <form action="ajax.php" method="post" class="send-with-ajax">

                <div class="row">
                    <div class="three columns alpha">
                        <label for="form-name">Your Name <span>required</span></label>
                    </div>
                    <div class="seven columns omega">
                        <input type="text" name="name" id="form-name" placeholder="Your Name" required="required" />
                    </div>
                </div>

                <div class="row">
                    <div class="three columns alpha">
                        <label for="form-email">Your Email <span>email required</span></label>
                    </div>
                    <div class="seven columns omega">
                        <input type="email" name="email" id="form-email" placeholder="your@email.com" required="required" />
                    </div>
                </div>

                <div class="row">
                    <div class="three columns alpha">
                        <label for="form-message">Message</label>
                    </div>
                    <div class="seven columns omega">
                        <textarea name="message" id="form-message"></textarea>
                    </div>
                </div>

                <div class="seven columns offset-by-three">
                    <button type="submit">Submit Form</button>
                    <div class="ajax-response"></div>
                </div>

            </form>

        </div><!-- .column -->

        <div class="one-third column">
            <h3>Find Us</h3>
            <h5>Our Offices:</h5>
            <p>
                5th Ave.<br />
                New York, New York 10001<br />
                (212) 222-1111<br />
                <a href="mailto:contact@maddim.com">contact@maddim.com</a>
            </p>

            <p><a class="targetblank" href="http://maps.google.com/maps?saddr=5th+Ave&amp;hl=en&amp;ll=40.754149,-73.980035&amp;spn=0.005445,0.009195&amp;sll=40.775992,-73.960218&amp;sspn=0.021774,0.036778&amp;geocode=FXfabQId_CSX-w&amp;vpsrc=6&amp;mra=mr&amp;t=m&amp;z=17">
                <img src="img/map.jpg" alt="" class="scale-with-grid featured" />
            </a></p>
            <h5>On The Web:</h5>
            <a href="http://www.facebook.com/" class="targetblank imglink">
                <img src="img/empty.gif" alt="Facebook" title="Facebook" class="medium-icons icon-facebook" />
            </a>
            <a href="http://www.twitter.com/" class="targetblank imglink">
                <img src="img/empty.gif" alt="Twitter" title="Twitter" class="medium-icons icon-twitter" />
            </a>
        </div>

    </div><!-- container -->
</article>

</div><!-- #main -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery-1.7.1.min.js"><\/script>')</script>
<!-- LOCAL VERSION - This version doesn't require a web server to show the page properly -->
<script src="js/jquery.flexslider-v1.8.min.js"></script>
<script src="js/jquery.ba-hashchange-v1.3.min.js"></script>
<script src="js/main-r6.js"></script>
<script type="text/javascript">
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fcbd85e238f6c8a54c657bdd653d81015' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>