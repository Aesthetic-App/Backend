Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'translation',
      path: '/translation',
      component: require('./components/Tool'),
    },
  ])
})
