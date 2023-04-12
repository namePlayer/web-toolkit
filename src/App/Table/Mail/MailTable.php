<?php declare(strict_types=1);

namespace App\Table\Mail;

use App\Model\Mail\Mail;
use App\Software;
use App\Table\AbstractTable;

class MailTable extends AbstractTable
{

    public function insert(Mail $mail): bool
    {
        $values = [
            'type' => $mail->getType(),
            'account' => $mail->getAccount(),
            'email' => $mail->getEmail(),
            'subject' => $mail->getSubject(),
            'content' => json_encode($mail->getContent())
        ];
        return $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();
    }

    public function findAllNotSentLimit(): array|bool
    {
        return $this->query->from($this->getTableName())->where('sent', NULL)
            ->select('MailType.template')
            ->leftJoin('MailType on MailType.id = Mail.type')
            ->limit($_ENV['MAILER_MAX_BATCH_SIZE'])
            ->orderBy('created ASC')->fetchAll();
    }

    public function updateMailSentById(int $id): void
    {
        $this->query->update($this->getTableName())->set('sent', (new \DateTime())->format(Software::DATABASE_TIME_FORMAT))->where('id',$id)->execute();
    }

    public function findAmountBySentNull(): int|string
    {
        return $this->query->from($this->getTableName())->select(null)->select('COUNT(*)')->where('sent', null)->fetchColumn();
    }

    public function findAmountByLastDays(int $days): int|string
    {
        return $this->query->from($this->getTableName())->select(null)->select('COUNT(*)')->where(
            'created between date_sub(now(),INTERVAL ' . $days . ' day) and now()'
        )->fetchColumn();
    }

}
