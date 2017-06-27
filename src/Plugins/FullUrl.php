<?php

namespace Xsilen\Flysystem\AliyunOss\Plugins;

use League\Flysystem\Plugin\AbstractPlugin;

/**
 * FullUrl class
 * 获取完全地址
 *
 * @author  ApolloPY <ApolloPY@Gmail.com>
 */
class FullUrl extends AbstractPlugin
{
    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'fullUrl';
    }

    /**
     * Handle.
     *
     * @param string $path
     * @param int    $expires
     * @param string $host_name
     * @param bool   $use_ssl
     * @return string|false
     */
    public function handle($path, $expires = 3600, $host_name = '', $use_ssl = false)
    {
        if (! method_exists($this->filesystem, 'getAdapter')) {
            return false;
        }

        if (! method_exists($this->filesystem->getAdapter(), 'getFullUrl')) {
            return false;
        }

        return $this->filesystem->getAdapter()->getFullUrl($path, $host_name, $use_ssl);
    }
}
