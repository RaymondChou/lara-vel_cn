# Eloquent ORM 对象关系映射

## 目录

- [基础](#the-basics)
- [预定](#conventions)
- [检索模型](#get)
- [统计](#aggregates)
- [插入与更新模型](#save)
- [关系](#relationships)
- [Inserting Related Models](#inserting-related-models)
- [Working With Intermediate Tables](#intermediate-tables)
- [Eager Loading](#eager)
- [Constraining Eager Loads](#constraining-eager-loads)
- [Setter & Getter Methods](#getter-and-setter-methods)
- [Mass-Assignment](#mass-assignment)
- [Converting Models To Arrays](#to-array)
- [Deleting Models](#delete)

<a name="the-basics"></a>
## The Basics

ORM是[对象关系映射](http://en.wikipedia.org/wiki/Object-relational_mapping), Laravel的ORM你肯定会喜欢. 叫做"Eloquent", 因为它使你处理数据库对象和关系时的语法变得宏伟和具有表达性. 通常你需要为每张表定义一个Eloquent模型.下面简单写了一个例子:

	class User extends Eloquent {}

Nice! 注意你的模型继承的是 **Eloquent** 类. 这个类将会提供你使用Eloquent所需要的操作.

> **注意:** 通常情况下, Eloquent模型需要放在 **application/models** 文件夹下.

<a name="conventions"></a>
## 约定

Eloquent对你的数据库结构有一些基本要求:

- 每张表必须有一个名称为 **id** 的主键 (为毛!译者注).
- 模型对应的每张表名必须是复数.

有时你不想被这些限制,当然也可以.只要正确的添加一个静态变量 **table** 在你的模型中:

	class User extends Eloquent {

	     public static $table = 'my_users';

	}

<a name="get"></a>
## 检索模型

检索模型使用Eloquent将是简单且耳目一新的. 最常用的Eloquent模型方法是静态 **find** 方法. 这个方法将检索主键并返回包含每一列的单条数据:

	$user = User::find(1);

	echo $user->email;

find方法将生成一个类似这样的语句:

	SELECT * FROM "users" WHERE "id" = 1

需要检索整个表?使用静态方法 **all** :

	$users = User::all();

	foreach ($users as $user)
	{
	     echo $user->email;
	}

当然,检索整张表不是很有用. 谢天谢地, **每个fluent query builder的方法都可以在Eloquent中使用**. 使用[query builder](/docs/database/fluent)里的静态方法查询你的模型,然后执行 **get** 或 **first** 方法. get方法将会返回一个数组, first方法将会返回单条:

	$user = User::where('email', '=', $email)->first();

	$user = User::where_email($email)->first();

	$users = User::where_in('id', array(1, 2, 3))->or_where('email', '=', $email)->get();

	$users = User::order_by('votes', 'desc')->take(10)->get();

> **注意:** 如果没找到结果,**first** 方法将会返回NULL. **all** 和 **get**将返回空数组.

<a name="aggregates"></a>
## 统计

使用**MIN**, **MAX**, **AVG**, **SUM**, **COUNT** 方法:

	$min = User::min('id');

	$max = User::max('id');

	$avg = User::avg('id');

	$sum = User::sum('id');

	$count = User::count();

当然,你可能想要用where子句限制查询的条数:

	$count = User::where('id', '>', 10)->count();

<a name="save"></a>
## 插入和更新模型

Eloquent的插入模型,让你查表变得不能再简单.首先,实例化一个新的模型.然后,设置他的属性.最后调用**save**方法:(这不是rails吗! 译者注)

	$user = new User;

	$user->email = 'example@gmail.com';
	$user->password = 'secret';

	$user->save();

另外,当你需要插入一条新的记录进入数据库并且返回一个新的记录实例(当插入失败将返回**false**),你可以使用**create**方法.

	$user = User::create(array('email' => 'example@gmail.com'));

更新模型一样简单. 检索你需要更新的一条记录,然后设置属性并保存:

	$user = User::find(1);

	$user->email = 'new_email@gmail.com';
	$user->password = 'new_secret';

	$user->save();

需要为你的数据库记录建立一个更新时间戳? 用Eloquent, 你不需要担心这个. 只需新建一个静态变量**timestamps**在你的模型中:

	class User extends Eloquent {

	     public static $timestamps = true;

	}

然后,在你的表中添加**created_at**和**updated_at** date类型的列. 现在,每当你保存模型,时间戳都将自动更新.不用谢.

> **注意:** 你可以在**application/config/application.php**文件中改变默认的timezone时区.

<a name="relationships"></a>
## 关系
你的数据库表应该与另一个相连，除非你写错了。例如，一个指令应该归属于一个用户，一个文章应该有多个回复,
Eloquent使得定义关系与检索关系模型变得简单且直观，Laravel支持3种关系:

- [一对一](#one-to-one)
- [一对多](#one-to-many)
- [多对多](#many-to-many)

你可以建立一个方法来简单的返回**has\_one**, **has\_many**, **belongs\_to**, **has\_many\_and\_belongs\_to**方法的结果,用于再Eloquent模型中定义一个关系. 下面来介绍每一个:

<a name="one-to-one"></a>
### 一对一

一对一关系是关系中最基本的.例如,我们假设一个用户有一个手机.在Eloquent中使用一段简单的代码来表述这个关系:

	class User extends Eloquent {

	     public function phone()
	     {
	          return $this->has_one('Phone');
	     }

	}

注意相关模型的名称已经传递给了 **has_one** 方法. 你可以使用**phone**方法来检索一个用户的手机:

	$phone = User::find(1)->phone()->first();

Let's examine the SQL performed by this statement. Two queries will be performed: one to retrieve the user and one to retrieve the user's phone:

	SELECT * FROM "users" WHERE "id" = 1

	SELECT * FROM "phones" WHERE "user_id" = 1

Note that Eloquent assumes the foreign key of the relationship will be **user\_id**. Most foreign keys will follow this **model\_id** convention; however, if you want to use a different column name as the foreign key, just pass it in the second parameter to the method:

	return $this->has_one('Phone', 'my_foreign_key');

Want to just retrieve the user's phone without calling the first method? No problem. Just use the **dynamic phone property**. Eloquent will automatically load the relationship for you, and is even smart enough to know whether to call the get (for one-to-many relationships) or first (for one-to-one relationships) method:

	$phone = User::find(1)->phone;

What if you need to retrieve a phone's user? Since the foreign key (**user\_id**) is on the phones table, we should describe this relationship using the **belongs\_to** method. It makes sense, right? Phones belong to users. When using the **belongs\_to** method, the name of the relationship method should correspond to the foreign key (sans the **\_id**). Since the foreign key is **user\_id**, your relationship method should be named **user**:

	class Phone extends Eloquent {

	     public function user()
	     {
	          return $this->belongs_to('User');
	     }

	}

Great! You can now access a User model through a Phone model using either your relationship method or dynamic property:

	echo Phone::find(1)->user()->first()->email;

	echo Phone::find(1)->user->email;

<a name="one-to-many"></a>
### One-To-Many

Assume a blog post has many comments. It's easy to define this relationship using the **has_many** method:

	class Post extends Eloquent {

	     public function comments()
	     {
	          return $this->has_many('Comment');
	     }

	}

Now, simply access the post comments through the relationship method or dynamic property:

	$comments = Post::find(1)->comments()->get();

	$comments = Post::find(1)->comments;

Both of these statements will execute the following SQL:

	SELECT * FROM "posts" WHERE "id" = 1

	SELECT * FROM "comments" WHERE "post_id" = 1

Want to join on a different foreign key? No problem. Just pass it in the second parameter to the method:

	return $this->has_many('Comment', 'my_foreign_key');

You may be wondering: _If the dynamic properties return the relationship and require less keystrokes, why would I ever use the relationship methods?_ Actually, relationship methods are very powerful. They allow you to continue to chain query methods before retrieving the relationship. Check this out:

	echo Post::find(1)->comments()->order_by('votes', 'desc')->take(10)->get();

<a name="many-to-many"></a>
### Many-To-Many

Many-to-many relationships are the most complicated of the three relationships. But don't worry, you can do this. For example, assume a User has many Roles, but a Role can also belong to many Users. Three database tables must be created to accomplish this relationship: a **users** table, a **roles** table, and a **role_user** table. The structure for each table looks like this:

**Users:**

	id    - INTEGER
	email - VARCHAR

**Roles:**

	id   - INTEGER
	name - VARCHAR

**Role_User:**

    id      - INTEGER
	user_id - INTEGER
	role_id - INTEGER

Now you're ready to define the relationship on your models using the **has\_many\_and\_belongs\_to** method:

	class User extends Eloquent {

	     public function roles()
	     {
	          return $this->has_many_and_belongs_to('Role');
	     }

	}

Great! Now it's time to retrieve a user's roles:

	$roles = User::find(1)->roles()->get();

Or, as usual, you may retrieve the relationship through the dynamic roles property:

	$roles = User::find(1)->roles;

As you may have noticed, the default name of the intermediate table is the singular names of the two related models arranged alphabetically and concatenated by an underscore. However, you are free to specify your own table name. Simply pass the table name in the second parameter to the **has\_and\_belongs\_to\_many** method:

	class User extends Eloquent {

	     public function roles()
	     {
	          return $this->has_many_and_belongs_to('Role', 'user_roles');
	     }

	}

By default only certain fields from the pivot table will be returned (the two **id** fields, and the timestamps). If your pivot table contains additional columns, you can fetch them too by using the **with()** method :

	class User extends Eloquent {

	     public function roles()
	     {
	          return $this->has_many_and_belongs_to('Role', 'user_roles')->with('column');
	     }

	}

<a name="inserting-related-models"></a>
## Inserting Related Models

Let's assume you have a **Post** model that has many comments. Often you may want to insert a new comment for a given post. Instead of manually setting the **post_id** foreign key on your model, you may insert the new comment from it's owning Post model. Here's what it looks like:

	$comment = new Comment(array('message' => 'A new comment.'));

	$post = Post::find(1);

	$comment = $post->comments()->insert($comment);

When inserting related models through their parent model, the foreign key will automatically be set. So, in this case, the "post_id" was automatically set to "1" on the newly inserted comment.

<a name="has-many-save"></a>
When working with `has_many` relationships, you may use the `save` method to insert / update related models:

	$comments = array(
		array('message' => 'A new comment.'),
		array('message' => 'A second comment.'),
	);

	$post = Post::find(1);

	$post->comments()->save($comments);

### Inserting Related Models (Many-To-Many)

This is even more helpful when working with many-to-many relationships. For example, consider a **User** model that has many roles. Likewise, the **Role** model may have many users. So, the intermediate table for this relationship has "user_id" and "role_id" columns. Now, let's insert a new Role for a User:

	$role = new Role(array('title' => 'Admin'));

	$user = User::find(1);

	$role = $user->roles()->insert($role);

Now, when the Role is inserted, not only is the Role inserted into the "roles" table, but a record in the intermediate table is also inserted for you. It couldn't be easier!

However, you may often only want to insert a new record into the intermediate table. For example, perhaps the role you wish to attach to the user already exists. Just use the attach method:

	$user->roles()->attach($role_id);

It's also possible to attach data for fields in the intermediate table (pivot table), to do this add a second array variable to the attach command containing the data you want to attach:

	$user->roles()->attach($role_id, array('expires' => $expires));

<a name="sync-method"></a>
Alternatively, you can use the `sync` method, which accepts an array of IDs to "sync" with the intermediate table. After this operation is complete, only the IDs in the array will be on the intermediate table.

	$user->roles()->sync(array(1, 2, 3));

<a name="intermediate-tables"></a>
## Working With Intermediate Tables

As your probably know, many-to-many relationships require the presence of an intermediate table. Eloquent makes it a breeze to maintain this table. For example, let's assume we have a **User** model that has many roles. And, likewise, a **Role** model that has many users. So the intermediate table has "user_id" and "role_id" columns. We can access the pivot table for the relationship like so:

	$user = User::find(1);

	$pivot = $user->roles()->pivot();

Once we have an instance of the pivot table, we can use it just like any other Eloquent model:

	foreach ($user->roles()->pivot()->get() as $row)
	{
		//
	}

You may also access the specific intermediate table row associated with a given record. For example:

	$user = User::find(1);

	foreach ($user->roles as $role)
	{
		echo $role->pivot->created_at;
	}

Notice that each related **Role** model we retrieved is automatically assigned a **pivot** attribute. This attribute contains a model representing the intermediate table record associated with that related model.

Sometimes you may wish to remove all of the record from the intermediate table for a given model relationship. For instance, perhaps you want to remove all of the assigned roles from a user. Here's how to do it:

	$user = User::find(1);

	$user->roles()->delete();

Note that this does not delete the roles from the "roles" table, but only removes the records from the intermediate table which associated the roles with the given user.

<a name="eager"></a>
## Eager Loading

Eager loading exists to alleviate the N + 1 query problem. Exactly what is this problem? Well, pretend each Book belongs to an Author. We would describe this relationship like so:

	class Book extends Eloquent {

	     public function author()
	     {
	          return $this->belongs_to('Author');
	     }

	}

Now, examine the following code:

	foreach (Book::all() as $book)
	{
	     echo $book->author->name;
	}

How many queries will be executed? Well, one query will be executed to retrieve all of the books from the table. However, another query will be required for each book to retrieve the author. To display the author name for 25 books would require **26 queries**. See how the queries can add up fast?

Thankfully, you can eager load the author models using the **with** method. Simply mention the **function name** of the relationship you wish to eager load:

	foreach (Book::with('author')->get() as $book)
	{
	     echo $book->author->name;
	}

In this example, **only two queries will be executed**!

	SELECT * FROM "books"

	SELECT * FROM "authors" WHERE "id" IN (1, 2, 3, 4, 5, ...)

Obviously, wise use of eager loading can dramatically increase the performance of your application. In the example above, eager loading cut the execution time in half.

Need to eager load more than one relationship? It's easy:

	$books = Book::with(array('author', 'publisher'))->get();

> **Note:** When eager loading, the call to the static **with** method must always be at the beginning of the query.

You may even eager load nested relationships. For example, let's assume our **Author** model has a "contacts" relationship. We can eager load both of the relationships from our Book model like so:

	$books = Book::with(array('author', 'author.contacts'))->get();

If you find yourself eager loading the same models often, you may want to use **$includes** in the model.

	class Book extends Eloquent {

	     public $includes = array('author');

	     public function author()
	     {
	          return $this->belongs_to('Author');
	     }

	}

**$includes** takes the same arguments that **with** takes. The following is now eagerly loaded.

	foreach (Book::all() as $book)
	{
	     echo $book->author->name;
	}

> **Note:** Using **with** will override a models **$includes**.

<a name="constraining-eager-loads"></a>
## Constraining Eager Loads

Sometimes you may wish to eager load a relationship, but also specify a condition for the eager load. It's simple. Here's what it looks like:

	$users = User::with(array('posts' => function($query)
	{
		$query->where('title', 'like', '%first%');

	}))->get();

In this example, we're eager loading the posts for the users, but only if the post's "title" column contains the word "first".

<a name="getter-and-setter-methods"></a>
## Getter & Setter Methods

Setters allow you to handle attribute assignment with custom methods.  Define a setter by appending "set_" to the intended attribute's name.

	public function set_password($password)
	{
		$this->set_attribute('hashed_password', Hash::make($password));
	}

Call a setter method as a variable (without parenthesis) using the name of the method without the "set_" prefix.

	$this->password = "my new password";

Getters are very similar. They can be used to modify attributes before they're returned. Define a getter by appending "get_" to the intended attribute's name.

	public function get_published_date()
	{
		return date('M j, Y', $this->get_attribute('published_at'));
	}

Call the getter method as a variable (without parenthesis) using the name of the method without the "get_" prefix.

	echo $this->published_date;

<a name="mass-assignment"></a>
## Mass-Assignment

Mass-assignment is the practice of passing an associative array to a model method which then fills the model's attributes with the values from the array. Mass-assignment can be done by passing an array to the model's constructor:

	$user = new User(array(
		'username' => 'first last',
		'password' => 'disgaea'
	));

	$user->save();

Or, mass-assignment may be accomplished using the **fill** method.

	$user = new User;

	$user->fill(array(
		'username' => 'first last',
		'password' => 'disgaea'
	));

	$user->save();

By default, all attribute key/value pairs will be store during mass-assignment. However, it is possible to create a white-list of attributes that will be set. If the accessible attribute white-list is set then no attributes other than those specified will be set during mass-assignment.

You can specify accessible attributes by assigning the **$accessible** static array. Each element contains the name of a white-listed attribute.

	public static $accessible = array('email', 'password', 'name');

Alternatively, you may use the **accessible** method from your model:

	User::accessible(array('email', 'password', 'name'));

> **Note:** Utmost caution should be taken when mass-assigning using user-input. Technical oversights could cause serious security vulnerabilities.

<a name="to-array"></a>
## Converting Models To Arrays

When building JSON APIs, you will often need to convert your models to array so they can be easily serialized. It's really simple.

#### Convert a model to an array:

	return json_encode($user->to_array());

The `to_array` method will automatically grab all of the attributes on your model, as well as any loaded relationships.

Sometimes you may wish to limit the attributes that are included in your model's array, such as passwords. To do this, add a `hidden` attribute definition to your model:

#### Excluding attributes from the array:

	class User extends Eloquent {

		public static $hidden = array('password');

	}

<a name="delete"></a>
## Deleting Models

Because Eloquent inherits all the features and methods of Fluent queries, deleting models is a snap:

	$author->delete();

Note, however, than this won't delete any related models (e.g. all the author's Book models will still exist), unless you have set up [foreign keys](/docs/database/schema#foreign-keys) and cascading deletes.
