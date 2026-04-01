<?php

declare(strict_types=1);

namespace Frosh\FlowBuilder\Extension;

use Frosh\FlowBuilder\Entity\FlowState\FlowStateDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Integration\IntegrationDefinition;

class IntegrationExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToManyAssociationField('froshFlowStates', FlowStateDefinition::class, 'integration_id', 'id')
        );
    }

    public function getEntityName(): string
    {
        return IntegrationDefinition::ENTITY_NAME;
    }
}
