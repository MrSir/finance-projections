<template>
    <div id="transactionsTableTemplate">
        <div class="box-body">
            <span v-if="loading" class="fa fa-refresh fa-spin"></span>
            <table v-if="!loading" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Frequency</th>
                    <th>Amount</th>
                    <th>Occurred At</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="$parent.transactions.length > 0" v-for="transaction in $parent.transactions">
                    <td>{{ transaction.name }}</td>
                    <td>{{ transaction.description }}</td>
                    <td>{{ transaction.category.name }}</td>
                    <td>{{ transaction.frequency.name }}</td>
                    <td v-if="transaction.is_credit" class="danger">{{ transaction.amount }}</td>
                    <td v-if="transaction.is_debit" class="success">{{ transaction.amount }}</td>
                    <td>{{ transaction.occurred_at }}</td>
                    <td>{{ transaction.created_at }}</td>
                    <td class="center">
                        <span class="glyphicon glyphicon-edit action-icon" v-on:click="editTransaction(transaction)"></span>

                        <span class="glyphicon glyphicon-remove action-icon" v-on:click="deleteTransaction(transaction)"></span>

                    </td>
                </tr>
                <tr v-if="$parent.transactions.length == 0">
                    <td colspan="8">There are no Transactions in the system.</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <button class="btn btn-success" v-if="!loading" data-toggle="modal" data-target="#create-transaction-modal">
                Create Transaction
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
                editingTransaction: {
                    id: 0,
                    category: {},
                    frequency: {},
                    is_credit: false,
                    is_debit: false,
                    name: '',
                    description: '',
                    amount: 0,
                    occurred_at: null,
                    repeat_start_at: null,
                    repeat_end_at: null
                },
                deletingTransaction: {}
            };
        },
        methods: {
            editTransaction: function (transaction) {
                this.editingTransaction = transaction;
                $('#edit-transaction-modal').modal('show');
            },
            deleteTransaction: function (transaction) {
                this.deletingTransaction = transaction;
                $('#delete-transaction-modal').modal('show');
            }
        },
        components: {
            'modals.create': ModalsCreate,
            'modals.delete': ModalsDelete,
            'modals.edit': ModalsEdit
        }
    }
</script>
