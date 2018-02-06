<template lang="pug">
  #reportMonthlyTableTemplate
    .box-body
      table.table.table-bordered.table-striped
        thead
          tr
            th Name
            th Description
            th Category
            th Account
            th Destination Account
            th Frequency
            th.text-right Amount
            th Occurred At
            th Created At
        tbody
          tr(v-if='transactions', v-for='transaction in transactions')
            td {{ transaction.name }}
            td {{ transaction.description }}
            td {{ getCategoryName(transaction.category_id) }}
            td {{ getAccountName(transaction.account_id) }}
            td {{ getAccountName(transaction.destination_account_id) }}
            td {{ getFrequencyName(transaction.transaction_frequency_id) }}
            td.text-right.danger(v-if='transaction.amount < 0') ${{ roundNumbers(transaction.amount) }}
            td.text-right.success(v-if='transaction.amount >= 0') ${{ roundNumbers(transaction.amount) }}
            td {{ $parent.formatDate(transaction.occurred_at) }}
            td {{ $parent.formatDate(transaction.created_at) }}
          tr.text-bold.success
            td.text-right(colspan="5") Total Accounts Summary
            td.text-right
              span.fa.fa-arrow-up
              | {{ changeAmount }}
            td.text-right {{ summaryAmount }}
            td(colspan="2")
    .box-footer
</template>

<script>
  // the main code
  export default {
    props: [
      'transactions',
      'changeAmount',
      'summaryAmount'
    ],
    methods: {
      roundNumbers: function(number) {
        return parseFloat(Math.round(number * 100) / 100).toFixed(2);
      },
      getCategoryName: function(id) {
        const theCategory = this.$parent.categories.find(
          function (category) {
            return category.id === id;
          }
        );

        return theCategory.name;
      },
      getAccountName: function(id) {
        if (id == null) {
          return 'N/A';
        }

        const theAccount = this.$parent.accounts.find(
          function (account) {
            return account.id === id;
          }
        );

        return theAccount.name;
      },
      getFrequencyName: function(id) {
        const theFrequency = this.$parent.frequencies.find(
          function (frequency) {
            return frequency.id === id;
          }
        );

        return theFrequency.name;
      }
    }
  }
</script>
