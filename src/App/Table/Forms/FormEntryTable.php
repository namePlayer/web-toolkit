<?php

namespace App\Table\Forms;

use App\Model\Forms\FormEntry;
use App\Table\AbstractTable;

class FormEntryTable extends AbstractTable
{

    public function insert(FormEntry $formEntry): array|bool|string|int
    {
        $values = [
            'form' => $formEntry->getForm(),
            'uuid' => $formEntry->getUuid()
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->execute();
    }

    public function findEntriesByUuid(string $uuid): array|false
    {
        return $this->query->from($this->getTableName())->where('uuid', $uuid)->fetchAll();
    }

    public function findAllEntryByFormId(int $form): array|false
    {
        return $this->query->from($this->getTableName())->where('form', $form)->fetchAll();
    }

}
