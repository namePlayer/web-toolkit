<?php

namespace App\Model\Support;

class SupportTicketMessage
{

    private int $id;
    private int $account;
    private int $ticket;
    private \DateTime $created;
    private string $message;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getAccount(): int
    {
        return $this->account;
    }

    public function setAccount(int $account): void
    {
        $this->account = $account;
    }

    public function getTicket(): int
    {
        return $this->ticket;
    }

    public function setTicket(int $ticket): void
    {
        $this->ticket = $ticket;
    }

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

}
