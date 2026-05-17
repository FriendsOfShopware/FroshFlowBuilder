<?php

declare(strict_types=1);

namespace Frosh\FlowBuilderInsights\Extension;

use Frosh\FlowBuilderInsights\Entity\FlowState\FlowStateDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\User\UserDefinition;

class UserExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToManyAssociationField('froshFlowStates', FlowStateDefinition::class, 'user_id', 'id')
        );
    }

    public function getEntityName(): string
    {
        return UserDefinition::ENTITY_NAME;
    }

    public function getDefinitionClass(): string
    {
        return UserDefinition::ENTITY_NAME;
    }
}
