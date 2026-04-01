<?php

namespace Frosh\FlowBuilder\ScheduledTask;

use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\MessageQueue\ScheduledTask\ScheduledTaskHandler;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(handles: CleanupFlowStateTableTask::class)]
class CleanupFlowStateTableTaskHandler extends ScheduledTaskHandler
{

    public function __construct(
        EntityRepository $scheduledTaskRepository,
        LoggerInterface $exceptionLogger,
        private readonly Connection $connection,
        private readonly SystemConfigService $configService,
    )
    {
        parent::__construct($scheduledTaskRepository, $exceptionLogger);
    }

    public function run(): void
    {
        $sql = <<<SQL
DELETE FROM `frosh_flow_state` WHERE created_at < DATE_SUB(NOW(), INTERVAL :retentionTime DAY)
SQL;

        $this->connection->executeStatement($sql, [
            'retentionTime' => $this->configService->getInt('FroshFlowBuilder.config.retentionTime')
        ]);
    }
}
