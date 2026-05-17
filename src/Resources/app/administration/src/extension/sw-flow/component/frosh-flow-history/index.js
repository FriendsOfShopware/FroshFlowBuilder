import template from './frosh-flow-history.html.twig';

const { Component, Store } = Shopware;
const { mapState } = Component.getComponentHelper();

// Shopware 6.7 migrated the flow state from the Vuex module 'swFlowState'
// to the Pinia store 'swFlow'. Resolve the right source per platform version.
const flowStateMapping = Shopware.Feature.isActive('v6.7.0.0')
    ? mapState(() => Store.get('swFlow'), ['flow'])
    : mapState('swFlowState', ['flow']);

Component.register('frosh-flow-history', {
    template,
    props: {
        isLoading: {
            type: Boolean,
            required: false,
            default: false,
        },
    },
    data: () => {
        return {
            modalEntry: null,
        };
    },
    computed: {
        columns() {
            return [
                {
                    property: 'createdAt',
                    label: this.$tc(
                        'frosh-flow-builder-insights.history.columns.executedAt'
                    ),
                    primary: true,
                },
                {
                    property: 'state',
                    label: this.$tc(
                        'frosh-flow-builder-insights.history.columns.status'
                    ),
                },
                {
                    property: 'triggeredBy',
                    label: this.$tc(
                        'frosh-flow-builder-insights.history.columns.triggeredBy'
                    ),
                },
            ];
        },
        dateFilter() {
            return Shopware.Filter.getByName('date');
        },
        ...flowStateMapping,
    },
    methods: {
        getStateColor(state) {
            const colorMap = {
                success: '#37d046',
                error: '#de294c',
            };

            return colorMap[state] || '#d1d9e0';
        },

        openDetailsModal(item) {
            this.modalEntry = item;
        },
        onCloseModal() {
            this.modalEntry = null;
        },
    },
});
