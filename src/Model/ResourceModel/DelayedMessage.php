<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use SoftKultur\DelayedQueueMessages\Api\Data\DelayedMessageInterface;

class DelayedMessage extends AbstractDb
{
    /**
     * Construct method
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(DelayedMessageInterface::TABLE_NAME, DelayedMessageInterface::ENTITY_ID);
    }
}
