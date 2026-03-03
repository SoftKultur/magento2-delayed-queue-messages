<?php

declare(strict_types=1);

namespace SoftKultur\DelayedQueueMessages\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use SoftKultur\DelayedQueueMessages\Model\Command\PublishDelayedMessages;

class PublishDelayedMessagesCommand extends Command
{
    /**
     * Constructor
     *
     * @param PublishDelayedMessages $publishDelayedMessages
     * @param string|null $name
     */
    public function __construct(
        private readonly PublishDelayedMessages $publishDelayedMessages,
        ?string $name = null
    ) {
        parent::__construct($name);
    }

    /**
     * Configure the CLI command
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('softkultur:delayed-queue-messages:publish');
        $this->setDescription('Published delayed queue messages that are available to the corresponding queues');
        parent::configure();
    }

    /**
     * Publishes queue messages that are available now
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->publishDelayedMessages->execute();

        return static::SUCCESS;
    }
}
