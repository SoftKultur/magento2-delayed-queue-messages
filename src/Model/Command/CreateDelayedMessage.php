<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Model\Command;

use Magento\Framework\MessageQueue\MessageEncoder;
use SoftKultur\DelayedQueueMessages\Api\Data\DelayedMessageInterfaceFactory;
use SoftKultur\DelayedQueueMessages\Api\DelayedMessageRepositoryInterface;

class CreateDelayedMessage
{
    /**
     * Constructor
     *
     * @param MessageEncoder $messageEncoder
     * @param DelayedMessageInterfaceFactory $delayedMessageFactory
     * @param DelayedMessageRepositoryInterface $delayedMessageRepository
     */
    public function __construct(
        private readonly MessageEncoder $messageEncoder,
        private readonly DelayedMessageInterfaceFactory $delayedMessageFactory,
        private readonly DelayedMessageRepositoryInterface $delayedMessageRepository,
    ) {
    }

    /**
     * Create a delayed message based on topic name, data and delay minutes
     *
     * @param string $topicName
     * @param mixed $data
     * @param int $delay
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(string $topicName, mixed $data, int $delay): void
    {
        /** @var \SoftKultur\DelayedQueueMessages\Api\Data\DelayedMessageInterface $message */
        $message = $this->delayedMessageFactory->create();

        $message->setTopicName($topicName);
        $message->setPayload($this->messageEncoder->encode($topicName, $data));
        $message->setAvailableAt(
            (new \DateTime())
                ->modify(sprintf('+%d minutes', $delay))
                ->format('Y-m-d H:i:00')
        );
        $message->setDelay($delay);

        $this->delayedMessageRepository->save($message);
    }
}
