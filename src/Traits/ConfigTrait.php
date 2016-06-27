<?php

namespace Ychabaniuk\Slack\Traits;

trait ConfigTrait {

    public function config($key, $value = null, callable $callback = null) {
        $result = true;

        if ($value === null) {
            $result = $this->configs[$key];
        } else {
            if (is_callable($callback)) {
                $newCallback = $callback->bindTo($this, $this);
                $preventDefault = $newCallback($key, $value);
            }

            if ($preventDefault !== true) {
                $this->configs[$key] = $value;
            }
        }

        return $result;
    }

    public function push($key, $value) {
        if (!is_array($this->config($key))) {
            $this->config($key, []);
        }

        $array = $this->config($key);

        array_push($array, $value);

        $this->config($key, $array);
    }

    public function exists($key) {
        return !empty($this->config($key));
    }
}