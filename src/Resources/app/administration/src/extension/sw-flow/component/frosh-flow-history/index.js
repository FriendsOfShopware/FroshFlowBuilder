import template from './frosh-flow-history.html.twig';

const { Component, Store } = Shopware;
const { mapState } = Component.getComponentHelper();

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
                        'frosh-flow-builder.history.columns.executedAt'
                    ),
                    primary: true,
                },
                {
                    property: 'state',
                    label: this.$tc(
                        'frosh-flow-builder.history.columns.status'
                    ),
                },
                {
                    property: 'triggeredBy',
                    label: this.$tc(
                        'frosh-flow-builder.history.columns.triggeredBy'
                    ),
                },
            ];
        },
        dateFilter() {
            return Shopware.Filter.getByName('date');
        },
        ...mapState(() => Store.get('swFlow'), ['flow']),
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
