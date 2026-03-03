<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Api\Data;

interface DelayedMessageInterface
{
    public const TABLE_NAME = 'softkultur_delayed_queue_message';

    public const ENTITY_ID = 'entity_id';
    public const TOPIC_NAME = 'topic_name';
    public const PAYLOAD = 'payload';
    public const AVAILABLE_AT = 'available_at';
    public const DELAY = 'delay';
    public const PUBLISHED = 'published';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * Get the entity id
     *
     * @return int
     */
    public function getEntityId(): int;

    /**
     * Set the message topic name
     *
     * @param string|null $topicName
     * @return $this
     */
    public function setTopicName(?string $topicName): static;

    /**
     * Retrieve the message topic name
     *
     * @return string|null
     */
    public function getTopicName(): ?string;

    /**
     * Set the message payload
     *
     * @param string|null $payload
     * @return $this
     */
    public function setPayload(?string $payload): static;

    /**
     * Retrieve the message payload
     *
     * @return string|null
     */
    public function getPayload(): ?string;

    /**
     * Set the timestamp when the message is available and can be published
     *
     * @param string|null $availableAt
     * @return $this
     */
    public function setAvailableAt(?string $availableAt): static;

    /**
     * Retrieve the timestamp when the message is available and can be published
     *
     * @return string|null
     */
    public function getAvailableAt(): ?string;

    /**
     * Set the delay in minutes
     *
     * @param int|null $delay
     * @return $this
     */
    public function setDelay(?int $delay): static;

    /**
     * Retrieve the delay in minutes)
     *
     * @return int|null
     */
    public function getDelay(): ?int;

    /**
     * Set the published flag
     *
     * @param bool|null $published
     * @return $this
     */
    public function setPublished(?bool $published): static;

    /**
     * Retrieve the published flag
     *
     * @return bool|null
     */
    public function getPublished(): ?bool;

    /**
     * Set the creation timestamp
     *
     * @param string|null $createdAt
     * @return $this
     */
    public function setCreatedAt(?string $createdAt): static;

    /**
     * Retrieve the creation timestamp
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Set the timestamp of the last update
     *
     * @param string|null $updatedAt
     * @return $this
     */
    public function setUpdatedAt(?string $updatedAt): static;

    /**
     * Retrieve the timestamp of the last update
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string;
}
