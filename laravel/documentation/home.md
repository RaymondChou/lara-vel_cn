# Laravel 中文文档

- [基础](#the-basics)
- [Laravel适合谁?](#who-will-enjoy-laravel)
- [Laravel有什么不同?](#laravel-is-different)
- [应用程序结构](#application-structure)
- [Laravel社区](#laravel-community)
- [许可证](#laravel-license)

<a name="the-basics"></a>
## 基础

欢迎阅读Laravel中文文档. 文档被设计为一种新手指引,也可作为一个功能性的参考。 可能你跳进任何部分，并开始学习，但我们还是建议您阅读文档，因为它允许我们逐步建立在以后的文件中使用的概念。

<a name="who-will-enjoy-laravel"></a>
## Laravel适合谁?

Laravel是一个功能强大的框架，强调灵活性和表现力。新的Laravel的用户将享受相同的易用性的开发，Laravel是最流行的轻量级PHP框架。 有经验的用户会很高兴有机会找到他们的代码模块化的方式，是其他框架中没有的。 Laravel的灵活性，将允许您组织更新和模块化你的程序，需要随着时间的推移，其表现将让您和您的团队开发出既简洁又易读的代码。


<a name="laravel-is-different"></a>
## Laravel有什么不同?

Laravel和其他框架相比有很多不同. 这里列举一些我们认为比较好的几点:

- **Bundles扩展包** Bundles是Laravel的组件包系统。Laravel的Bundles已填充了相当多的功能，可以很容易地添加到您的应用程序。您可以Artisan命令行工具来自动安装它们。[The Laravel Bundle Repository](http://bundles.laravel.com/)
- **The Eloquent ORM** ELOQUENT ORM是最先进的PHP ActiveRecord实现。ELOQUENT ORM拥有所有ActiveRecord的便利，你可以完全控制你的数据。ELOQUENT ORM支持Fluent query-builder的所有原生方法.
- **Application Logic** 在您的应用程序可以使用控制器，或直接进入路由的声明语法,类似Sinatra的框架，可以实现应用程序逻辑。 Laravel的设计与开发人员提供他们所需要的灵活性，方便创造从非常小的网站到大型的企业应用程序。
- **Reverse Routing反向路由** 反向路由使您可以创建链接到已命名路由规则上。创建链接时使用路由的名称,Laravel会自动插入正确的URI。这可以让你改变你的路由,在稍后的时间Laravel将更新站点范围内的所有相关链接。
- **Restful Controllers** Restful Controllers是一个可选的方式,分离你的请求逻辑。在一个登录的例子中,你控制器里get_login()的动作将显示登陆页,你控制器的post_login()动作会接受的登陆，验证，和或者重定向到其他页面。
- **Class Auto Loading** keeps you from having to maintain an autoloader configuration and from loading unnecessary components when they won't be used. Want to use a library or model?  Don't bother loading it, just use it. Laravel will handle the rest.
- **View Composers** View Composers是一个当视图中可以运行的代码块. 一个博客的随机博客文章列表是一个很好的例子。Composers将包含逻辑加载的博客文章，这一切都为你准备好了,只要调用您的模型即可
- **The IoC container** (Inversion of Control) gives you a method for generating new objects and optionally instantiating and referencing singletons. IoC means that you'll rarely ever need to bootstrap any external libraries. It also means that you can access these objects from anywhere in your code without needing to deal with an inflexible monolithic structure. 
- **Migrations** are version control for your database schemas and they are directly integrated into Laravel. You can both generate and run migrations using the "Artisan" command-line utility. Once another member makes schema changes you can update your local copy from the repository and run migrations. Now you're up to date, too!
- **Unit-Testing** is an important part of Laravel. Laravel itself sports hundreds of tests to help ensure that new changes don't unexpectedly break anything. This is one of the reasons why Laravel is widely considered to have some of the most stable releases in the industry.  Laravel also makes it easy for you to write unit-tests for your own code.  You can then run tests with the "Artisan" command-line utility.
- **Automatic Pagination** prevents your application logic from being cluttered up with a bunch of pagination configuration. Instead of pulling in the current page, getting a count of db records, and selected your data using a limit/offset just call 'paginate' and tell Laravel where to output the paging links in your view. Laravel automatically does the rest. Laravel's pagination system was designed to be easy to implement and easy to change. It's also important to note that just because Laravel can handle these things automatically doesn't mean that you can't call and configure these systems manually if you prefer.

These are just a few ways in which Laravel differentiates itself from other PHP frameworks.  All of these features and many more are discussed thoroughly in this documentation.

<a name="application-structure"></a>
## 应用程序结构

Laravel's directory structure is designed to be familiar to users of other popular PHP frameworks. Web applications of any shape or size can easily be created using this structure similarly to the way that they would be created in other frameworks.

However due to Laravel's unique architecture, it is possible for developers to create their own infrastructure that is specifically designed for their application. This may be most beneficial to large projects such as content-management-systems. This kind of architectural flexibility is unique to Laravel.

Throughout the documentation we'll specify the default locations for declarations where appropriate.

<a name="laravel-community"></a>
## Laravel社区

Laravel is lucky to be supported by rapidly growing, friendly and enthusiastic community. The [Laravel Forums](http://forums.laravel.com) are a great place to find help, make a suggestion, or just see what other people are saying.

Many of us hang out every day in the #laravel IRC channel on FreeNode. [Here's a forum post explaining how you can join us.](http://forums.laravel.com/viewtopic.php?id=671) Hanging out in the IRC channel is a really great way to learn more about web-development using Laravel. You're welcome to ask questions, answer other people's questions, or just hang out and learn from other people's questions being answered. We love Laravel and would love to talk to you about it, so don't be a stranger!

<a name="laravel-license"></a>
## 许可证

Laravel is open-sourced software licensed under the [MIT License](http://www.opensource.org/licenses/mit-license.php).