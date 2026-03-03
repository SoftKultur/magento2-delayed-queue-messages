<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Model;

use SoftKultur\DelayedQueueMessages\Api\DelayedQueueMessageInterface;

class DelayedQueueMessage implements DelayedQueueMessageInterface
{
    /**
     * @param mixed $data
     * @param int $delay
     */
    public function __construct(
        private readonly mixed $data,
        private readonly int $delay,
    ) {
    }

    /**
     * The queue message payload
     *
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * Returns the numbers of minutes of delay
     * Keep in mind that messages are published via cronjob that runs once a minute, so the actual delay might be varied
     * if the cron is delayed or is not working
     *
     * @return int
     */
    public function getDelay(): int
    {
        return $this->delay;
    }
}
