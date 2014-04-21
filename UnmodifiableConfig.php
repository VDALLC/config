<?php
namespace Vda\Config;

use Vda\Util\ParamStore\ParamStore;

class UnmodifiableConfig extends ParamStore implements IConfig
{
    public function & offsetGet($offset)
    {
        $result = & parent::offsetGet($offset);

        if (!is_array($result)) {
            return $result;
        }

        $wrap = new self($result, true);

        return $wrap;
    }

    public function offsetSet($offset, $value)
    {
        if ($this->offsetExists($offset)) {
            $current = parent::offsetGet($offset);
            if (is_array($current) && is_array($value)) {
                parent::offsetSet($offset, $this->deepMerge($current, $value));
            }
        } else {
            parent::offsetSet($offset, $value);
        }
    }

    public function get($paramName, $default = null)
    {
        if ($this->offsetExists($paramName)) {
            return parent::offsetGet($paramName);
        } else {
            return $default;
        }
    }

    private function deepMerge(array $current, array $new)
    {
        foreach ($current as $k => $v) {
            if (!is_array($v) || !array_key_exists($k, $new)) {
                $new[$k] = $v;
            } else {
                $new[$k] = $this->deepMerge($v, $new[$k]);
            }
        }

        return $new;
    }
}
