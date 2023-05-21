<?php

namespace App\Table\Forms;

use App\Model\Forms\FormEntry;
use App\Table\AbstractTable;

class FormEntryTable extends AbstractTable
{

    public function insert(FormEntry $formEntry): array|bool
    {
        $values = [
            'uuid' => $formEntry->getUuid(),
            'form' => $formEntry->getForm(),
            'field' => $formEntry->getField(),
            'value' => $formEntry->getValue()
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();
    }

    public function findEntriesByUuid(string $uuid): array|false
    {
        return $this->query->from($this->getTableName())->where('uuid', $uuid)->fetchAll();
    }

}
