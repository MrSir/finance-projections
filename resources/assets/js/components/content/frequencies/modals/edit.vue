<template lang="pug">
  #edit-frequency-modal.modal
    .modal-dialog
      .modal-content
        .modal-header
          button.close(type='button', data-dismiss='modal', aria-label='Close')
            span(aria-hidden='true') ×
          h4.modal-title Edit Category
        .modal-body
          form#edit-frequency-form(name='editCategoryForm', role='form')
            .box-body
              .form-group
                label(for='name') Name
                input#name.form-control(type='text', name='name', placeholder='Name', v-model='$parent.editingCategory.name')
              .form-group
                label(for='description') Description
                input#description.form-control(type='text', name='description', placeholder='Description', v-model='$parent.editingCategory.description')
        .modal-footer
          button.btn.btn-danger.pull-left(type='button', data-dismiss='modal') Close
          button.btn.btn-success(type='button', v-on:click='updateCategory') Save
</template>

<script>
  export default {
    methods: {
      updateCategory: function () {
        this.$http.put(
            'http://local.finance-projections.com/api/transaction/frequency/' + this.$parent.editingCategory.id,
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
