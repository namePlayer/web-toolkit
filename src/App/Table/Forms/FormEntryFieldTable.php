<?php declare(strict_types=1);

namespace App\Table\Forms;

use App\Model\Forms\FormEntryField;
use App\Table\AbstractTable;

class FormEntryFieldTable extends AbstractTable
{

    public function insert(FormEntryField $formEntryField): array|bool
    {
        $values = [
            'entry' => $formEntryField->getEntry(),
            'field' => $formEntryField->getField(),
            'value' => $formEntryField->getValue()
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();
    }

    public function findEntriesByUuid(string $uuid): array|false
    {
        return $this->query->from($this->getTableName())->where('uuid', $uuid)->fetchAll();
    }

}
