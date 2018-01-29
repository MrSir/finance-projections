<template lang="pug">
  #accountsPageTemplate
    search
    .box
      .box-header.with-border
        h3.box-title Accounts
      accounts-table
</template>

<script>
  // import the modals
  import Search from './search.vue'
  import Table from './table.vue'

  // the main code
  export default {
    mounted() {
      this.$http.get('http://local.finance-projections.com/api/account')
        .then(
          function (successResponse) {
            this.loading = false
            this.accounts = successResponse.body.results

            this.accounts.forEach(function (account) {
              const balances = account.account_balances

              account.balance = 0.00
              account.balanceLastUpdated = 'NEVER'

              if (balances.length > 0) {
                account.balance = parseFloat(Math.round(balances[0].balance * 100) / 100).toFixed(2)
                account.balanceLastUpdated = balances[0].posted_at
              }
            })
          },
          function (failedResponse) {
            console.log(failedResponse)
          },
        )
    },
    beforeMount() {
      this.loading = true
    },
    data() {
      return {
        loading: false,
        accounts: [],
      }
    },
    components: {
      'search': Search,
      'accounts-table': Table,
    },
  }
</script>
