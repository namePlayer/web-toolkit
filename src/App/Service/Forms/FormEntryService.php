<?php declare(strict_types=1);

namespace App\Service\Forms;

use App\Model\Forms\FormEntry;
use App\Table\Forms\FormEntryTable;
use Ramsey\Uuid\Uuid;

class FormEntryService
{

    public function __construct(
        private FormEntryTable $formEntryTable,
        private FormFieldService $formFieldService
    )
    {
    }

    public function createFromFormIdAndPostData(int $form, array $postData):bool|array
    {
        $uuid = $this->generateEntryUuid();
        $emptyFields = [];
        $entries = [];
        foreach ($postData as $field => $value) {
            $formField = $this->formFieldService->getFieldByUUID($field);
            if(isset($formField['options']['required']) && empty($value))
            {
                $emptyFields[] = $field;
            }

            $entry = new FormEntry();
            $entry->setForm($form);
            $entry->setUuid($uuid);
            $entry->setField($this->formFieldService->getFieldByUUID($field)['id']);
            $entry->setValue($value);
            $entries[] = $entry;
        }

        if(empty($emptyFields))
        {
            $errors = 0;
            foreach ($entries as $entry)
            {
                if($this->formEntryTable->insert($entry) === false)
                {
                    $errors++;
                }
            }
            if($errors === 0)
            {
                return true;
            }
            return false;
        }

        return $emptyFields;
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
