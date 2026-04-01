<?php

declare(strict_types=1);

namespace Frosh\FlowBuilder\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1775048197FroshFlowStateDataAsJson extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1775048197;
    }

    public function update(Connection $connection): void
    {
        $connection->executeStatement("ALTER TABLE `frosh_flow_state` DROP COLUMN `data`");
        $connection->executeStatement("ALTER TABLE `frosh_flow_state` ADD COLUMN `data` JSON NULL");
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
