<template lang="pug">
  .box
    .box-header.with-border
      h3.box-title Projections
    .box-body
      canvas(id="chart", width="400", height="100")
    .box-footer
</template>

<script>
  // the main code
  export default {
    mounted() {
      let dataSets = []
      let labels = []

      this.accounts.forEach(
        (account) => {
          let data = []

          this.periods.forEach(
            function (period) {
              data.push(period.accountSummaries[account.name])
            },
          )

          dataSets.push(
            {
              label: account.name,
              backgroundColor: account.color,
              borderColor: account.color,
              borderWidth: 1,
              fill: false,
              data: data,
            },
          )
        },
      )

      this.periods.forEach(
        (period) => {
          labels.push(this.$parent.formatDate(period.endDate.date))
        },
      )

      let ctx = document.getElementById('chart').getContext('2d')
      let myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: dataSets,
        },
        options: {
          responsive: true,
          title: {
            display: true,
            text: 'Chart.js Line Chart',
          },
          tooltips: {
            mode: 'index',
            intersect: false,
          },
          hover: {
            mode: 'nearest',
            intersect: true,
          },
          scales: {
            xAxes: [
              {
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Month',
                },
              },
            ],
            yAxes: [
              {
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Value',
                },
              },
            ],
          },
        },
      })
    },
    props: [
      'periods',
      'accounts',
    ],
    methods: {
      roundNumbers: function (number) {
        return parseFloat(Math.round(number * 100) / 100).toFixed(2)
      },
      getCategoryName: function (id) {
        const theCategory = this.$parent.categories.find(
          function (category) {
            return category.id === id
          },
        )

        return theCategory.name
      },
      getAccountName: function (id) {
        if (id == null) {
          return 'N/A'
        }

        const theAccount = this.$parent.accounts.find(
          function (account) {
            return account.id === id
          },
        )

        return theAccount.name
      },
      getFrequencyName: function (id) {
        const theFrequency = this.$parent.frequencies.find(
          function (frequency) {
            return frequency.id === id
          },
        )

        return theFrequency.name
      },
    },
  }
</script>
