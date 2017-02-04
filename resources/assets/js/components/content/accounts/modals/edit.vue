<template>
    <div id="edit-account-modal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Account</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-account-form" name="editAccountForm" role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                       v-model="$parent.editingAccount.name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       placeholder="Description" v-model="$parent.editingAccount.description">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" v-on:click="updateAccount">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            updateAccount: function () {
                this.$http.put(
                    'http://local-finance-projections.com/api/account/' + this.$parent.editingAccount.id,
                    this.$parent.editingAccount
                )
                    .then(
                        function (successResponse) {
                            $('#edit-account-modal').modal('hide');
                        },
                        function (failedResponse) {
                            console.log(failedResponse);
                        }
                    );
            }
        }
    }
</script>
