<template>
    <div id="delete-frequency-modal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Category</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Category.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" v-on:click="destroyCategory">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            destroyCategory: function () {
                this.$http.delete(
                    'http://local-finance-projections.com/api/frequency/' + this.$parent.deletingCategory.id
                )
                    .then(
                        function (successResponse) {
                            this.$parent.$parent.frequencies = this.$parent.$parent.frequencies.filter(
                                frequency => frequency.id !== this.$parent.deletingCategory.id
                            );

                            $('#delete-frequency-modal').modal('hide');
                        },
                        function (failedResponse) {
                            console.log(failedResponse);
                        }
                    );
            }
        }
    }
</script>
