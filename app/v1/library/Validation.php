<?php

namespace Ekranj\Library;

use Phalcon\Validation as PhalconValidation;

abstract class Validation extends PhalconValidation
{
    public function validate($data = null, $entity = null): bool
    {
        parent::validate($data);

        $valid = false;

        if (count($this->getMessages()) === 0) {
            $valid = true;
        }

        return $valid;
    }

    public function getMessage(): string
    {
        return $this->getMessages()->current()->getMessage();
    }

    public function getMessagesArray(): array
    {
        $messages = [];

        foreach ($this->getMessages() as $message) {
            $messages[] = $message->getMessage();
        }

        return $messages;
    }

    public function post(array $postParams): bool
    {
        $this->common($postParams);

        return $this->validate($postParams);
    }

    public function put(array $postParams): bool
    {
        $this->common($postParams);

        return $this->validate($postParams);
    }
}
