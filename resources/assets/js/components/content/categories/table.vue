<template>
    <div id="categoriesTableTemplate">
        <div class="box-body">
            <span v-if="loading" class="fa fa-refresh fa-spin"></span>
            <table v-if="!loading" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="$parent.categories.length > 0" v-for="category in $parent.categories">
                    <td>{{ category.name }}</td>
                    <td>{{ category.description }}</td>
                    <td>{{ category.created_at }}</td>
                    <td class="center">
                        <span class="glyphicon glyphicon-edit action-icon" v-on:click="editCategory(category)"></span>

                        <span class="glyphicon glyphicon-remove action-icon" v-on:click="deleteCategory(category)"></span>

                    </td>
                </tr>
                <tr v-if="$parent.categories.length == 0">
                    <td colspan="4">There are no Categories in the system.</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <button class="btn btn-success" v-if="!loading" data-toggle="modal" data-target="#create-category-modal">
                Create Category
            </button>
            <modals.create></modals.create>
            <modals.edit></modals.edit>
            <modals.delete></modals.delete>
        </div>
    </div>
</template>

<script>
    // import the modals
    import ModalsCreate from './modals/create.vue';
    import ModalsDelete from './modals/delete.vue';
    import ModalsEdit from './modals/edit.vue';

    // the main code
    export default {
        data() {
            return {
                loading: false,
                editingCategory: {
                    id: 0,
                    name: '',
                    description: ''
                },
                deletingCategory: {}
            };
        },
        methods: {
            editCategory: function (category) {
                this.editingCategory = category;
                $('#edit-category-modal').modal('show');
            },
            deleteCategory: function (category) {
                this.deletingCategory = category;
                $('#delete-category-modal').modal('show');
            }
        },
        components: {
            'modals.create': ModalsCreate,
            'modals.delete': ModalsDelete,
            'modals.edit': ModalsEdit
        }
    }
</script>
