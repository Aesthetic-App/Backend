import Vue from "vue";
import PrimeVue from 'primevue/config';


Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'translation',
      path: '/translation',
      component: require('./components/Tool'),
    },
  ])
})

Vue.use(PrimeVue)
Vue.config.devtools = true
