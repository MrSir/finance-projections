<template>
    <div id="frequenciesTableTemplate">
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
                <tr v-if="$parent.frequencies.length > 0" v-for="frequency in $parent.frequencies">
                    <td>{{ frequency.name }}</td>
                    <td>{{ frequency.description }}</td>
                    <td>{{ frequency.created_at }}</td>
                    <td class="center">
                        <span class="glyphicon glyphicon-edit action-icon" v-on:click="editCategory(frequency)"></span>

                        <span class="glyphicon glyphicon-remove action-icon" v-on:click="deleteCategory(frequency)"></span>

                    </td>
                </tr>
                <tr v-if="$parent.frequencies.length == 0">
                    <td colspan="4">There are no Frequencies in the system.</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <button class="btn btn-success" v-if="!loading" data-toggle="modal" data-target="#create-frequency-modal">
                Create Category
            </button>
            <modals-create></modals-create>
            <modals-edit></modals-edit>
            <modals-delete></modals-delete>
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
            editCategory: function (frequency) {
                this.editingCategory = frequency;
                $('#edit-frequency-modal').modal('show');
            },
            deleteCategory: function (frequency) {
                this.deletingCategory = frequency;
                $('#delete-frequency-modal').modal('show');
            }
        },
        components: {
            'modals-create': ModalsCreate,
            'modals-delete': ModalsDelete,
            'modals-edit': ModalsEdit
        }
    }
</script>
