<?php
namespace Vda\Config\Loader;

use Vda\Config\Config;

class PhpConfigLoader extends AbstractPhpConfigLoader
{
    protected function getDefaultConfig()
    {
        return new Config();
    }
}
