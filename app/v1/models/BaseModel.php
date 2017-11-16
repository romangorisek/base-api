<?php

namespace Ekranj\Models;

use Phalcon\Mvc\Model;
use Ramsey\Uuid\Uuid;

abstract class BaseModel extends Model
{
    public function initialize()
    {
        $this->useDynamicUpdate(true);
    }

    public function beforeValidationOnCreate()
    {
        if (property_exists($this, 'created_on')) {
            $this->created_on = $this->getDI()->get('date')->now();
        }

        if (property_exists($this, 'updated_on')) {
            $this->updated_on = $this->getDI()->get('date')->now();
        }

        $user = $this->getDi()->get('auth')->getUser();
        if ($user && property_exists($this, 'created_by')) {
            $this->created_by = $user->id;
        }
        
        if ($user && property_exists($this, 'updated_by')) {
            $this->updated_by = $user->id;
        }

        if (!isset($this->id)) {
            $this->id = Uuid::uuid4()->toString();
        }
    }

    public function beforeValidationOnUpdate()
    {
        if (property_exists($this, 'updated_on')) {
            $this->updated_on = $this->getDI()->get('date')->now();
        }

        if (property_exists($this, 'updated_by') && $user = $this->getDi()->get('auth')->getUser()) {
            $this->updated_by = $user->id;
        }
    }

    public function afterCreate()
    {
    }

    public function afterSave()
    {
    }

    public function hasProperty($propertyName)
    {
        return array_key_exists($propertyName, $this->toArray());
    }

    public static function get($id)
    {
        return static::findFirst([
            'id = :id:',
            'bind' => [
                'id' => $id
            ]
        ]);
    }

    public function getMessagesArray(): array
    {
        $messages = [];

        foreach ($this->getMessages() as $message) {
            $messages[] = $message->getMessage();
        }

        return $messages;
    }
}
