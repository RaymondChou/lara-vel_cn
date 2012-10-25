# 错误与日志

## 目录

- [基本配置](#basic-configuration)
- [日志](#logging)
- [日志类(Logger)](#the-logger-class)

<a name="basic-configuration"></a>
## 基本配置

所有关于错误和日志的配置项都在**application/config/errors.php**中，让我们进去看看。

### 忽略错误

**ignore**选项为一个包含需要被忽略的错误级别，如果一个级别被“忽略”了，意味着当发生这个级别的错误后，脚本不会停止执行，但如果日志处于打开时它将会被记录到日志中。

### 错误详情

**detail**选项指示框架在错误发生后是否显示调用栈跟踪信息。在开发环境下，你可能希望他是**true**，但在产品环境下是**false**。如果它被禁用位于**application/views/error/500.php**的包含一条错误信息的视图将被显示。

<a name="logging"></a>
## 日志

设置**log**为"true"以打开日志，如果日志被打开，一旦发生错误**logger**定义的闭包将被执行，这样设计给了你最大程度上的灵活性（你可以自己定义日志的记录方式），你甚至可以发一封邮件给你的开发团队！

默认情况下，日志存放在**storage/logs**目录中，每天将创建一个日志文件。这样可以避免你被大量的日志信息淹没。

<a name="the-logger-class"></a>
## 日志类(Logger)

有时你希望使用Laravel的**Log**类来调试程序，或者仅仅记录一些信息，下面是如何利用它做这些：

#### 写一条信息到日志：

	Log::write('info', 'This is just an informational message!');

#### 使用魔术方法添加不同的日志信息：

	Log::info('This is just an informational message!');