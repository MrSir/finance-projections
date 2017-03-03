<template>
    <div id="create-category-modal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create Category</h4>
                </div>
                <div class="modal-body">
                    <form id="storeCategoryForm" name="storeCategoryForm" role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                       v-model="category.name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       placeholder="Description" v-model="category.description">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" v-on:click="storeCategory">Create</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            storeCategory: function () {
                this.$http.post(
                    'http://local-finance-projections.com/api/category',
                    this.category
                )
                    .then(
                        function (successResponse) {
                            this.$parent.$parent.categories.push(successResponse.body.category);
                            $('#create-category-modal').modal('hide');
                        },
                        function (failedResponse) {
                            console.log(failedResponse);
                        }
                    );

                this.category = {
                    name: '',
                    description: ''
                };
            }
        },
        data() {
            return {
                category: {
                    name: '',
                    description: ''
                }
            };
        }
    }
</script>
