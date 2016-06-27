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

        $this->response = $this->request($payload);

        return $this->response;
    }

    public function attach($attachment) {
        if (is_array($attachment)) {
            $attachment = new Attachment($attachment);
        }

        if ($attachment instanceof Attachment) {
            $this->message->config('attachments', $attachment, function ($key, $value) {
                $this->push($key, $value);

                return true;
            });
        } else {
            throw new \InvalidArgumentException('');
        }

        return $this;
    }

    protected function prepare() {
        $data = $this->message->toArray();

        if ($this->message->exists('icon')) {
            $data[$this->message->config('icon-type')] = $this->message->config('icon');
        }

        return $data;
    }

    protected function request($content) {
        $response = null;

        return $response;
    }
}