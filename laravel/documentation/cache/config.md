# 缓存配置

## 目录

- [基础](#the-basics)
- [数据库](#database)
- [Memcached](#memcached)
- [Redis](#redis)
- [缓存混淆键](#keys)
- [内存中缓存](#memory)

<a name="the-basics"></a>
## 基础

假设你的应用展示了用户投票最多的10首流行歌曲,你真的需要在每个人访问你的网站的时候都去查一遍这10首歌吗?如果你想按10分钟或者是一小时的频率来缓存查询结果去加速你的应用,Laravel的Caching缓存模块将使该工作变得异常简单.

Laravel 为我们提供了5种类型的缓存驱动:

- 文件系统
- 数据库
- Memcached
- APC
- Redis
- 内存 (Arrays)

默认情况下,Laravel使用**文件**系统作为缓存的驱动, 这是不需配置就可使用的, 文件系统驱动会将缓存的数据存入缓存目录下的文件里面去, 如果你觉得合适的话不需要做任何其他的配置直接开始用就行了.

> **注意:** 在使用文件系统作为缓存驱动之前,请确保你的 **storage/cache** 目录是可写的.

<a name="database"></a>
## 数据库

数据库缓存驱动使用一个给定的数据表来作为一个简单的 键-值 对存储器. 在使用之前, 首先在 **application/config/cache.php** 中设置好数据表的名称:

	'database' => array('table' => 'laravel_cache'),

然后, 在你的数据库中创建该表. 这个表需要有如下三列:

- key (varchar)
- value (text)
- expiration (integer)

就是这样. 一旦你配置完成并建立了所需表, 你就可以开始缓存数据了!

<a name="memcached"></a>
## Memcached

[Memcached](http://memcached.org) 是一个极速, 开源发行的内存对象缓存系统, 并被 Wikipedia 和 Facebook 等网站所使用. 在使用 Laravel 的 Memcached 驱动之前, 你需要在你的服务器上安装并配置好 Memcached 和 PHP 的 Memcached 扩展.

一旦你在服务器上安装好了Memcached, 还要在 **application/config/cache.php** 配置文件里设置好 **driver** 选项:

	'driver' => 'memcached'

然后, 添加你的 Memcached 服务器到 **servers** 数组中去:

	'servers' => array(
	     array('host' => '127.0.0.1', 'port' => 11211, 'weight' => 100),
	)

<a name="redis"></a>
## Redis

[Redis](http://redis.io) 是一个开源的, 高级的 键-值 对存储器. 它通常被归为一种数据结构服务器, 因为它的键可以包含 [字符串](http://redis.io/topics/data-types#strings), [哈希表](http://redis.io/topics/data-types#hashes), [列表](http://redis.io/topics/data-types#lists), [集合](http://redis.io/topics/data-types#sets), 还有 [有序集合](http://redis.io/topics/data-types#sorted-sets).

在使用 Redis 缓存驱动之前, 你需要 [配置你的Redis服务器](/docs/database/redis#config). 现在你只需要在 **application/config/cache.php** 配置文件里面设置好 **driver** 选项就行了:

	'driver' => 'redis'

<a name="keys"></a>
### 缓存混淆键

To avoid naming collisions with other applications using APC, Redis, or a Memcached server, Laravel prepends a **key** to each item stored in the cache using these drivers. Feel free to change this value:

	'key' => 'laravel'

<a name="memory"></a>
### 内存中缓存

The "memory" cache driver does not actually cache anything to disk. It simply maintains an internal array of the cache data for the current request. This makes it perfect for unit testing your application in isolation from any storage mechanism. It should never be used as a "real" cache driver.