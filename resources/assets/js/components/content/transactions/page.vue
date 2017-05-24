<template lang="pug">
  #transactionsPageTemplate
    search
    .box
      .box-header.with-border
        h3.box-title Transactions
      transactions-table
</template>

<script>
  // import the modals
  import Search from './search.vue';
  import Table from './table.vue';

  // the main code
  export default {
    mounted() {
      this.$http.get('http://local-finance-projections.com/api/transaction')
        .then(
          function (successResponse) {
            this.loading = false;
            this.transactions = successResponse.body.transactions;
          },
          function (failedResponse) {
            console.log(failedResponse);
          }
        );
    },
    beforeMount() {
      this.loading = true;
    },
    data() {
      return {
        loading: false,
        transactions: []
      };
    },
    components: {
      'search': Search,
      'transactions-table': Table
    }
  }
</script>
