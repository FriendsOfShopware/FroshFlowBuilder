<?php

declare(strict_types=1);

namespace Frosh\FlowBuilderInsights\Entity\FlowState;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @extends EntityCollection<FlowStateEntity>
 */
class FlowStateCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return FlowStateEntity::class;
    }
}
