<?php

declare(strict_types=1);

namespace Frosh\FlowBuilder\Extension;

use Frosh\FlowBuilder\Entity\FlowState\FlowStateDefinition;
use Shopware\Core\Checkout\Customer\CustomerDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class CustomerExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToManyAssociationField('froshFlowStates', FlowStateDefinition::class, 'customer_id', 'id')
        );
    }

    public function getEntityName(): string
    {
        return CustomerDefinition::ENTITY_NAME;
    }
}
