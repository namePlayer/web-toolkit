<?php declare(strict_types=1);

namespace App\Service\Forms;

use App\Model\Forms\Form;
use App\Table\Forms\FormTable;
use Ramsey\Uuid\Uuid;

readonly class FormService
{

    public function __construct(
        private FormTable $formTable
    )
    {
    }

    public function create(Form $form): ?string
    {
        $form->setUuid($this->generateFormUuid());

        if ($this->formTable->insert($form) !== FALSE) {
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
        $form = $this->formTable->findByUuid($uuid);
        if (isset($form['additionalData'])) {
            $form['additionalData'] = json_decode($form['additionalData'], true);
        }
        return $form;
    }

    private function generateFormUuid(): string
    {
        do {
            $uuid = Uuid::uuid4()->toString();
        } while ($this->isUuidUsed($uuid));

        return $uuid;
    }

    private function isUuidUsed(string $uuid): bool
    {
        return $this->formTable->findByUuid($uuid) !== false;
    }

}
