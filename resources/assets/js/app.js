
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('example', require('./components/Example.vue'));

Vue.component(
    'sidebar.left.menu',
    require('./components/sidebar/left/menu.vue')
);

// Accounts
Vue.component(
    'content.accounts',
    require('./components/content/accounts/page.vue')
);
Vue.component(
    'content.accounts.search',
    require('./components/content/accounts/search.vue')
);
Vue.component(
    'content.accounts.table',
    require('./components/content/accounts/table.vue')
);
Vue.component(
    'content.accounts.modals.create',
    require('./components/content/accounts/modals/create.vue')
);
Vue.component(
    'content.accounts.modals.delete',
    require('./components/content/accounts/modals/delete.vue')
);
Vue.component(
    'content.accounts.modals.edit',
    require('./components/content/accounts/modals/edit.vue')
);

// Categories
Vue.component(
    'content.categories',
    require('./components/content/categories/page.vue')
);
Vue.component(
    'content.categories.search',
    require('./components/content/categories/search.vue')
);
Vue.component(
    'content.categories.table',
    require('./components/content/categories/table.vue')
);
Vue.component(
    'content.categories.modals.create',
    require('./components/content/categories/modals/create.vue')
);
Vue.component(
    'content.categories.modals.delete',
    require('./components/content/categories/modals/delete.vue')
);
Vue.component(
    'content.categories.modals.edit',
    require('./components/content/categories/modals/edit.vue')
);


const app = new Vue({
    el: '#app'
});
