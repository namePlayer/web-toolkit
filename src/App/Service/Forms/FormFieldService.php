<?php declare(strict_types=1);

namespace App\Service\Forms;

use App\Table\Forms\FormFieldTable;

class FormFieldService
{

    public function __construct(
        private readonly FormFieldTable $formFieldTable
    )
    {
    }

}
