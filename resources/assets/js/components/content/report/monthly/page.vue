<template lang="pug">
  #monthlyReportPageTemplate
    span.fa.fa-refresh.fa-spin(v-if='loading')
    .box(v-for='period in periods')
      .box-header.with-border
        h3.box-title Period {{ period.startDate.date }} - {{ period.endDate.date }}
      report-monthly-table(:transactions='period.transactions', :summaryAmount='period.summaryAmount', :changeAmount='period.changeAmount')
</template>

<script>
  // import the modals
  import Table from './table.vue';

  // the main code
  export default {
    mounted() {
      // load the accounts
      this.$http.get('http://local.finance-projections.com/api/account')
        .then(
          function (successResponse) {
            this.accounts = successResponse.body.results;
          },
          function (failedResponse) {
            console.log(failedResponse);
          }
        );

      // load the categories
      this.$http.get('http://local.finance-projections.com/api/category')
        .then(
          function (successResponse) {
            this.categories = successResponse.body.results;
          },
          function (failedResponse) {
            console.log(failedResponse);
          }
        );

      // load the frequencies
      this.$http.get('http://local.finance-projections.com/api/transaction/frequency')
        .then(
          function (successResponse) {
            this.frequencies = successResponse.body.results;
          },
          function (failedResponse) {
            console.log(failedResponse);
          }
        );

      // load the periods
      this.$http.get('http://local.finance-projections.com/api/report/monthly')
        .then(
          function (successResponse) {
            this.loading = false;
            this.periods = successResponse.body;
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
        accounts: [],
        categories: [],
        frequencies: [],
        periods: []
      };
    },
    components: {
      'report-monthly-table': Table
    }
  }
</script>
