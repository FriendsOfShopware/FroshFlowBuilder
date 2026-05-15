<?php

namespace Frosh\FlowBuilderInsights\Subscriber;

use Frosh\FlowBuilderInsights\Entity\FlowState\FlowStateCollection;
use Psr\Log\LoggerInterface;
use Shopware\Core\Content\Flow\Extension\FlowExecutorExtension;
use Shopware\Core\Framework\Api\Context\AdminApiSource;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\PlatformRequest;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class FlowSubscriber implements EventSubscriberInterface
{
    public const FLOW_STATE_SUCCESS = 'success';
    public const FLOW_STATE_ERROR = 'error';

    /**
     * @param EntityRepository<FlowStateCollection> $flowStateRepo
     */
    public function __construct(
        #[Autowire(service: 'frosh_flow_state.repository')]
        private readonly EntityRepository $flowStateRepo,
        #[Autowire(service: 'request_stack')]
        private readonly RequestStack $requestStack,
        private readonly LoggerInterface $logger,
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            FlowExecutorExtension::NAME . '.post' => 'onFlowExecutedSuccess',
            FlowExecutorExtension::NAME . '.error' => 'onFlowExecutedError',
        ];
    }

    public function onFlowExecutedSuccess(FlowExecutorExtension $extension): void
    {
        $this->handleFlowExecution($extension, self::FLOW_STATE_SUCCESS);
    }

    public function onFlowExecutedError(FlowExecutorExtension $extension): void
    {
        $this->handleFlowExecution($extension, self::FLOW_STATE_ERROR);
    }

    private function handleFlowExecution(FlowExecutorExtension $extension, string $state): void
    {
        $request = $this->requestStack->getCurrentRequest();
        $context = $request?->attributes->get(PlatformRequest::ATTRIBUTE_CONTEXT_OBJECT);

        $userId = null;
        $integrationId = null;

        if ($context instanceof Context) {
            $contextSource = $context->getSource();
            if ($contextSource instanceof AdminApiSource) {
                $userId = $contextSource->getUserId();
                $integrationId = $contextSource->getIntegrationId();
            }
        }

        $salesChannelContext = $request?->attributes->get(PlatformRequest::ATTRIBUTE_SALES_CHANNEL_CONTEXT_OBJECT);
        $customerId = null;

        if ($salesChannelContext instanceof SalesChannelContext) {
            $customerId = $salesChannelContext->getCustomerId();
        }

        $exception = $extension->exception;

        try {
            $this->flowStateRepo->create([[
                'flowId' => $extension->flow->getId(),
                'state' => $state,
                'error' => $exception ? [
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'type' => $exception::class,
                ] : null,
                'data' => $extension->event->stored(),
                'userId' => $userId,
                'integrationId' => $integrationId,
                'customerId' => $customerId,
            ]], Context::createCLIContext());
        } catch (\Throwable $e) {
            $this->logger->error('Failed to persist flow execution state', [
                'flowId' => $extension->flow->getId(),
                'state' => $state,
                'exception' => $e,
            ]);
            throw $e;
        }
    }
}
