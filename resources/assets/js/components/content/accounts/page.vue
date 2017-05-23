<template>
    <div id="accountsPageTemplate">
        <search></search>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Accountss</h3>
            </div>
            <accounts-table></accounts-table>
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
            this.$http.get('http://local-finance-projections.com/api/account')
                .then(
                    function (successResponse) {
                        this.loading = false;
                        this.accounts = successResponse.body.accounts;
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
