<?php

namespace App\PlatesExtension\Message;

class MessageList
{

    private array $messageList = [];

    public function add(string $type, string $message): void
    {
        $this->messageList[] =
            [
                'type' => $type,
                'message' => $message
            ];
    }

    public function getAll(): array
    {
        return $this->messageList;
    }

    public function countByType(string $type): int
    {
        $count = 0;
        foreach ($this->messageList as $message)
        {
            if($message['type'] === $type)
            {
                $count++;
            }
        }
        return $count;
    }

}