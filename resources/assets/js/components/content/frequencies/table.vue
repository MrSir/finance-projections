<template lang="pug">
  #frequenciesTableTemplate
    .box-body
      span.fa.fa-refresh.fa-spin(v-if='loading')
      table.table.table-bordered.table-striped(v-if='!loading')
        thead
          tr
            th Name
            th Description
            th Created At
            th Actions
        tbody
          tr(v-if='$parent.frequencies.length > 0', v-for='frequency in $parent.frequencies')
            td {{ frequency.name }}
            td {{ frequency.description }}
            td {{ frequency.created_at }}
            td.center
              span.glyphicon.glyphicon-edit.action-icon(v-on:click='editFrequency(frequency)')
              span.glyphicon.glyphicon-remove.action-icon(v-on:click='deleteFrequency(frequency)')
          tr(v-if='$parent.frequencies.length == 0')
            td(colspan='4') There are no Frequencies in the system.
    .box-footer
      button.btn.btn-success(v-if='!loading', data-toggle='modal', data-target='#create-frequency-modal')
        | Create Frequency
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
        editingFrequency: {
          id: 0,
          name: '',
          description: ''
        },
        deletingFrequency: {}
      };
    },
    methods: {
      editFrequency: function (frequency) {
        this.editingFrequency = frequency;
        $('#edit-frequency-modal').modal('show');
      },
      deleteFrequency: function (frequency) {
        this.deletingFrequency = frequency;
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
