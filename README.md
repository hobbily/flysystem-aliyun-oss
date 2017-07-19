# Flysystem Adapter for Aliyun OSS.

This is a Flysystem adapter for the Aliyun OSS ~2.2.1

inspire by [aobozhang/aliyun-oss-adapter](https://github.com/aobozhang/aliyun-oss-adapter)

inspire by [apollopy/flysystem-aliyun-oss](https://github.com/apollopy/flysystem-aliyun-oss)

## Installation

```bash
composer require gradii/flysystem-aliyun-oss
```

## for Laravel

This service provider must be registered.

In order to be compatible to prev `xsilen/flysystem-aliyun-oss`, i have not change namespace
start with `Gradii`

```php
// config/app.php

'providers' => [
    '...',
    Xsilen\Flysystem\AliyunOss\AliyunOssServiceProvider::class,
];
```

edit the config file: config/filesystems.php

add config

```php
'oss' => [
    'driver'     => 'oss',
    'access_id'  => env('ALIYUN_OSS_ACCESS_KEY_ID'),
    'access_key' => env('ALIYUN_OSS_ACCESS_KEY_SECRET'),
    'bucket'     => env('ALIYUN_OSS_BUCKET_NAME'),
    //使用endpoint来上传oss文件, 如果是OSS内网上传, 刚将OSS内网地址填在此处
    'endpoint'   => env('ALIYUN_OSS_ENDPOINT'),
    'cdnDomain'  => env('ALIYUN_OSS_MARKET_CDN_DOMAIN', env('ALIYUN_OSS_CDN_DOMAIN')),
    // true to use 'https://' and false to use 'http://'. default is false,
    'ssl'        => true,
    // 如果isCName为true, getUrl会判断cdnDomain是否设定来决定返回的url，如果cdnDomain未设置，则使用endpoint来生成url，否则使用cdn
    // 而且, 上传将会用endpoint来上传, 读取将会用cdnDomain来读取
    'isCName'    => true,
    'prefix'     => env('OSS_PREFIX', ''), // optional
],
```

change default to oss

```php
    'default' => 'oss'
```

## Use

see [Laravel wiki](https://laravel.com/docs/5.1/filesystem)

## Plugins

inspire by [itbdw/laravel-storage-qiniu](https://github.com/itbdw/laravel-storage-qiniu)

```php
Storage::disk('oss')->putFile($path, '/local_file_path/1.png', ['mimetype' => 'image/png']);
Storage::disk('oss')->signedDownloadUrl($path, 3600, /*可强制写cdnDomain*/'oss-cn-beijing.aliyuncs.com', true);
Storage::disk('oss')->fullUrl($path, /*可强制写cdnDomain*/'oss-cn-beijing.aliyuncs.com', true);
```

## IDE Helper

if installed [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)

edit the config file: config/ide-helper.php

```php
'interfaces'      => [
    '\Illuminate\Contracts\Filesystem\Filesystem' => Xsilen\Flysystem\AliyunOss\FilesystemAdapter::class,
],
```
