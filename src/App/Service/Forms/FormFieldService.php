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
        if(!$this->fieldTypeExists($formField->getType()))
        {
            return;
        }

        $formField->setUuid($this->generateFieldUUID());

        $this->formFieldTable->insert($formField);
    }

    public function getAllFieldsForForm(int $form): array
    {
        $fields = $this->formFieldTable->findAllFieldsByFormId($form);

        foreach ($fields as $field => $value) {
            if(isset($value['options']))
            {
                $fields[$field]['options'] = json_decode($value['options'], true);
            }
        }

        return $fields;
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

    public function getFieldByUUID(string $uuid): false|array
    {
        return $this->formFieldTable->findByUuid($uuid);
    }

    private function fieldTypeExists(int $type): bool
    {
        return is_array($this->formFieldTypeTable->findById($type));
    }

}
