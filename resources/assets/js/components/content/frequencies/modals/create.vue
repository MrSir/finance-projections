<template lang="pug">
  #create-frequency-modal.modal
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
                input#name.form-control(type='text', name='name', placeholder='Name', v-model='frequency.name')
              .form-group
                label(for='description') Description
                input#description.form-control(type='text', name='description', placeholder='Description', v-model='frequency.description')
        .modal-footer
          button.btn.btn-danger.pull-left(type='button', data-dismiss='modal') Close
          button.btn.btn-success(type='button', v-on:click='storeCategory') Create
</template>

<script>
  export default {
    methods: {
      storeCategory: function () {
        this.$http.post(
          'http://local.finance-projections.com/api/transaction/frequency',
          this.frequency
          )
          .then(
            function (successResponse) {
              this.$parent.$parent.frequencies.push(successResponse.body.results);
              $('#create-frequency-modal').modal('hide');
            },
            function (failedResponse) {
              console.log(failedResponse);
            }
          );

        this.frequency = {
          name: '',
          description: ''
        };
      }
    },
    data() {
      return {
        frequency: {
          name: '',
          description: ''
        }
      };
    }
  }
</script>
