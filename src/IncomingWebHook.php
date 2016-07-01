<?php

namespace Ychabaniuk\Slack;

class IncomingWebHook {

    /**
     * Hold Message object.
     *
     * @var \Ychabaniuk\Slack\Message
     */
    protected $message;

    /**
     * Response object.
     *
     * @var
     */
    protected $response;

    /**
     *
     * @var string
     */
    protected $endpoint;

    public function __construct($endpoint, array $configs = array()) {
        $this->endpoint = $endpoint;

        $this->message = Message::make($configs);
    }

    /**
     * Set channel for message.
     *
     * @param string $value
     * @return $this
     */
    public function to($value) {
        $this->message->config('channel', $value);

        return $this;
    }

    /**
     * Set name of user for message.
     *
     * @param string $value
     * @return $this
     */
    public function from($value) {
        $this->message->config('username', $value);

        return $this;
    }

    /**
     * Set icon and type of icon.
     *
     * @param string $value
     * @return $this
     */
    public function icon($value) {
        $this->message->config('icon', $value, function ($key, $value) {
            if ($key === 'icon') {
                $this->setIconType($value);
            }
        });

        return $this;
    }

    /**
     * Set text for message.
     *
     * @param string $value
     */
    public function text($value) {
        $this->message->config('text', $value);
    }

    /**
     * Send message to the destination endpoint.
     *
     * @return Response
     */
    public function send() {
        $data = $this->prepare();

        $payload = json_encode($data);

        $this->response = $this->request($payload);

        return $this->response;
    }

    /**
     * Add an attachment to the message.
     *
     * @param array|Attachment $attachment
     * @return $this
     */
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

    /**
     * Prepare payload for request.
     *
     * @return array
     */
    protected function prepare() {
        $data = $this->message->toArray();

        if ($this->message->exists('icon')) {
            $data[$this->message->config('icon-type')] = $this->message->config('icon');
        }

        return $data;
    }

    /**
     * Make request to endpoint.
     *
     * @param $content
     * @return null
     */
    protected function request($content) {
        $response = null;

        return $response;
    }
}