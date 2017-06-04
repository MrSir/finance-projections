<template lang="pug">
  #frequenciesPageTemplate
    search
    .box
      .box-header.with-border
        h3.box-title Frequencies
      frequencies-table
</template>

<script>
  // import the modals
  import Search from './search.vue';
  import Table from './table.vue';

  // the main code
  export default {
    mounted() {
      this.$http.get('http://local.finance-projections.com/api/transaction/frequency')
        .then(
          function (successResponse) {
            this.loading = false;
            this.frequencies = successResponse.body.results;
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
        frequencies: []
      };
    },
    components: {
      'search': Search,
      'frequencies-table': Table
    }
  }
</script>
