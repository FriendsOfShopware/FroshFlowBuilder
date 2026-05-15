<?php

declare(strict_types=1);

namespace Frosh\FlowBuilderInsights\Entity\FlowState;

use Shopware\Core\Checkout\Customer\CustomerDefinition;
use Shopware\Core\Content\Flow\FlowDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\JsonField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Integration\IntegrationDefinition;
use Shopware\Core\System\User\UserDefinition;

class FlowStateDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'frosh_flow_state';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return FlowStateEntity::class;
    }

    public function getCollectionClass(): string
    {
        return FlowStateCollection::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('flow_id', 'flowId', FlowDefinition::class))->addFlags(new Required()),
            (new StringField('state', 'state'))->addFlags(new Required()),
            new JsonField('error', 'error'),
            new JsonField('data', 'data'),
            new FkField('user_id', 'userId', UserDefinition::class),
            new FkField('integration_id', 'integrationId', IntegrationDefinition::class),
            new FkField('customer_id', 'customerId', CustomerDefinition::class),
            new ManyToOneAssociationField('flow', 'flow_id', FlowDefinition::class, 'id', false),
            new ManyToOneAssociationField('user', 'user_id', UserDefinition::class, 'id', false),
            new ManyToOneAssociationField('integration', 'integration_id', IntegrationDefinition::class, 'id', false),
            new ManyToOneAssociationField('customer', 'customer_id', CustomerDefinition::class, 'id', false),
        ]);
    }
}
