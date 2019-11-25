## 目录

- [安装配置](#%E5%AE%89%E8%A3%85%E9%85%8D%E7%BD%AE)
- [使用说明](#%E4%BD%BF%E7%94%A8%E8%AF%B4%E6%98%8E)
	- [快速使用](#%E5%BF%AB%E9%80%9F%E4%BD%BF%E7%94%A8)
		- [中间件](#%E4%B8%AD%E9%97%B4%E4%BB%B6)
		- [异常处理](#%E5%BC%82%E5%B8%B8%E5%A4%84%E7%90%86)
		- [控制器](#%E6%8E%A7%E5%88%B6%E5%99%A8)
		- [模型](#%E6%A8%A1%E5%9E%8B)
		- [服务层(逻辑层)](#%E6%9C%8D%E5%8A%A1%E5%B1%82%E9%80%BB%E8%BE%91%E5%B1%82)
	- [控制器](#%E6%8E%A7%E5%88%B6%E5%99%A8-1)
	- [模型](#%E6%A8%A1%E5%9E%8B-1)
	    - [普通模型](#%E6%99%AE%E9%80%9A%E6%A8%A1%E5%9E%8B)
	    - [中间表模型](#%E4%B8%AD%E9%97%B4%E8%A1%A8%E6%A8%A1%E5%9E%8B)
	    - [mongodb模型](#mongodb%E6%A8%A1%E5%9E%8B)
	- [服务层(逻辑层)](#%E6%9C%8D%E5%8A%A1%E5%B1%82%E9%80%BB%E8%BE%91%E5%B1%82-1)
	- [命令行](#%E5%91%BD%E4%BB%A4%E8%A1%8C)
	    - [创建控制器](#%E5%88%9B%E5%BB%BA%E6%8E%A7%E5%88%B6%E5%99%A8)
	    - [创建服务层(逻辑层)](#%E5%88%9B%E5%BB%BA%E6%9C%8D%E5%8A%A1%E5%B1%82%E9%80%BB%E8%BE%91%E5%B1%82)
	    - [创建模型](#%E5%88%9B%E5%BB%BA%E6%A8%A1%E5%9E%8B)
	    - [通过文件创建所需文件](#%E9%80%9A%E8%BF%87%E6%96%87%E4%BB%B6%E5%88%9B%E5%BB%BA%E6%89%80%E9%9C%80%E6%96%87%E4%BB%B6)
	    - [生成工厂文件](%23%E7%94%9F%E6%88%90%E5%B7%A5%E5%8E%82%E6%96%87%E4%BB%B6)
	- [中间件](#%E4%B8%AD%E9%97%B4%E4%BB%B6-1)
	- [队列](#%E9%98%9F%E5%88%97)
	    - [rabbitmq](#rabbitmq)
	- [异常处理](#%E5%BC%82%E5%B8%B8%E5%A4%84%E7%90%86-1)
	- [服务提供者](#%E6%9C%8D%E5%8A%A1%E6%8F%90%E4%BE%9B%E8%80%85)
	    - [API服务提供者](#api%E6%9C%8D%E5%8A%A1%E6%8F%90%E4%BE%9B%E8%80%85)
	    - [队列任务服务提供者](#%E9%98%9F%E5%88%97%E4%BB%BB%E5%8A%A1%E6%9C%8D%E5%8A%A1%E6%8F%90%E4%BE%9B%E8%80%85)
	    - [契约服务提供者](#%E5%A5%91%E7%BA%A6%E6%9C%8D%E5%8A%A1%E6%8F%90%E4%BE%9B%E8%80%85)
	    - [路由服务提供者](#%E8%B7%AF%E7%94%B1%E6%9C%8D%E5%8A%A1%E6%8F%90%E4%BE%9B%E8%80%85)
	- [验证规则](#%E9%AA%8C%E8%AF%81%E8%A7%84%E5%88%99)
	    - [Images](#images)
	- [模型作用域](#%E6%A8%A1%E5%9E%8B%E4%BD%9C%E7%94%A8%E5%9F%9F)
	    - [主键字段倒序](#%E4%B8%BB%E9%94%AE%E5%AD%97%E6%AE%B5%E5%80%92%E5%BA%8F)
	- [trait介绍](#trait%E4%BB%8B%E7%BB%8D)
	    - [InstanceTrait.php](#instancetraitphp)
		- [ModelTrait.php](#modeltraitphp)
	    - [RedisHandlerTrait.php](#redishandlertraitphp)
		- [RequestInfoTrait.php](#requestinfotraitphp)
	    - [ResultThrowTrait.php](#resultthrowtraitphp)
		- [UserInfoTrait.php](#userinfotraitphp)
	- [工具类介绍](#%E5%B7%A5%E5%85%B7%E7%B1%BB%E4%BB%8B%E7%BB%8D)
	    - [Collection.php](#collectionphp)
	    - [DbHelper.php](#dbhelperphp)
	    - [FileSize.php](#filesizephp)
	    - [Log.php](#logphp)
	    - [RequestClient.php](#requestclientphp)
	    - [Sdl.php](#sdlphp)
	    - [SmsCache.php](#smscachephp)
	    - [Token.php](#tokenphp)

## 安装配置

使用以下命令安装：
```
composer require jmhc/laravel-api
```
发布文件[可选]：
```php
// 发布所有文件
php artisan vendor:publish --tag=jmhc-api

// 只发布配置文件
php artisan vendor:publish --tag=jmhc-api-config

// 只发布迁移文件
php artisan vendor:publish --tag=jmhc-api-migrations

// 只发布资源文件
php artisan vendor:publish --tag=jmhc-api-resources
```

## 使用说明

> 环境变量值参考：[env](docs/ENV.md)
> 
> restful参考: [restful](docs/RESTFUL.md)

### 快速使用

1. [安装](#%E5%AE%89%E8%A3%85%E9%85%8D%E7%BD%AE)
2. [发布配置[可选]](#%E5%AE%89%E8%A3%85%E9%85%8D%E7%BD%AE)
3. [注册中间件](#%E4%B8%AD%E9%97%B4%E4%BB%B6)
4. [继承异常处理程序](#%E5%BC%82%E5%B8%B8%E5%A4%84%E7%90%86)

#### 中间件
- 必须注册全局中间件 `Jmhc\Restful\Middleware\ParamsHandlerMiddleware`
- 可选中间件查看 [中间件列表](#%E4%B8%AD%E9%97%B4%E4%BB%B6-1)

#### 异常处理

- 修改 `App\Exceptions\Handler` 继承的方法为  `Jmhc\Restful\Handlers\ExceptionHandler`
- 其他异常捕获调用父类 `response()`  方法并重写，参考 `Jmhc\Restful\Handlers\ExceptionHandler->response()`

#### 控制器

- 直接继承 `Jmhc\Restful\Controllers\BaseController`

#### 模型

- 可选继承 `Jmhc\Restful\Models\BaseModel` 、 `Jmhc\Restful\Models\BaseMongo` 、 `Jmhc\Restful\Models\BasePivot` 、 `Jmhc\Restful\Models\UserModel`  、`Jmhc\Restful\Models\VersionModel`

#### 服务层(逻辑层)

- 直接继承 `Jmhc\Restful\Services\BaseService`

### 控制器

> 需继承 `Jmhc\Restful\Controllers\BaseController`

- 可使用 `Jmhc\Restful\Traits\RequestInfoTrait` 里的参数
- 可使用 `Jmhc\Restful\Traits\UserInfoTrait` 里的参数、方法
- 可使用 `Jmhc\Restful\Traits\ResourceController` 里的方法

### 模型

#### 普通模型

> 需继承 `Jmhc\Restful\Models\BaseModel`

- 可使用 `Jmhc\Restful\Traits\ModelTrait` 里的方法

#### 中间表模型

> 需继承 `Jmhc\Restful\Models\BasePivot`

- 可使用 `Jmhc\Restful\Traits\ModelTrait` 里的方法

#### mongodb模型

> 需继承 `Jmhc\Restful\Models\BaseMongo`

- 可使用 `Jmhc\Restful\Traits\ModelTrait` 里的方法
- 配置参考：[jmhc-mongodb.php](config/jmhc-mongodb.php)

### 服务层(逻辑层)

> 需继承 `Jmhc\Restful\Services\BaseService`

- 可使用 `Jmhc\Restful\Traits\RequestInfoTrait` 里的参数
- 可使用 `Jmhc\Restful\Traits\UserInfoTrait` 里的参数、方法
- 可使用 `Jmhc\Restful\Traits\ResourceService` 里的方法

```php
class TestController extends BaseController
{
	public function initialize()
    {
        parent::initialize();
        $this->service = TestService::getInstance();
    }
    
    public function index()
    {
    	$this->request->params->a = 'a';
    	// 当初始化实例化service后，方法中有更新$this->request->params时,应当调用服务层updateAttribute方法更新$this->request->params
    	$this->service->updateAttribute()->index();
    }
    
    public function index()
    {
    	// 当初始化实例化service后，方法中无更新$this->request->params
    	$this->service->index();
    }
}
```

### 命令行

#### 创建控制器

> 创建的控制器默认继承基础控制器 BaseController

```php
// 创建 Test 控制器位于 app/Http/Controllers/Test.php
php artisan jmhc-api:make-controller test
// 创建 Test 控制器并添加后缀，位于 app/Http/Controllers/TestController.php
php artisan jmhc-api:make-controller test -s
// 创建 Test 控制器位于 app/Http/Index/Controllers/Test.php
php artisan jmhc-api:make-controller test -m index
...
```

#### 创建服务层(逻辑层)

> 创建的服务默认继承基础服务 BaseService

```php
// 创建 Test 服务位于 app/Http/Services/Test.php
php artisan jmhc-api:make-service test
// 创建 Test 服务并添加后缀，位于 app/Http/Services/TestService.php
php artisan jmhc-api:make-service test -s
// 创建 Test 服务位于 app/Http/Index/Services/Test.php
php artisan jmhc-api:make-service test -m index
...
```

#### 创建模型

> 不传 name 将会从数据库读取所有表创建

```php
// 创建公用模型位于 app/Common/Models 并排除 test，foos 表
php artisan jmhc-api:make-model --dir Common/Models -t test -t foos
// 创建 Test 模型位于 app/Http/Models/Test.php
php artisan jmhc-api:make-model test
// 创建 Test 服务并添加后缀，位于 app/Http/Models/TestModel.php
php artisan jmhc-api:make-model test -s
// 创建 Test 模型位于 app/Http/Index/Models/Test.php
php artisan jmhc-api:make-model test -m index
...
```

#### 通过文件创建所需文件

> 此命令通过 `config('jmhc-build-file')` 获取需要创建的文件名称

```php
// 生成控制器、模型、服务、迁移、填充
php artisan jmhc-api:make-with-file --controller --model --service --migration --seeder
// 覆盖生成所有文件
php artisan jmhc-api:make-with-file -f
// 覆盖生成控制器
php artisan jmhc-api:make-with-file --force-controller
...
```

#### 生成工厂文件

```php
// 通过指定目录创建factory,位于 app/Http/Common/Factory/Service.php
php artisan jmhc-api:make-factory service --scan-dir Http/Services --scan-dir Http/Index/Services

// 通过指定目录创建factory,并增加后缀、保存至其他路径,位于 app/Http/Commons/Factory/ServiceFactory.php
php artisan jmhc-api:make-factory service --scan-dir Http/Services --dir Commons/Factory -s
...
```

### 中间件

> 用法加粗为必须调用

|   中间件   |   别名   |   用法   |   需要实现的契约或继承模型   |
| ---- | ---- | ---- | ---- |
| `Jmhc\Restful\Middleware\CorsMiddleware` | `jmhc.allow.cors` | 允许跨域 | --- |
| `Jmhc\Restful\Middleware\ParamsHandlerMiddleware`  | `jmhc.params.handler` | **参数处理** | --- |
| `Jmhc\Restful\Middleware\ConvertEmptyStringsToNullMiddleware` | `jmhc.convert.empty.strings.to.null` | 转换空字符串为null | --- |
| `Jmhc\Restful\Middleware\TrimStringsMiddleware` | `jmhc.trim.strings` | 清除字符串空格 | --- |
| `Jmhc\Restful\Middleware\RequestLockMiddleware` | `jmhc.request.lock` | 请求锁定 | --- |
| `Jmhc\Restful\Middleware\RequestLogMiddleware` | `jmhc.request.log` | 记录请求日志(debug) | --- |
| `Jmhc\Restful\Middleware\RequestPlatformMiddleware` | `jmhc.request.platform` | 设置请求平台，参考`Jmhc\Restful\PlatformInfo` | --- |
| `Jmhc\Restful\Middleware\CheckVersionMiddleware` | `jmhc.check.version` | 检测应用版本 | `Jmhc\Restful\Contracts\VersionModelInterface`<br />`Jmhc\Restful\Models\VersionModel` |
| `Jmhc\Restful\Middleware\CheckSignatureMiddleware` | `jmhc.check.signature` | 验证请求签名 | --- |
| `Jmhc\Restful\Middleware\CheckTokenMiddleware` | `jmhc.check.token` | 检测token，设置用户数据 | `Jmhc\Restful\Contracts\UserModelInterface`<br />`Jmhc\Restful\Models\UserModel` |
| `Jmhc\Restful\Middleware\CheckSdlMiddleware` | `jmhc.check.sdl` | 单设备登录，需要复写 `Jmhc\Restful\Handlers\ExceptionHandler->sdlHandler()` | --- |


### 队列

#### rabbitmq
> 需要继承  `Jmhc\Restful\Jobs\BaseRabbitmq` 
>
> 详细配置查看：[rabbitmq.conf](https://github.com/vyuldashev/laravel-queue-rabbitmq/blob/master/config/rabbitmq.php)

### 异常处理

> `App\Exceptions\Handler` 继承 `Jmhc\Restful\Handlers\ExceptionHandler`
>
> 其他异常捕获调用父类 `response()`  方法并重写，参考 `Jmhc\Restful\Handlers\ExceptionHandler->response()`

### 服务提供者

#### API服务提供者

>`Jmhc\Restful\Providers\JmhcApiServiceProvider`

- 注册路由中间件
- 注册命令
- 合并配置
- 发布文件

#### 队列任务服务提供者

> `Jmhc\Restful\Providers\JmhcJobServiceProvider`  

- 队列任务开始执行(debug)
- 队列任务执行异常错误日志

#### 契约服务提供者

> `Jmhc\Restful\Providers\JmhcContractServiceProvider`  

- 绑定契约 `Jmhc\Restful\Contracts\UserModelInterface` 实现
- 绑定契约 `Jmhc\Restful\Contracts\VersionModelInterface` 实现

#### 路由服务提供者

> `Jmhc\Restful\Providers\JmhcRouteServiceProvider`  
>
> 默认不启用

- 注册 `base_path('routes')` 下面所有 php 文件到路由

### 验证规则

#### Images

> `Jmhc\Restful\Rules\ImagesRule`

验证图片字段后缀地址为 `jpeg` , `jpg` , `png` , `bmp` , `gif` , `svg` , `webp`

如：

```php
1.png // true
1.pn // false
1.png,2.png // true
```

### 模型作用域

#### 主键字段倒序

> `Jmhc\Restful\Scopes\PrimaryKeyDescScope`

`Jmhc\Restful\Models\BaseModel` 已默认注册此全局作用域

### trait介绍

#### InstanceTrait.php

> `Jmhc\Restful\Traits\InstanceTrait`
>
> 单例类 trait

```php
// 无构造参数使用
T::getInstance()->a();

// 有构造参数使用，c为构造参数名称
T::getInstance([
    'c' => ['a']
])->a();
```

#### ModelTrait.php

> `Jmhc\Restful\Traits\ModelTrait`
>
> 模型辅助 trait

使用类:
- `Jmhc\Restful\Models\BaseModel`
- `Jmhc\Restful\Models\BasePivot`
- `Jmhc\Restful\Models\BaseMongo`

#### RedisHandlerTrait.php

> `Jmhc\Restful\Traits\RedisHandlerTrait`
>
> redis 操作句柄 trait

#### RequestInfoTrait.php

> `Jmhc\Restful\Traits\RequestInfoTrait`
>
> 请求信息绑定

使用类:

- `Jmhc\Restful\Controllers\BaseController`
- `Jmhc\Restful\Services\BaseService`

#### ResultThrowTrait.php

> `Jmhc\Restful\Traits\ResultThrowTrait`
>
> 异常抛出辅助

#### UserInfoTrait.php

> `Jmhc\Restful\Traits\UserInfoTrait`
>
> 用户信息绑定

使用类:

- `Jmhc\Restful\Controllers\BaseController`
- `Jmhc\Restful\Services\BaseService`

### 工具类介绍

#### Collection.php

> `Jmhc\Restful\Utils\Collection`
>
> 集合，基于 `Illuminate\Support\Collection`

- 修改`__get` 魔术方法
- 新增`__set` , `__isset` , `__unset` 魔术方法

#### DbHelper.php

> `Jmhc\Restful\Utils\DbHelper`
>
> 数据库辅助方法

```php
// 返回所有表名
DbHelper::getInstance()->getAllTables();

// 返回 mysql 链接下 users 表字段数据
DbHelper::getInstance([
    'name' => 'mysql'
])->getAllColumns('users');
```

#### FileSize.php

> `Jmhc\Restful\Utils\FileSize`
>
> 转换文件尺寸

```php
// 返回 2097152 字节
FileSize::get('2m');

// 返回 2147483648 字节
FileSize::get('2g');
```

#### Log.php

> `Jmhc\Restful\Utils\Log`
>
> 文件日志保存

- `debug` 日志受环境变量 `LOG_DEBUG` 控制

#### RequestClient.php

> `Jmhc\Restful\Utils\RequestClient`
>
> 请求客户端，基于 `GuzzleHttp\Client`

复写构造函数：

- 设置不验证 `https`
- 设置 `user-agent` 为谷歌浏览器

#### Sdl.php

> `Jmhc\Restful\Utils\Sdl`
>
> 单设备登录类

#### SmsCache.php

> `Jmhc\Restful\Utils\SmsCache`
>
> 发送短信缓存类

#### Token.php

> `Jmhc\Restful\Utils\Token`
>
> 令牌相关类
