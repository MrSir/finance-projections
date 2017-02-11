<template>
    <div id="accountsSearchTemplate" class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Search</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <span v-if="loading" class="fa fa-refresh fa-spin"></span>
            <div v-if="!loading" id="searchForm">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="searchName">Name</label>
                        <input type="text" class="form-control" id="searchName" placeholder="e.g. Savings"
                               v-model="search.name">
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="searchDescription">Description</label>
                        <input type="text" class="form-control" id="searchDescription"
                               placeholder="e.g. Place for money"
                               v-model="search.description">
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Created From:</label>
                        <input type="date" class="form-control pull-right " id="searchCreatedFrom"
                               v-model="search.createdFrom">
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Created To:</label>
                        <input type="date" class="form-control pull-right" id="searchCreatedTo"
                               v-model="search.createdTo">
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-info" v-on:click="searchAccounts">Search</button>
        </div>
    </div>
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
                    'http://local-finance-projections.com/api/account',
                    {
                        params: this.search
                    }
                )
                    .then(
                        function (successResponse) {
                            console.log(successResponse.body.accounts);
                        },
                        function (failedResponse) {
                            console.log(failedResponse);
                        }
                    );
            }
        }
    }
</script>
