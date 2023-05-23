<?php declare(strict_types=1);

namespace App\Service\Forms;

use App\Model\Forms\FormEntry;
use App\Model\Forms\FormEntryField;
use App\Table\Forms\FormEntryFieldTable;
use App\Table\Forms\FormEntryTable;
use Ramsey\Uuid\Uuid;

class FormEntryService
{

    public function __construct(
        private FormEntryTable $formEntryTable,
        private FormEntryFieldTable $formEntryFieldTable,
        private FormFieldService $formFieldService
    )
    {
    }

    public function createFromFormIdAndPostData(int $form, array $postData):bool|array
    {
        $emptyFields = [];
        $entries = [];
        foreach ($postData as $field => $value) {
            $formField = $this->formFieldService->getFieldByUUID($field);
            if(isset($formField['options']['required']) && empty($value))
            {
                $emptyFields[] = $field;
            }

            $entry = new FormEntryField();
            $entry->setField($this->formFieldService->getFieldByUUID($field)['id']);
            $entry->setValue($value);
            $entries[] = $entry;
        }

        if(empty($emptyFields))
        {
            $formEntry = new FormEntry();
            $formEntry->setUuid($this->generateEntryUuid());
            $formEntry->setForm($form);
            $formEntryId = (int)$this->formEntryTable->insert($formEntry);

            $errors = 0;
            foreach ($entries as $entryField)
            {
                $entryField->setEntry($formEntryId);
                if($this->formEntryFieldTable->insert($entryField) === false)
                {
                    $errors++;
                }
            }
            return $errors === 0;
        }

        return $emptyFields;
    }

    public function getEntryListForFormId(int $form): array
    {
        return $this->formEntryTable->findAllEntryByFormId($form);
    }

    public function findEntriesByUuid(string $uuid): array
    {
        return $this->formEntryTable->findEntriesByUuid($uuid);
    }

    private function generateEntryUuid(): string
    {
        do {
            $uuid = Uuid::uuid7()->toString();
        } while(!empty($this->findEntriesByUuid($uuid)));
        return $uuid;
    }

}
