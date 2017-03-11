<template>
    <div id="categoriesPageTemplate">
        <search></search>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Categories</h3>
            </div>
            <categories-table></categories-table>
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
            this.$http.get('http://local-finance-projections.com/api/category')
                .then(
                    function (successResponse) {
                        this.loading = false;
                        this.categories = successResponse.body.categories;
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
