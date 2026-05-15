<?php

declare(strict_types=1);

namespace Frosh\FlowBuilderInsights\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1775046446FlowStateTable extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1775046446;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `frosh_flow_state` (
    `id` BINARY(16) NOT NULL PRIMARY KEY,
    `flow_id` BINARY(16) NOT NULL,
    `state` VARCHAR(255) NOT NULL,
    `error` JSON NULL,
    `data` JSON NULL,
    `user_id` BINARY(16) NULL,
    `customer_id` BINARY(16) NULL,
    `integration_id` BINARY(16) NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    CONSTRAINT `frosh_flow_state__flow_id` FOREIGN KEY (`flow_id`) REFERENCES `flow` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `frosh_flow_state__user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT `frosh_flow_state__customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT `frosh_flow_state__integration_id` FOREIGN KEY (`integration_id`) REFERENCES `integration` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
);
SQL;

        $connection->executeStatement($sql);
    }
}
