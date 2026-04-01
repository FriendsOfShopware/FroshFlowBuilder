<?php

namespace Frosh\FlowBuilder\ScheduledTask;

use Shopware\Core\Framework\MessageQueue\ScheduledTask\ScheduledTask;

class CleanupFlowStateTableTask extends ScheduledTask
{

    public static function getTaskName(): string
    {
        return 'frosh.cleanup_flow_state_table';
    }

    public static function getDefaultInterval(): int
    {
        return 86400; // 1 day
    }
}
