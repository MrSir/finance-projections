<template lang="pug">
  ul.sidebar-menu
    li(v-bind:class="{ active: active_route == 'Home' }")
      a(href='/')
        i.fa.fa-home
        span Home
    li(v-bind:class="{ active: active_route == 'Transactions' }")
      a(href='/transactions')
        i.fa.fa-dollar
        span Transactions
    li(v-bind:class="{ active: active_route == 'Accounts' }")
      a(href='/accounts')
        i.fa.fa-bank
        span Accounts
    li(v-bind:class="{ active: active_route == 'Categories' }")
      a(href='/categories')
        i.fa.fa-filter
        span Categories
    li(v-bind:class="{ active: active_route == 'Frequencies' }")
      a(href='/frequencies')
        i.fa.fa-calendar
        span Frequencies
    li.treeview(v-bind:class="{ active: active_route == 'Monthly Report' }")
      a(href='#')
        i.fa.fa-link
        span Reports
        span.pull-right-container
          i.fa.fa-angle-left.pull-right
      ul.treeview-menu
        li(v-bind:class="{ active: active_route == 'Monthly Report' }")
          a(href='/report/monthly')
            i.fa.fa-calendar
            span Monthly Report
        li
          a(href='#') Report 2
</template>

<script>
  export default {
    mounted() {

    },
    props: ['active_route']
  }
</script>
