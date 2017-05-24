<template lang="pug">
  #frequenciesSearchTemplate.box.box-info
    .box-header.with-border
      h3.box-title Search
      .box-tools.pull-right
        button.btn.btn-box-tool(type='button', data-widget='collapse')
          i.fa.fa-minus
        button.btn.btn-box-tool(type='button', data-widget='remove')
          i.fa.fa-times
    .box-body
      span.fa.fa-refresh.fa-spin(v-if='loading')
      #searchForm(v-if='!loading')
        .row
          .form-group.col-lg-4
            label(for='searchName') Name
            input#searchName.form-control(type='text', placeholder='e.g. Savings', v-model='search.name')
          .form-group.col-lg-4
            label(for='searchDescription') Description
            input#searchDescription.form-control(type='text', placeholder='e.g. Place for money', v-model='search.description')
          .form-group.col-lg-2
            label Created From:
            input#searchCreatedFrom.form-control.pull-right(type='date', v-model='search.createdFrom')
          .form-group.col-lg-2
            label Created To:
            input#searchCreatedTo.form-control.pull-right(type='date', v-model='search.createdTo')
    .box-footer
      button.btn.btn-primary(type='button', v-on:click='searchFrequencies') Search
      button.btn.btn-info(type='button', v-on:click='resetSearchFrequencies') Reset
</template>

<script>
  // the main code
  export default {
    mounted() {
      this.loading = false;
    },
    beforeMount() {
      this.loading = true;
    },
    data() {
      return {
        loading: false,
        search: {}
      };
    },
    methods: {
      searchFrequencies: function () {
        this.$http.get(
          'http://local-finance-projections.com/api/frequency',
          {
            params: this.search
          }
          )
          .then(
            function (successResponse) {
              this.$parent.frequencies = successResponse.body.frequencies;
            },
            function (failedResponse) {
              console.log(failedResponse);
            }
          );
      },
      resetSearchFrequencies: function () {
        this.search = {};

        this.searchFrequencies();
      }
    }
  }
</script>
