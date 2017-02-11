<template>
    <div id="create-account-modal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create Account</h4>
                </div>
                <div class="modal-body">
                    <form id="storeAccountForm" name="storeAccountForm" role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                       v-model="account.name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       placeholder="Description" v-model="account.description">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" v-on:click="storeAccount">Create</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            storeAccount: function () {
                this.$http.post(
                    'http://local-finance-projections.com/api/account',
                    this.account
                )
                    .then(
                        function (successResponse) {
                            this.$parent.accounts.push(successResponse.body.account);
                            $('#create-account-modal').modal('hide');
                        },
                        function (failedResponse) {
                            console.log(failedResponse);
                        }
                    );
            }
        },
        data() {
            return {
                account: {
                    name: '',
                    description: ''
                }
            };
        }

    }
</script>
