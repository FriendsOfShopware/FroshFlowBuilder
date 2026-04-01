import './component/frosh-flow-history'
import './page/sw-flow-detail'

Shopware.Module.register('frosh-flow-tab-history', {
  routeMiddleware(next, currentRoute) {
    const routeName = 'sw.flow.detail.frosh_history'

    if(currentRoute.name === 'sw.flow.detail'
      && currentRoute.children.every((currentRoute) => currentRoute.name !== routeName)
    ){
      currentRoute.children.push({
        name: routeName,
        path: '/sw/flow/detail/:id/frosh-history',
        component: 'frosh-flow-history',
        meta: {
          parentPath: 'sw.flow.index'
        }
      })
    }
  }
})
