<?php

namespace Ychabaniuk\Slack;

class IncomingWebHook {

    protected $message;

    protected $response;

    public function __construct($endpoint, array $configs = array()) {
        $this->message = Message::make($configs);
    }

    public function to($value) {
        $this->message->config('channel', $value);

        return $this;
    }

    public function from($value) {
        $this->message->config('username', $value);

        return $this;
    }

    public function icon($value) {
        $this->message->config('icon', $value, function ($key, $value) {
            if ($key === 'icon') {
                $this->setIconType($value);
            }
        });

        return $this;
    }

    public function text($value) {
        $this->message->config('text', $value);
    }

    public function send() {
        $data = $this->prepare();

        $payload = json_encode($data);

        $this->request($payload);
    }

    protected function prepare() {
        $data = $this->message->toArray();

        if ($this->message->exists('icon')) {
            $data[$this->message->config('icon-type')] = $this->message->config('icon');
        }

        return $data;
    }

    protected function request($content) {

    }
}