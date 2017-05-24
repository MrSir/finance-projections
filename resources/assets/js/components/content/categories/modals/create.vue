<template lang="pug">
  #create-category-modal.modal
    .modal-dialog
      .modal-content
        .modal-header
          button.close(type='button', data-dismiss='modal', aria-label='Close')
            span(aria-hidden='true') ×
          h4.modal-title Create Category
        .modal-body
          form#storeCategoryForm(name='storeCategoryForm', role='form')
            .box-body
              .form-group
                label(for='name') Name
                input#name.form-control(type='text', name='name', placeholder='Name', v-model='category.name')
              .form-group
                label(for='description') Description
                input#description.form-control(type='text', name='description', placeholder='Description', v-model='category.description')
        .modal-footer
          button.btn.btn-danger.pull-left(type='button', data-dismiss='modal') Close
          button.btn.btn-success(type='button', v-on:click='storeCategory') Create
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
              this.$parent.$parent.categories.push(successResponse.body.results);
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
