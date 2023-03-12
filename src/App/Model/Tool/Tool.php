<?php

namespace App\Model\Tool;

class Tool
{

    public const TOOL_URL_SHORTNER = 1;

    private int $id;
    private ?int $userLevel;
    private ?int $businessLevel;
    private string $title;
    private string $description;
    private string $path;
    private bool $active;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserLevel(): ?int
    {
        return $this->userLevel;
    }

    public function setUserLevel(?int $userLevel): void
    {
        $this->userLevel = $userLevel;
    }

    public function getBusinessLevel(): ?int
    {
        return $this->businessLevel;
    }

    public function setBusinessLevel(?int $businessLevel): void
    {
        $this->businessLevel = $businessLevel;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

}