# General

This Magento2 module allows publishing queue messages to be processed after a specified number of minutes

# Installation
Run `composer require softKultur/magento2-delayed-queue-messages/` and then `bin/magento setup:upgrade`.


# Technical details
The module introduces a plugin for the `\Magento\Framework\MessageQueue\PublisherInterface` which checks if the
published message is an instance of the `\SoftKultur\DelayedQueueMessages\Api\DelayedQueueMessageInterface` interface.

The module provides a base implementation for the `\SoftKultur\DelayedQueueMessages\Api\DelayedQueueMessageInterface` interface which can be used for all types of queue messages payloads: `\SoftKultur\DelayedQueueMessages\Model\DelayedQueueMessage`

In this case, it saves the message in the `softkultur_delayed_queue_message` database table.

Each minute, a cronjob checks the said table for unpublished messages that are available (`available_at` in the past) 
and publishes them to the corresponding queue.

The module also introduces a new CLI command which runs the same logic as the cronjob:
`bin/magento softkultur:delayed-queue-messages:publish`.