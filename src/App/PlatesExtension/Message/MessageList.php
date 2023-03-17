<?php

namespace App\PlatesExtension\Message;

use Monolog\Logger;

class MessageList
{

    private array $messageList = [];

    public function __construct(private readonly Logger $logger)
    {
    }

    public function add(string $type, string $message, string $additionalData = ''): void
    {

        $messageArray = [
            'type' => $type,
            'message' => $message,
            'additionalData' => $additionalData
        ];

        $this->logger->debug("Added new Message (MessageList.php)", $messageArray);

        $this->messageList[] = $messageArray;
    }

    public function getAll(): array
    {
        $this->logger->debug("Getting Message Array (MessageList.php)");

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
        $this->logger->debug("Counted all Messages with type $type :: $count (MessageList.php)");

        return $count;
    }

}