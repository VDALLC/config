<?php
namespace Vda\Config\Loader;

use Vda\Config\IConfig;

abstract class AbstractPhpConfigLoader implements IConfigLoader
{
    private $basePath;
    private $files;

    public function __construct($files, $basePath = null)
    {
        $this->basePath = $basePath;
        $this->files = $files;
    }

    public function load(IConfig $initialConfig = null)
    {
        return self::processFiles(
            $this->files,
            $initialConfig ?: $this->getDefaultConfig(),
            $this->basePath
        );
    }

    abstract protected function getDefaultConfig();

    private static function processFiles($files, IConfig $config, $basePath = null)
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                self::processFiles($file, $config, $basePath);
            }
        } else {
            if (!is_null($basePath)) {
                $files = $basePath . '/' . $files;
            }

            if (strpbrk($files, '?*') !== false) {
                self::processFiles(glob($files), $config);
            } else {
                include $files;
            }
        }

        return $config;
    }
}
