# Frosh Flow Builder

This plugin extends the Shopware 6 Flow Builder with execution history and error tracking.

The current feature set consists of:

- **Flow Execution History**
  - Records every flow execution (success and error) in a dedicated `frosh_flow_state` table
  - Adds a history tab to the Flow detail page in the administration
  - Captures which user, integration or customer triggered the flow
  - Stores the event payload
- **Error Inspection**
  - Persists exception message, file, line and class for failed flow executions
  - Modal viewer to inspect the stored event data and error details
- **Automatic Cleanup**
  - Scheduled task removes old flow history entries based on a configurable retention time
  - Default retention: 30 days (configurable in plugin configuration)
- **FroshTools Integration (optional)**
  - Health check that reports the number of failed flow executions in the system status
  - Activates automatically when `frosh/tools` is installed

## Installation

### Git
- Clone this repository into custom/plugins of your Shopware 6 installation
- Install composer dependencies `shopware-cli extension prepare custom/plugins/FroshFlowBuilder`
- Build the assets with `shopware-cli extension build custom/plugins/FroshFlowBuilder`
- Install and activate via `bin/console plugin:refresh && bin/console plugin:install --activate FroshFlowBuilder`

### Packagist
    composer require frosh/frosh-flow-builder
    bin/console plugin:refresh
    bin/console plugin:install --activate FroshFlowBuilder

## Configuration

Configure the plugin via the administration (Settings → Extensions → Frosh Flow Builder) or via system config:

| Key | Default | Description |
|-----|---------|-------------|
| `retentionTime` | `30` | Number of days after which flow history entries are deleted by the cleanup scheduled task |

## Requirements

- Shopware 6.7 or higher

## Scheduled Tasks

| Task | Description |
|------|-------------|
| `Frosh\FlowBuilder\ScheduledTask\CleanupFlowStateTableTask` | Deletes flow execution history entries older than the configured retention time |
