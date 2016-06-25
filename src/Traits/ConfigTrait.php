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
                $newCallback($key, $value);
            }

            $this->configs[$key] = $value;
        }

        return $result;
    }
}