<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use SoftKultur\DelayedQueueMessages\Api\Data\DelayedMessageInterface;

class DelayedMessage extends AbstractModel implements DelayedMessageInterface
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(ResourceModel\DelayedMessage::class);
    }

    /**
     * Get the entity id
     *
     * @return int
     */
    public function getEntityId(): int
    {
        /** @var string|null $value */
        $value = $this->getData(self::ENTITY_ID);

        return (int)$value;
    }

    /**
     * Set the message topic name
     *
     * @param string|null $topicName
     * @return $this
     */
    public function setTopicName(?string $topicName): static
    {
        return $this->setData(static::TOPIC_NAME, $topicName);
    }

    /**
     * Retrieve the message topic name
     *
     * @return string|null
     */
    public function getTopicName(): ?string
    {
        /** @var string|null $value */
        $value = $this->getData(static::TOPIC_NAME);

        return $value;
    }

    /**
     * Set the message payload
     *
     * @param string|null $payload
     * @return $this
     */
    public function setPayload(?string $payload): static
    {
        return $this->setData(static::PAYLOAD, $payload);
    }

    /**
     * Retrieve the message payload
     *
     * @return string|null
     */
    public function getPayload(): ?string
    {
        /** @var string|null $value */
        $value = $this->getData(static::PAYLOAD);

        return $value;
    }

    /**
     * Set the timestamp when the message is available and can be published
     *
     * @param string|null $availableAt
     * @return $this
     */
    public function setAvailableAt(?string $availableAt): static
    {
        return $this->setData(static::AVAILABLE_AT, $availableAt);
    }

    /**
     * Retrieve the timestamp when the message is available and can be published
     *
     * @return string|null
     */
    public function getAvailableAt(): ?string
    {
        /** @var string|null $value */
        $value = $this->getData(static::AVAILABLE_AT);

        return $value;
    }

    /**
     * Set the delay in minutes
     *
     * @param int|null $delay
     * @return $this
     */
    public function setDelay(?int $delay): static
    {
        return $this->setData(static::DELAY, $delay);
    }

    /**
     * Retrieve the delay in minutes)
     *
     * @return int|null
     */
    public function getDelay(): ?int
    {
        /** @var string|null $value */
        $value = $this->getData(static::DELAY);

        return $value !== null ? (int)$value : null;
    }

    /**
     * Set the published flag
     *
     * @param bool|null $published
     * @return $this
     */
    public function setPublished(?bool $published): static
    {
        return $this->setData(static::PUBLISHED, $published);
    }

    /**
     * Retrieve the published flag
     *
     * @return bool|null
     */
    public function getPublished(): ?bool
    {
        /** @var string|null $value */
        $value = $this->getData(static::PUBLISHED);

        return (bool)$value;
    }

    /**
     * Set the creation timestamp
     *
     * @param string|null $createdAt
     * @return $this
     */
    public function setCreatedAt(?string $createdAt): static
    {
        return $this->setData(static::CREATED_AT, $createdAt);
    }

    /**
     * Retrieve the creation timestamp
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        /** @var string|null $value */
        $value = $this->getData(static::CREATED_AT);

        return $value;
    }

    /**
     * Set the timestamp of the last update
     *
     * @param string|null $updatedAt
     * @return $this
     */
    public function setUpdatedAt(?string $updatedAt): static
    {
        return $this->setData(static::UPDATED_AT, $updatedAt);
    }

    /**
     * Retrieve the timestamp of the last update
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        /** @var string|null $value */
        $value = $this->getData(static::UPDATED_AT);

        return $value;
    }
}
