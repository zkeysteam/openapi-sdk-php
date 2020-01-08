# ZKEYS OpenAPI SDK for PHP

ZKEYS OpenAPI是ZKEYS开放API，目前提供三网短信、三要素/四要素实名接口。

## 运行环境

- PHP 5.3+
- cURL extension

## 安装方法

1. 如果您通过composer管理您的项目依赖，可以在你的项目根目录运行：

	$ composer require zkeysteam/openapi-sdk-php
	
2. 下载SDK源码，在您的代码中引入SDK目录下的`autoload.php`文件：

    require_once '/path/to/openapi-sdk-php/autoload.php';
	
## 快速使用
获取 access_token
```
use Zkeys\OpenApi\Auth;
use Zkeys\OpenApi\options\AuthOption;

$authOption = new AuthOption();
$authOption->setSecretId('NuDbL3WsJzfFZR8y');// 设置Secret Id
$authOption->setSecretKey('JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');// 设置Secret Key
$auth = new Auth();

$result = $auth->getToken($authOption);

if (!$result) {
    echo $auth->getError();
}

var_export($result);// 正常返回结果： array ( 'access_token' => '43a759e123477bc9ecbaa7b58ee6fa70', 'expires_in' => 7200 )

```

更多使用请参考 [测试用例](https://github.com/zkeysteam/openapi-sdk-php/blob/master/demo/Index.php)