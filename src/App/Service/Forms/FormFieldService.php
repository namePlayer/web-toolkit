<?php declare(strict_types=1);

namespace App\Service\Forms;

use App\Table\Forms\FormFieldTable;
use App\Table\Forms\FormFieldTypeTable;

class FormFieldService
{

    public function __construct(
        private readonly FormFieldTable $formFieldTable,
        private readonly FormFieldTypeTable $formFieldTypeTable
    )
    {
    }

    public function getAllAvailableFields(): array
    {
        return $this->formFieldTypeTable->findAll();
    }

}
