<?php

namespace Ychabaniuk\Slack;

use Ychabaniuk\Slack\Traits\ConfigTrait;

class Attachment {

    use ConfigTrait;

    /**
     * Hold attachments with params.
     *
     * @var array
     */
    protected $configs = array();

    public function __construct($configs) {

        foreach ($configs as $key => $value) {
            $this->config($key, $value);
        }
    }

    /**
     * Attach field.
     *
     * @param array $value
     * @return $this
     */
    public function field($value) {
        $this->config('fields', $value, function ($key, $value) {
            $this->push($key, $value);

            return true;
        });

        return $this;
    }

    /**
     * Attach bunch of fields.
     *
     * @param array $fields
     * @return $this
     */
    public function fields(array $fields) {
        foreach ($fields as $field) {
            $this->field($field);
        }

        return $this;
    }

    /**
     * Add attribute for attachment. eg: fallback, color, pretext.
     *
     * @param string $key
     * @param $value
     * @return $this
     */
    public function param($key, $value) {
        $this->config($key, $value);

        return $this;
    }

    /**
     * Additional method to create attachment.
     *
     * @param array $configs
     * @return static
     */
    public static function make($configs) {
        return new static($configs);
    }

    /**
     * Return Attachment in array representation.
     *
     * @return array
     */
    public function toArray() {
        return array_filter($this->configs);
    }
}