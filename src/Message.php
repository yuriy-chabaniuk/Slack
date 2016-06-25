<?php

namespace Ychabaniuk\Slack;

class Message {

    const ICON_TYPE_URL = 'icon_url';

    const ICON_TYPE_EMOJI = 'icon_emoji';

    protected $configs = array();

    protected function __construct() {

    }

    public function config($key, $value = null) {
        $result = true;

        if ($value === null) {
            $result = $this->configs[$key];
        } else {
            if ($key === 'icon') {
                $this->setIconType($value);
            }

            $this->configs[$key] = $value;
        }

        return $result;
    }

    public function exists($key) {
        return !empty($this->config($key));
    }

    protected function setIconType($value) {
        $iconType = self::ICON_TYPE_URL;
        if ($value === 'emoji') {
            $iconType = self::ICON_TYPE_EMOJI;
        }

        $this->config('icon-type', $iconType);
    }

    public static function make(array $configs = array()) {
        $message = new static();

        foreach ($configs as $key => $value) {
            $message->config($key, $value);
        }

        return $message;
    }
}