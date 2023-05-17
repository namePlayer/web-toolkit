<?php declare(strict_types=1);

namespace App\Service\Forms;

use App\Model\Forms\Form;
use App\Table\Forms\FormTable;
use Ramsey\Uuid\Uuid;

class FormService
{

    public function __construct(
        private readonly FormTable $formTable
    )
    {
    }

    public function create(Form $form): ?string
    {
        $form->setUuid($this->generateFormUuid());

        if($this->formTable->insert($form) !== FALSE)
        {
            return $form->getUuid();
        }

        return null;
    }

    public function getAllFormsForAccount(int $account): array
    {
        return $this->formTable->findAllByAccount($account);
    }

    public function getFormByUuid(string $uuid): bool|array
    {
        return $this->formTable->findByUuid($uuid);
    }

    private function generateFormUuid(): string
    {
        do {
            $uuid = Uuid::uuid4()->toString();
        } while($this->isUuidUsed($uuid));

        return $uuid;
    }

    private function isUuidUsed(string $uuid): bool
    {
        return $this->formTable->findByUuid($uuid) !== false;
    }

}
