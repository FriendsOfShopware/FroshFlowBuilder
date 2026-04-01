<?php

declare(strict_types=1);

namespace Frosh\FlowBuilder\Entity\FlowState;

use Shopware\Core\Checkout\Customer\CustomerEntity;
use Shopware\Core\Content\Flow\FlowEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\Integration\IntegrationEntity;
use Shopware\Core\System\User\UserEntity;

class FlowStateEntity extends Entity
{
    use EntityIdTrait;

    protected string $flowId;

    protected string $state;

    protected ?string $error = null;

    protected ?array $data = null;

    protected ?string $userId = null;

    protected ?string $integrationId = null;

    protected ?string $customerId = null;

    protected ?FlowEntity $flow = null;

    protected ?UserEntity $user = null;

    protected ?IntegrationEntity $integration = null;

    protected ?CustomerEntity $customer = null;

    public function getFlowId(): string
    {
        return $this->flowId;
    }

    public function setFlowId(string $flowId): void
    {
        $this->flowId = $flowId;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function setError(?string $error): void
    {
        $this->error = $error;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): void
    {
        $this->data = $data;
    }

    public function getFlow(): ?FlowEntity
    {
        return $this->flow;
    }

    public function setFlow(?FlowEntity $flow): void
    {
        $this->flow = $flow;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setUserId(?string $userId): void
    {
        $this->userId = $userId;
    }

    public function getIntegrationId(): ?string
    {
        return $this->integrationId;
    }

    public function setIntegrationId(?string $integrationId): void
    {
        $this->integrationId = $integrationId;
    }

    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    public function setCustomerId(?string $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getUser(): ?UserEntity
    {
        return $this->user;
    }

    public function setUser(?UserEntity $user): void
    {
        $this->user = $user;
    }

    public function getIntegration(): ?IntegrationEntity
    {
        return $this->integration;
    }

    public function setIntegration(?IntegrationEntity $integration): void
    {
        $this->integration = $integration;
    }

    public function getCustomer(): ?CustomerEntity
    {
        return $this->customer;
    }

    public function setCustomer(?CustomerEntity $customer): void
    {
        $this->customer = $customer;
    }
}
