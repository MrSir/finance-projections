
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

const app = new Vue({
    el: '#app'
});
