<template>
    <div id="edit-frequency-modal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-frequency-form" name="editCategoryForm" role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                       v-model="$parent.editingCategory.name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       placeholder="Description" v-model="$parent.editingCategory.description">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" v-on:click="updateCategory">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            updateCategory: function () {
                this.$http.put(
                    'http://local-finance-projections.com/api/frequency/' + this.$parent.editingCategory.id,
                    this.$parent.editingCategory
                )
                    .then(
                        function (successResponse) {
                            $('#edit-frequency-modal').modal('hide');
                        },
                        function (failedResponse) {
                            console.log(failedResponse);
                        }
                    );
            }
        }
    }
</script>
