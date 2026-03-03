<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Model\ResourceModel\DelayedMessage;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use SoftKultur\DelayedQueueMessages\Model\DelayedMessage;
use SoftKultur\DelayedQueueMessages\Model\ResourceModel\DelayedMessage as DelayedMessageResourceModel;

class Collection extends AbstractCollection
{
    /**
     * Initialize resources
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(DelayedMessage::class, DelayedMessageResourceModel::class);
    }
}
