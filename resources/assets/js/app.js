/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component(
  'sidebar-left-menu',
  require('./components/sidebar/left/menu.vue'),
)

// Home
Vue.component(
  'content-home',
  require('./components/content/home/page.vue'),
)

// Transactions
Vue.component(
  'content-transactions',
  require('./components/content/transactions/page.vue'),
)

// Accounts
Vue.component(
  'content-accounts',
  require('./components/content/accounts/page.vue'),
)

// Categories
Vue.component(
  'content-categories',
  require('./components/content/categories/page.vue'),
)

// Frequencies
Vue.component(
  'content-frequencies',
  require('./components/content/frequencies/page.vue'),
)

// Reports
Vue.component(
  'content-report-weekly',
  require('./components/content/report/weekly/page.vue'),
)
Vue.component(
  'content-report-bi-weekly',
  require('./components/content/report/bi-weekly/page.vue'),
)
Vue.component(
  'content-report-monthly',
  require('./components/content/report/monthly/page.vue'),
)


const app = new Vue(
  {
    el: '#app',
  },
)
