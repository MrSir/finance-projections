<template>
    <div id="frequenciesPageTemplate">
        <search></search>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Frequencies</h3>
            </div>
            <frequencies-table></frequencies-table>
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
            this.$http.get('http://local-finance-projections.com/api/frequency')
                .then(
                    function (successResponse) {
                        this.loading = false;
                        this.frequencies = successResponse.body.frequencies;
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
