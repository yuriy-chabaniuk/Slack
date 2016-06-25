<?php

namespace Ychabaniuk\Slack;

class Message {

    use Traits\ConfigTrait;

    const ICON_TYPE_URL = 'icon_url';

    const ICON_TYPE_EMOJI = 'icon_emoji';

    protected $configs = array();

    protected function __construct() {

    }

    public function exists($key) {
        return !empty($this->config($key));
    }

    protected function setIconType($value) {
        $iconType = self::ICON_TYPE_URL;
        if ($value[0] === ':' and $value[strlen($value) - 1] === ':') {
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

    public function toArray() {
        return array_filter($this->configs);
    }
}