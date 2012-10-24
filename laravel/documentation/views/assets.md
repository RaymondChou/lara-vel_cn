# 管理资源(Assets)

## 目录

- [注册资源](#registering-assets)
- [使用资源](#dumping-assets)
- [资源依赖](#asset-dependencies)
- [资源容器](#asset-containers)
- [组件资源](#bundle-assets)

<a name="registering-assets"></a>
## 注册资源

**Asset**类提供一种简单地管理你的应用使用的CSS和JavaScript。只需要调用**Asset**类的**add**方法即可注册一个资源：

#### 注册一个资源：

	Asset::add('jquery', 'js/jquery.js');

**add**方法接受3个参数，每一个是资源的名称，第二个是资源相对**public**目录的路径，第三个是一个资源依赖的列表。注意，我们并没有指定我们是要注册JS还是CSS，**add**方法会根据文件扩展名来判断我们注册的文件类型。

<a name="dumping-assets"></a>
## 使用资源

当你准备把资源插入到你的视图的时候，你可能需要使用**styles**或**scripts**方法：

#### 使用资源到视图：

	<head>
		<?php echo Asset::styles(); ?>
		<?php echo Asset::scripts(); ?>
	</head>

<a name="asset-dependencies"></a>
## 资源依赖

有时你需要指定一个资源依赖其它资源，这意味着资源需要别的资源在视力中先被申明。只要你记住资源的名称，指定依赖就相当简单，你可以把被依赖的资源的名称写入**add**的第三个参数来申明依赖：

#### 注册一个含有依赖的资源：

	Asset::add('jquery-ui', 'js/jquery-ui.js', 'jquery');

在这个例子中，我们注册了叫**jquety-ui**的资源，也指定了他依赖于**jquery**，现在当你把资源连接到你的视图时，jQuery的资源总是先于jQuery UI的资源申明，当需要定义多个依赖时：

#### 注册一个含有多个依赖的资源：

	Asset::add('jquery-ui', 'js/jquery-ui.js', array('first', 'second'));

<a name="asset-containers"></a>
## 资源容器

为了提高反应速度，把JavaScript放在HTML文档的最后是很常见的，但如果你总需要在文档的头部放入资源怎么办呢？没问题，**Asset**类提供一个简单的管理资源容器的方法（**containers**）。只需要简单的调用Asset的**container**方法并指定容器名称，你就可以使用你熟悉的语法指定任意资源到容器：

#### 获取一个资源容器的实例：

	Asset::container('footer')->add('example', 'js/example.js');

#### 从一个资源容器使用资源：

	echo Asset::container('footer')->scripts();

<a name="bundle-assets"></a>
## 组件资源(Bundle Assets)

在你学习如何方便的增加和使用组件资源之前，你也许可以读一下[创建和发布组件资源](/docs/bundles#bundle-assets)。

在注册资源时，一般资源路径都是相对**public**目录的，然而这对处理组件资源是显示不很方便了，因为它他们位于**public/bundles**目录。但是，请记住，Laravel的存在是使你的生活更容易，因此指定是何资源容器管理资源是非常简单的。

#### 指定资源管容器指定的组件：

	Asset::container('foo')->bundle('admin');

现在，当你增加一个资源，你就可以使用相对于组件自己的public目录的相对目录来指定资源了。Laravel将为你生成正确的路径。