<?php declare(strict_types=1);

namespace App\Table\Mail;

use App\Model\Mail\Mail;
use App\Software;
use App\Table\AbstractTable;
use DateTime;

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

    public function findAllNotSentLimit(int $limit): array|bool
    {
        return $this->query->from($this->getTableName())->where('sent', NULL)
            ->select('MailType.template')
            ->leftJoin('MailType on MailType.id = Mail.type')
            ->limit($limit)
            ->orderBy('created ASC')->fetchAll();
    }

    public function updateMailSentById(int $id): void
    {
        $this->query->update($this->getTableName())->set('sent', (new DateTime())->format(Software::DATABASE_TIME_FORMAT))->where('id', $id)->execute();
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

    public function getGroupedMailTypeAmount(): array|bool
    {

        return $this->query->from($this->getTableName())->select(null)->select('MailType.title, COUNT(*) as amount')
            ->leftJoin('MailType on MailType.id = Mail.type')
            ->groupBy('MailType.title')->orderBy('amount DESC')->fetchAll();

    }

}
