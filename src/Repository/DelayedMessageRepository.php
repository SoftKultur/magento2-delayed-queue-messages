<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Repository;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use SoftKultur\DelayedQueueMessages\Api\Data\DelayedMessageInterface;
use SoftKultur\DelayedQueueMessages\Api\Data\DelayedMessageInterfaceFactory;
use SoftKultur\DelayedQueueMessages\Api\DelayedMessageRepositoryInterface;
use SoftKultur\DelayedQueueMessages\Model\ResourceModel\DelayedMessage;
use SoftKultur\DelayedQueueMessages\Model\ResourceModel\DelayedMessage\CollectionFactory;

class DelayedMessageRepository implements DelayedMessageRepositoryInterface
{
    /**
     * Constructor
     *
     * @param DelayedMessage $resourceModel
     * @param CollectionProcessor $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        private readonly DelayedMessage $resourceModel,
        private readonly CollectionProcessor $collectionProcessor,
        private readonly SearchResultsInterfaceFactory $searchResultFactory,
        private readonly CollectionFactory $collectionFactory,
    ) {
    }

    /**
     * Save a delayed message
     *
     * @param DelayedMessageInterface $delayedMessage
     * @return DelayedMessageInterface
     * @throws AlreadyExistsException
     */
    public function save(DelayedMessageInterface $delayedMessage): DelayedMessageInterface
    {
        /** @var \SoftKultur\DelayedQueueMessages\Model\DelayedMessage $delayedMessage */
        $this->resourceModel->save($delayedMessage);

        return $delayedMessage;
    }

    /**
     * Retrieve the list of delayed messages based on search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteria $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteria $searchCriteria): SearchResultsInterface
    {
        /** @var \SoftKultur\DelayedQueueMessages\Model\ResourceModel\DelayedMessage\Collection $collection */
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var \Magento\Framework\Api\SearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setItems($collection->getItems()); // @phpstan-ignore-line
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
