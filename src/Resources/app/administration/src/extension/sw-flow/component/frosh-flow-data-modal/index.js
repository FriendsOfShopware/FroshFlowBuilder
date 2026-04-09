import template from './frosh-flow-data-modal.html.twig'
import './frosh-flow-data-modal.scss'

const {Component} = Shopware

Component.register('frosh-flow-data-modal', {
  template,
  emits: ['modal-close'],
  props: {
    flowHistoryEntry: {
      required: true,
      type: Object
    }
  },
  methods: {
    onModalChange() {
      this.$emit('modal-close');
    },
  },
  computed: {
    flowData() {
      const data = this.flowHistoryEntry.data
      return data ? JSON.stringify(data, null, 2) : ''
    },
    dateFilter() {
      return Shopware.Filter.getByName('date');
    },
    executedAt() {
      return this.dateFilter(this.flowHistoryEntry.createdAt, { hour: '2-digit', minute: '2-digit' });
    },
    stateColor() {
      const colorMap = {
        success: '#37d046',
        error: '#de294c',
      };

      return colorMap[this.flowHistoryEntry.state] || '#d1d9e0';
    },
  }
})
