<template lang="pug">
  #categoriesTableTemplate
    .box-body
      span.fa.fa-refresh.fa-spin(v-if='loading')
      table.table.table-bordered.table-striped(v-if='!loading')
        thead
          tr
            th Name
            th Description
            th Created At
            th.text-center Actions
        tbody
          tr(v-if='$parent.categories.length > 0', v-for='category in $parent.categories')
            td {{ category.name }}
            td {{ category.description }}
            td {{ category.created_at }}
            td.text-center
              span.glyphicon.glyphicon-edit.action-icon(v-on:click='editCategory(category)')
              | &nbsp;
              span.glyphicon.glyphicon-trash.action-icon(v-on:click='deleteCategory(category)')
          tr(v-if='$parent.categories.length == 0')
            td(colspan='4') There are no Categories in the system.
    .box-footer
      button.btn.btn-success(v-if='!loading', data-toggle='modal', data-target='#create-category-modal')
        | Create Category
      modals-create
      modals-edit
      modals-delete

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
      'modals-create': ModalsCreate,
      'modals-delete': ModalsDelete,
      'modals-edit': ModalsEdit
    }
  }
</script>
