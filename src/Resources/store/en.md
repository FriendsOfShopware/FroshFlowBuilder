This plugin extends the Shopware 6 Flow Builder with execution history and error tracking.

The current feature set consists of:

*   Flow execution history
    *   Logs every flow run (success and error) into a dedicated table
    *   Adds a history tab to the flow detail page
*   Error tracking
    *   Stores exception message, file, line and class for failed flows
    *   Modal to inspect the stored event payload and error details
*   Trigger detection
    *   Records which user, integration or customer triggered the flow
*   Automatic cleanup
    *   Scheduled task removes old entries based on a configurable retention time (default: 30 days)
*   Optional FroshTools integration
    *   Adds a health check that reports failed flow executions in the system status
    *   Activates automatically when FroshTools is installed

Link to repository: [https://github.com/FriendsOfShopware/FroshFlowBuilder](https://github.com/FriendsOfShopware/FroshFlowBuilder)

This plugin is part of [@FriendsOfShopware](https://store.shopware.com/en/friends-of-shopware.html).

For questions or bugs please create a [Github Issue](https://github.com/FriendsOfShopware/FroshFlowBuilder/issues/new)
