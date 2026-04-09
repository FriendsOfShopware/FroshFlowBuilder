<?php

declare(strict_types=1);

namespace Frosh\FlowBuilder\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1775132753ChangeExceptionColumnToJson extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1775132753;
    }

    public function update(Connection $connection): void
    {
        $connection->executeStatement(
            'ALTER TABLE `frosh_flow_state` DROP COLUMN `error`;
ALTER TABLE `frosh_flow_state` ADD COLUMN `error` JSON NULL'
        );
    }
}
