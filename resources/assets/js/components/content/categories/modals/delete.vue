<template lang="pug">
  #delete-category-modal.modal
    .modal-dialog
      .modal-content
        .modal-header
          button.close(type='button', data-dismiss='modal', aria-label='Close')
            span(aria-hidden='true') ×
          h4.modal-title Delete Category
        .modal-body
          | Are you sure you want to delete this Category.
        .modal-footer
          button.btn.btn-danger.pull-left(type='button', data-dismiss='modal') Close
          button.btn.btn-success(type='button', v-on:click='destroyCategory') Delete
</template>

<script>
  export default {
    methods: {
      destroyCategory: function () {
        this.$http.delete(
            'http://local-finance-projections.com/api/category/' + this.$parent.deletingCategory.id
          )
          .then(
            function (successResponse) {
              this.$parent.$parent.categories = this.$parent.$parent.categories.filter(
                category => category.id !== this.$parent.deletingCategory.id
              );

              $('#delete-category-modal').modal('hide');
            },
            function (failedResponse) {
              console.log(failedResponse);
            }
          );
      }
    }
  }
</script>
