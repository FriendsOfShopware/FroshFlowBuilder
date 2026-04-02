<?php

namespace Frosh\FlowBuilder\FroshTools\Checker;

use Doctrine\DBAL\Connection;
use Frosh\FlowBuilder\Subscriber\FlowSubscriber;
use Frosh\Tools\Components\Health\Checker\CheckerInterface;
use Frosh\Tools\Components\Health\Checker\HealthChecker\HealthCheckerInterface;
use Frosh\Tools\Components\Health\HealthCollection;
use Frosh\Tools\Components\Health\SettingsResult;

class FlowExecutionErrorChecker implements CheckerInterface, HealthCheckerInterface
{

    public function __construct(
        private readonly Connection $connection,
    )
    {
    }

    public function collect(HealthCollection $collection): void
    {
        $numberOfFailedFlows = $this->connection->fetchOne('SELECT COUNT(*) FROM frosh_flow_state WHERE state = :errorState LIMIT 1;', [
            'errorState' => FlowSubscriber::FLOW_STATE_ERROR
        ]);

        if ($numberOfFailedFlows > 0) {
            $collection->add(
                SettingsResult::warning(
                    'flow-execution-failed',
                    'Some flow executions have failed',
                    $numberOfFailedFlows,
                    0
                )
            );
        }
    }
}
