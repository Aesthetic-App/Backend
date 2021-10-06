Nova.booting((Vue, router, store) => {
  Vue.component('index-relation-select', require('./components/IndexField'))
  Vue.component('detail-relation-select', require('./components/DetailField'))
  Vue.component('form-relation-select', require('./components/FormField'))
})
