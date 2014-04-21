<?php
namespace Vda\Config\Loader;

use Vda\Config\IConfig;

interface IConfigLoader
{
    /**
     * Load configugaration values from implementation specific location
     *
     * @param IConfig $initialConfig If provided will be filled with loaded data
     * @return IConfig Configuration values
     */
    public function load(IConfig $initialConfig = null);
}
