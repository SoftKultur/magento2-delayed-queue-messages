<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Api;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use SoftKultur\DelayedQueueMessages\Api\Data\DelayedMessageInterface;

interface DelayedMessageRepositoryInterface
{
    /**
     * Save a delayed message
     *
     * @param DelayedMessageInterface $delayedMessage
     * @return DelayedMessageInterface
     * @throws AlreadyExistsException
     */
    public function save(DelayedMessageInterface $delayedMessage): DelayedMessageInterface;

    /**
     * Retrieve the list of delayed messages based on search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteria $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteria $searchCriteria): SearchResultsInterface;
}
