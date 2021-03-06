<?php

namespace Xsilen\Flysystem\AliyunOss;

use Storage;
use OSS\OssClient;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Xsilen\Flysystem\AliyunOss\Plugins\FullUrl;
use Xsilen\Flysystem\AliyunOss\Plugins\PutFile;
use Xsilen\Flysystem\AliyunOss\Plugins\SignedDownloadUrl;

/**
 * Aliyun Oss ServiceProvider class.
 *
 * @author  ApolloPY <ApolloPY@Gmail.com>
 */
class AliyunOssServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('oss', function ($app, $config) {
            $accessId  = $config['access_id'];
            $accessKey = $config['access_key'];
            $endPoint  = $config['endpoint'];
            $cdnDomain = $config['cdnDomain'];
            $isCName   = $config['isCName'];
            $ssl       = $config['ssl'];
            $bucket    = $config['bucket'];
            $options   = $config['options'];

            $prefix = null;
            if (isset($config['prefix'])) {
                $prefix = $config['prefix'];
            }

            $client  = new OssClient($accessId, $accessKey, $endPoint);
            $adapter = new AliyunOssAdapter($client, $bucket, $prefix, $ssl, $isCName, $cdnDomain, $options);

            $filesystem = new Filesystem($adapter);
            $filesystem->addPlugin(new PutFile());
            $filesystem->addPlugin(new SignedDownloadUrl());
            $filesystem->addPlugin(new FullUrl());

            return $filesystem;
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
