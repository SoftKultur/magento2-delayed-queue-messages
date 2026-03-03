<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Api;

interface DelayedQueueMessageInterface
{
    /**
     * The queue message payload
     *
     * @return mixed
     */
    public function getData(): mixed;

    /**
     * Returns the numbers of minutes of delay
     * Keep in mind that messages are published via cronjob that runs once a minute, so the actual delay might be varied
     * if the cron is delayed or is not working
     *
     * @return int
     */
    public function getDelay(): int;
}
