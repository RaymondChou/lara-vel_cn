# 事件类

## Contents

- [基础](#the-basics)
- [触发事件](#firing-events)
- [监听事件](#listening-to-events)
- [事件队列](#queued-events)
- [Laravel默认事件](#laravel-events)

<a name="the-basics"></a>
## The Basics

事件类为建立耦合应用提供了极大的灵活性，它允许以插件的形式嵌入应用程序的核心代码中，而无需修改程序代码。

<a name="firing-events"></a>
## 触发事件

需要触发事件时，只要将事件名传递给**Event**类：

#### 触发‘loaded’事件:

	$responses = Event::fire('loaded');

在例子中我们把**fire**方法的返回结果赋值给了$responses变量。**fire**方法可以同时触发多个事件，并返回一个包含所有事件返回结果的数组。

有时候，我们在触发事件后只想获取第一个事件的返回结果，可以用first方法：

#### 触发一个事件，并返回第一个结果:

	$response = Event::first('loaded');

> **Note:** The **first** method will still fire all of the handlers listening to the event, but will only return the first response.

The **Event::until** method will execute the event handlers until the first non-null response is returned.

#### Firing an event until the first non-null response:

	$response = Event::until('loaded');

<a name="listening-to-events"></a>
## Listening To Events

So, what good are events if nobody is listening? Register an event handler that will be called when an event fires:

#### Registering an event handler:

	Event::listen('loaded', function()
	{
		// I'm executed on the "loaded" event!
	});

The Closure we provided to the method will be executed each time the "loaded" event is fired.

<a name="queued-events"></a>
## Queued Events

Sometimes you may wish to "queue" an event for firing, but not fire it immediately. This is possible using the `queue` and `flush` methods. First, throw an event on a given queue with a unique identifier:

#### Registering a queued event:

	Event::queue('foo', $user->id, array($user));

This method accepts three parameters. The first is the name of the queue, the second is a unique identifier for this item on the queue, and the third is an array of data to pass to the queue flusher.

Next, we'll register a flusher for the `foo` queue:

#### Registering an event flusher:

	Event::flusher('foo', function($key, $user)
	{
		//
	});

Note that the event flusher receives two arguments. The first, is the unique identifier for the queued event, which in this case would be the user's ID. The second (and any remaining) parameters would be the payload items for the queued event.

Finally, we can run our flusher and flush all queued events using the `flush` method:

	Event::flush('foo');

<a name="laravel-events"></a>
## Laravel Events

There are several events that are fired by the Laravel core. Here they are:

#### Event fired when a bundle is started:

	Event::listen('laravel.started: bundle', function() {});

#### Event fired when a database query is executed:

	Event::listen('laravel.query', function($sql, $bindings, $time) {});

#### Event fired right before response is sent to browser:

	Event::listen('laravel.done', function($response) {});

#### Event fired when a messaged is logged using the Log class:

	Event::listen('laravel.log', function($type, $message) {});
