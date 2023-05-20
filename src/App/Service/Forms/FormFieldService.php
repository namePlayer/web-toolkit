<?php declare(strict_types=1);

namespace App\Service\Forms;

use App\Model\Forms\FormField;
use App\Table\Forms\FormFieldTable;
use App\Table\Forms\FormFieldTypeTable;
use Ramsey\Uuid\Uuid;

class FormFieldService
{

    public function __construct(
        private readonly FormFieldTable $formFieldTable,
        private readonly FormFieldTypeTable $formFieldTypeTable
    )
    {
    }

    public function create(FormField $formField): void
    {
        var_dump($formField->getType());

        if(!$this->fieldTypeExists($formField->getType()))
        {
            return;
        }

        $formField->setUuid($this->generateFieldUUID());

        $this->formFieldTable->insert($formField);
    }

    public function getAllAvailableFields(): array
    {
        return $this->formFieldTypeTable->findAll();
    }

    private function generateFieldUUID(): string
    {
        do {
            $uuid = Uuid::uuid7()->toString();
        } while($this->getFieldByUUID($uuid) !== FALSE);
        return $uuid;
    }

    private function getFieldByUUID(string $uuid): false|array
    {
        return $this->formFieldTable->findByUuid($uuid);
    }

    private function fieldTypeExists(int $type): bool
    {
        return is_array($this->formFieldTypeTable->findById($type));
    }

}
