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

    /**
     * Set icon type according to image string.
     *
     * @param sting $value
     */
    protected function setIconType($value) {
        $iconType = self::ICON_TYPE_URL;
        if ($value[0] === ':' and $value[strlen($value) - 1] === ':') {
            $iconType = self::ICON_TYPE_EMOJI;
        }

        $this->config('icon-type', $iconType);
    }

    /**
     * Main method to create message.
     *
     * @param array $configs
     * @return static
     */
    public static function make(array $configs = array()) {
        $message = new static();

        foreach ($configs as $key => $value) {
            $message->config($key, $value);
        }

        return $message;
    }

    /**
     * Return Message in array representation.
     *
     * @return array
     */
    public function toArray() {
        return array_filter($this->configs);
    }
}