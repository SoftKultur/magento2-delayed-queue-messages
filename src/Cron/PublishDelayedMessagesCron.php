<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Cron;

use SoftKultur\DelayedQueueMessages\Model\Command\PublishDelayedMessages;

class PublishDelayedMessagesCron
{
    /**
     * Constructor
     *
     * @param PublishDelayedMessages $publishDelayedMessages
     */
    public function __construct(
        private readonly PublishDelayedMessages $publishDelayedMessages,
    ) {
    }

    /**
     * Call message published
     *
     * @return void
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function execute(): void
    {
        $this->publishDelayedMessages->execute();
    }
}
