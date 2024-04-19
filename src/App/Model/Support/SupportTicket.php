<?php
declare(strict_types=1);

namespace App\Model\Support;

class SupportTicket
{

    private int $id;
    private int $account;
    private ?int $assignedTechAccount;
    private int $status;
    private string $title;
    private \DateTime $created;
    private \DateTime $updated;

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

    public function getAssignedTechAccount(): ?int
    {
        return $this->assignedTechAccount;
    }

    public function setAssignedTechAccount(?int $assignedTechAccount): void
    {
        $this->assignedTechAccount = $assignedTechAccount;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    public function setUpdated(\DateTime $updated): void
    {
        $this->updated = $updated;
    }

}
