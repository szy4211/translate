<h1 align="center"> Translate </h1>

<p> 文本翻译 SDK.</p>

<p align="center">
<a href="https://travis-ci.org/szy4211/translate"><img src="https://travis-ci.org/szy4211/translate.svg?branch=master" alt="Build Status"></a>
<a href="https://github.styleci.io/repos/283954079"><img src="https://github.styleci.io/repos/283954079/shield" alt="StyleCI build status"></a>
<a href="https://packagist.org/packages/szy4211/translate"><img src="https://poser.pugx.org/szy4211/translate/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/szy4211/translate"><img src="https://poser.pugx.org/szy4211/translate/v/unstable.svg" alt="Latest Unstable Version"></a>
<a href="https://packagist.org/packages/szy4211/translate"><img src="https://poser.pugx.org/szy4211/translate/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/szy4211/translate"><img src="https://poser.pugx.org/szy4211/translate/license" alt="License"></a>
</p>

## 安装

```shell
$ composer require szy4211/translate -vvv
```


## 使用
```php
use Szy4211\Translate\Translate;

$config = [
    'default' => 'baidu', // 默认网关配置
    // 网关列表
    'gateways' => [
        'baidu' => [
            'app_id' => '',
            'app_secret' => '',
            'http_timeout' => 5.0, // 超时时间
            'http_options' => [],
        ],
        // ...
    ],
];

$translate = new Translate($config);
$transResult = $translate->translate('Hello');
echo $translate->getDstMessage(); // 你好
```

## Laravel支持

- 加载配置文件

```shell script
php artisan vendor:publish --provider="Szy4211\Translate\TranslateServiceProvider"
```

- 定义Env
```ini
TRANS_BAIDU_APP_ID='xxx'
TRANS_BAIDU_APP_SECRET='xxx'
```


- 方法参数注入

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Szy4211\Translate\Translate;

class WeatherController extends Controller
{
    public function show(Request $request, Translate $translate, $query)
    {
        return $translate->translate($query);
    }
}
```

## 平台支持
- [百度](https://api.fanyi.baidu.com/doc/21)
- [有道](https://ai.youdao.com/DOCSIRMA/html/%E8%87%AA%E7%84%B6%E8%AF%AD%E8%A8%80%E7%BF%BB%E8%AF%91/API%E6%96%87%E6%A1%A3/%E6%96%87%E6%9C%AC%E7%BF%BB%E8%AF%91%E6%9C%8D%E5%8A%A1/%E6%96%87%E6%9C%AC%E7%BF%BB%E8%AF%91%E6%9C%8D%E5%8A%A1-API%E6%96%87%E6%A1%A3.html)

## License

[MIT](./LICENSE)