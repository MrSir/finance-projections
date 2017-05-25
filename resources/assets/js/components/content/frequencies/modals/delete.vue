<template lang="pug">
  #delete-frequency-modal.modal
    .modal-dialog
      .modal-content
        .modal-header
          button.close(type='button', data-dismiss='modal', aria-label='Close')
            span(aria-hidden='true') ×
          h4.modal-title Delete Frequency
        .modal-body
          | Are you sure you want to delete this Frequency.
        .modal-footer
          button.btn.btn-danger.pull-left(type='button', data-dismiss='modal') Close
          button.btn.btn-success(type='button', v-on:click='destroyFrequency') Delete
</template>

<script>
  export default {
    methods: {
      destroyFrequency: function () {
        this.$http.delete(
            'http://local-finance-projections.com/api/transaction/frequency/' + this.$parent.deletingFrequency.id
          )
          .then(
            function (successResponse) {
              this.$parent.$parent.frequencies = this.$parent.$parent.frequencies.filter(
                frequency => frequency.id !== this.$parent.deletingFrequency.id
              );

              $('#delete-frequency-modal').modal('hide');
            },
            function (failedResponse) {
              console.log(failedResponse);
            }
          );
      }
    }
  }
</script>
