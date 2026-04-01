<?php

declare(strict_types=1);

namespace Frosh\FlowBuilder\Migration;

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
    `error` LONGTEXT NULL,
    `data` LONGTEXT NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    CONSTRAINT `frosh_flow_state__flow_id` FOREIGN KEY (`flow_id`) REFERENCES `flow` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
);
SQL;

        $connection->executeStatement($sql);

    }

}
