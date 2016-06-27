<?php

namespace Ychabaniuk\Slack;

use Ychabaniuk\Slack\Traits\ConfigTrait;

class Attachment {

    use ConfigTrait;

    protected $configs = array();

    public function __construct($configs) {

        foreach ($configs as $key => $value) {
            $this->config($key, $value);
        }
    }

    public function field($value) {
        $this->config('fields', $value, function ($key, $value) {
            $this->push($key, $value);

            return true;
        });

        return $this;
    }

    public function fields(array $fields) {
        foreach ($fields as $field) {
            $this->field($field);
        }

        return $this;
    }

    public function param($key, $value) {
        $this->config($key, $value);

        return $this;
    }

    public function toArray() {
        return array_filter($this->configs);
    }
}