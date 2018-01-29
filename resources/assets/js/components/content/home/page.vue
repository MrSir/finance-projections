<template lang="pug">
  #homePageTemplate
    .box
      .box-header.with-border
        h3.box-title Transactions
</template>

<script>
  // import the modals
//  import Search from './search.vue';
//  import Table from './table.vue';

  // the main code
  export default {
    data() {
      return {
        loading: false,
        transactions: []
      };
    },
    mounted() {
      this.$http.get('http://local.finance-projections.com/api/transaction')
        .then(
          function (successResponse) {
            this.loading = false;
            this.transactions = successResponse.body.results;
          },
          function (failedResponse) {
            console.log(failedResponse);
          }
        );
    },
    beforeMount() {
      this.loading = true;
    },
    components: {
//      'search': Search,
//      'transactions-table': Table
    }
  }
</script>
