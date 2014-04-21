<?php
namespace Vda\Config\Loader;

use Vda\Config\UnmodifiableConfig;

class PhpUnmodifiableConfigLoader extends AbstractPhpConfigLoader
{
    protected function getDefaultConfig()
    {
        return new UnmodifiableConfig();
    }
}
