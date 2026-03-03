<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Plugin;

use Magento\Framework\MessageQueue\MessageValidator;
use Magento\Framework\MessageQueue\PublisherInterface;
use SoftKultur\DelayedQueueMessages\Api\DelayedQueueMessageInterface;
use SoftKultur\DelayedQueueMessages\Model\Command\CreateDelayedMessage;

class DelayQueueMessage
{
    /**
     * @param CreateDelayedMessage $createDelayedMessage
     * @param MessageValidator $messageValidator
     */
    public function __construct(
        private readonly CreateDelayedMessage $createDelayedMessage,
        private readonly MessageValidator $messageValidator,
    ) {
    }

    /**
     * If the message is delayed, it should be validated and saved to the database instead of directly publishing it
     *
     * @param PublisherInterface $subject
     * @param callable $proceed
     * @param string $topicName
     * @param mixed $data
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function aroundPublish(PublisherInterface $subject, callable $proceed, string $topicName, mixed $data): mixed
    {
        if (!$data instanceof DelayedQueueMessageInterface) {
            return $proceed($topicName, $data);
        }

        $this->messageValidator->validate($topicName, $data->getData());

        $this->createDelayedMessage->execute($topicName, $data->getData(), $data->getDelay());

        return null;
    }
}
