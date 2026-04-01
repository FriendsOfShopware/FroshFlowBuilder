import template from './sw-flow-detail.html.twig'

const {Component} = Shopware
const {Criteria} = Shopware.Data

Component.override('sw-flow-detail', {
  template,
  computed: {
    flowCriteria() {
      const criteria = this.$super('flowCriteria')
      criteria.addAssociation('froshFlowStates')
      criteria.addAssociation('froshFlowStates.user')
      criteria.addAssociation('froshFlowStates.integration')
      criteria.addAssociation('froshFlowStates.customer')
      criteria.getAssociation('froshFlowStates').setLimit(25)
      criteria.getAssociation('froshFlowStates').addSorting(
        Criteria.sort('createdAt', 'DESC')
      )

      return criteria;
    }
  }
})
