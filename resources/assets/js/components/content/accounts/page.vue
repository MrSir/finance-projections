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
  import Search from './search.vue';
  import Table from './table.vue';

  // the main code
  export default {
    mounted() {
      this.$http.get('http://local.finance-projections.com/api/account')
        .then(
          function (successResponse) {
            this.loading = false;
            this.accounts = successResponse.body.results;
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
        accounts: []
      };
    },
    components: {
      'search': Search,
      'accounts-table': Table
    }
  }
</script>
