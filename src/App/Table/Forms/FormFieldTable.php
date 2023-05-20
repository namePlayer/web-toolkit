<?php declare(strict_types=1);

namespace App\Table\Forms;

use App\Model\Forms\FormField;
use App\Table\AbstractTable;

class FormFieldTable extends AbstractTable
{

    public function insert(FormField $formField): bool|array
    {
        $values = [
            'form' => $formField->getForm(),
            'type' => $formField->getType(),
            'uuid' => $formField->getUuid(),
            'title' => $formField->getTitle(),
            'description' => $formField->getDescription()
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();
    }

    public function findByUuid(string $uuid): bool|array
    {
        return $this->query->from($this->getTableName())->where('uuid', $uuid)->fetch();
    }

}
