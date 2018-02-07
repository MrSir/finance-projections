<template lang="pug">
  #weeklyReportPageTemplate
    span.fa.fa-refresh.fa-spin(v-if='loading')
    report-weekly-projections(v-if='periods.length > 0 && accounts.length > 0', :periods='periods', :accounts='accounts')
    .box(v-for='period in periods')
      .box-header.with-border
        h3.box-title Period {{ formatDate(period.startDate.date) }} - {{ formatDate(period.endDate.date) }}
      report-weekly-table(:transactions='period.transactions', :summaryAmount='period.summaryAmount', :changeAmount='period.changeAmount')
</template>

<script>
  // import the components
  import ReportWeeklyTable from './table';
  import ReportWeeklyProjections from './projections'

  // the main code
  export default {
    created() {
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
      this.$http.get('http://local.finance-projections.com/api/report/bi-weekly')
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
    methods: {
      formatDate: function (dateString) {
        return moment(dateString).format('MMMM Do, YYYY');
      }
    },
    components: {
      ReportWeeklyProjections,
      ReportWeeklyTable
    }
  }
</script>
