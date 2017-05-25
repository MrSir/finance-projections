<template lang="pug">
  #categoriesPageTemplate
    search
    .box
      .box-header.with-border
        h3.box-title Categories
      categories-table
</template>

<script>
  // import the modals
  import Search from './search.vue';
  import Table from './table.vue';

  // the main code
  export default {
    mounted() {
      this.$http.get('http://local-finance-projections.com/api/category')
        .then(
          function (successResponse) {
            this.loading = false;
            this.categories = successResponse.body.results;
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
        categories: []
      };
    },
    components: {
      'search': Search,
      'categories-table': Table
    }
  }
</script>
