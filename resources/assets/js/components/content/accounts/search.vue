<template lang="pug">
  #accountsSearchTemplate.box.box-info.collapsed-box
    .box-header.with-border
      h3.box-title Search
      .box-tools.pull-right
        button.btn.btn-box-tool(type='button', data-widget='collapse')
          i.fa.fa-plus
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
      button.btn.btn-primary(type='button', v-on:click='searchAccounts') Search
      button.btn.btn-info(type='button', v-on:click='resetSearchAccounts') Reset
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
      searchAccounts: function () {
        this.$http.get(
          'http://local.finance-projections.com/api/account',
          {
            params: this.search
          }
          )
          .then(
            function (successResponse) {
              this.$parent.accounts = successResponse.body.results;
            },
            function (failedResponse) {
              console.log(failedResponse);
            }
          );
      },
      resetSearchAccounts: function () {
        this.search = {};

        this.searchAccounts();
      }
    }
  }
</script>
