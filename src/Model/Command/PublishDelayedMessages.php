<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Model\Command;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\MessageQueue\MessageEncoder;
use Magento\Framework\MessageQueue\PublisherInterface;
use Psr\Log\LoggerInterface;
use SoftKultur\DelayedQueueMessages\Api\Data\DelayedMessageInterface;
use SoftKultur\DelayedQueueMessages\Api\DelayedMessageRepositoryInterface;

class PublishDelayedMessages
{
    /**
     * Constructor
     *
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param DelayedMessageRepositoryInterface $delayedMessageRepository
     * @param PublisherInterface $publisher
     * @param MessageEncoder $messageEncoder
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly SearchCriteriaBuilder $searchCriteriaBuilder,
        private readonly DelayedMessageRepositoryInterface $delayedMessageRepository,
        private readonly PublisherInterface $publisher,
        private readonly MessageEncoder $messageEncoder,
        private readonly LoggerInterface $logger,
    ) {
    }

    /**
     * Publishes delayed messages that are available now
     *
     * @return void
     * @throws AlreadyExistsException
     */
    public function execute(): void
    {
        $currentPage = 1;

        do {
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter(DelayedMessageInterface::PUBLISHED, false)
                ->addFilter(DelayedMessageInterface::AVAILABLE_AT, (new \DateTime())->format('Y-m-d H:i:s'), 'lt')
                ->setPageSize(100)
                ->setCurrentPage($currentPage)->create();

            $searchResult = $this->delayedMessageRepository->getList($searchCriteria);

            /** @var DelayedMessageInterface $item */
            foreach ($searchResult->getItems() as $item) {
                try {
                    /** @var string $topicName */
                    $topicName = $item->getTopicName();

                    /** @var string $payload */
                    $payload = $item->getPayload();

                    $convertedBody = $this->messageEncoder->decode($topicName, $payload);
                    $this->publisher->publish($topicName, $convertedBody);
                } catch (\Throwable $exception) {
                    $this->logger->error(
                        'Unable to publish delayed queue message',
                        [
                            'error' => $exception->getMessage(),
                            'delayedMessageId' => $item->getEntityId(),
                        ]
                    );
                }

                $item->setPublished(true);
                $this->delayedMessageRepository->save($item);
            }

            $currentPage++;
        } while ($searchResult->getTotalCount() > 0);
    }
}
