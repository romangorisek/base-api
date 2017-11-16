<?php

namespace Ekranj\Library;

use Ekranj\Library\DiInterface;

abstract class Conditions extends DiInterface
{
    public $where = [];
    public $bind = [];
    public $order = null;

    public function __construct($locale)
    {
        $this->where[] = 'locale = :locale:';
        $this->bind['locale'] = $locale;
    }

    public function getConditions()
    {
        $conditions = [];

        if (!empty($this->where)) {
            $conditions['conditions'] = implode(' AND ', $this->where);
        }
        
        if (!empty($this->bind)) {
            $conditions['bind'] = $this->bind;
        }

        if ($this->order != null) {
            $conditions['order'] = $this->order;
        }

        return $conditions;
    }
}
