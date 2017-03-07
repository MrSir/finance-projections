<template>
    <div id="transactionsPageTemplate">
        <content.transactions.search></content.transactions.search>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Transactions</h3>
            </div>
            <content.transactions.table></content.transactions.table>
        </div>
    </div>
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
    }
</script>
