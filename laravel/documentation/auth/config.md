# 配置Auth

## 目录

- [Auth基础](#the-basics)
- [Auth驱动](#driver)
- [默认“用户名”](#username)
- [Auth模型](#model)
- [Auth表](#table)

<a name="the-basics"></a>
## Auth基础

几乎所有的应用都有让用户登录和退出的功能。Laravel提供一个简单的类帮助你验证用户登录凭证和获取当前用户信息。

我们从文件 **application/config/auth.php** 开始，Auth配置包含一些基本的配置项以帮助你起步。

<a name="driver"></a>
## Auth驱动

Laravel的Auth是基于驱动的，这意味着获取用户信息的职责将交由不同的“驱动”来处理。框架自带两个驱动：Eloquent和Fluent，然而这并不限制你根据需要设计你自己的驱动。

** Eloquent** 驱动使用Eloquent ORM来为你的应用加载用户信息，它是默认的驱动。 而 **Fluent** 使用Fluent 查询构造器来加载数据。

<a name="username"></a>
## 默认“用户名”

配置文件中第二个选项是用户的默认“用户名”，一般它对应你用户数据表中的字段，比如“email”或“username”。

<a name="model"></a>
## Auth模型

当你使用**Eloquent**驱动时，此选项指定用于加载用户信息的Eloquent模型。

<a name="table"></a>
## Auth表

当使用**Fluent**驱动时，此选项指定用于加载用户信息的数据表。