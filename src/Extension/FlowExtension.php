<?php

declare(strict_types=1);

namespace Frosh\FlowBuilderInsights\Extension;

use Frosh\FlowBuilderInsights\Entity\FlowState\FlowStateDefinition;
use Shopware\Core\Content\Flow\FlowDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class FlowExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToManyAssociationField('froshFlowStates', FlowStateDefinition::class, 'flow_id', 'id')
        );
    }

    public function getEntityName(): string
    {
        return FlowDefinition::ENTITY_NAME;
    }

    public function getDefinitionClass(): string
    {
        return FlowDefinition::class;
    }
}
