<?php declare(strict_types=1);

namespace App\Table\Forms;

use App\Model\Forms\Form;
use App\Table\AbstractTable;
use http\Params;

class FormTable extends AbstractTable
{

    public function insert(Form $form): array|bool
    {
        $values = [
            'account' => $form->getAccount(),
            'uuid' => $form->getUuid(),
            'name' => $form->getName()
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();
    }

    public function findByUuid(string $uuid): array|bool
    {
        return $this->query->from($this->getTableName())->where('uuid', $uuid)->fetch();
    }

    public function findAllByAccount(int $account, string $order = "created DESC"): array|bool
    {
        return $this->query->from($this->getTableName())->where('account', $account)->orderBy($order)->fetchAll();
    }

}
