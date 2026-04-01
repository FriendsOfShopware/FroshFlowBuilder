<?php

declare(strict_types=1);

namespace Frosh\FlowBuilder\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1775076105FlowStateTriggeringUser extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1775076105;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL
ALTER TABLE `frosh_flow_state` 
    ADD COLUMN `user_id` BINARY(16) NULL,
    ADD COLUMN `customer_id` BINARY(16) NULL,
    ADD COLUMN `integration_id` BINARY(16) NULL,
    ADD CONSTRAINT `frosh_flow_state__user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
    ADD CONSTRAINT `frosh_flow_state__customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
    ADD CONSTRAINT `frosh_flow_state__integration_id` FOREIGN KEY (`integration_id`) REFERENCES `integration` (`id`) ON UPDATE CASCADE ON DELETE SET NULL;
SQL;

        $connection->executeStatement($sql);

    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
