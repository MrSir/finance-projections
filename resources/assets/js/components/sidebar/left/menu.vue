<template lang="pug">
  ul.sidebar-menu
    li(v-bind:class="{ active: active_route == 'home' }")
      a(href='/')
        i.fa.fa-home
        span Home
    li(v-bind:class="{ active: active_route == 'transactions' }")
      a(href='/transactions')
        i.fa.fa-dollar
        span Transactions
    li(v-bind:class="{ active: active_route == 'accounts' }")
      a(href='/accounts')
        i.fa.fa-bank
        span Accounts
    li(v-bind:class="{ active: active_route == 'categories' }")
      a(href='/categories')
        i.fa.fa-filter
        span Categories
    li(v-bind:class="{ active: active_route == 'frequencies' }")
      a(href='/frequencies')
        i.fa.fa-calendar
        span Frequencies
    li.treeview
      a(href='#')
        i.fa.fa-link
        span Reports
        span.pull-right-container
          i.fa.fa-angle-left.pull-right
      ul.treeview-menu
        li
          a(href='#') Report 1
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
