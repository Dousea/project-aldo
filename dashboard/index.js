let monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
let chartLabels = []
let chartData = []

$.get("dashboard/_get_orders.php", (data) => {
  let json = JSON.parse(data)
  json.forEach(value => {
    chartLabels.push(monthNames[value.month-1])
    chartData.push(value.sum)
  })

  let ctx = document.getElementById("myChart")
  new Chart(ctx, {
    type: "line",
    data: {
      labels: chartLabels,
      datasets: [{
        data: chartData,
        lineTension: 0,
        backgroundColor: "transparent",
        borderColor: "#007bff",
        borderWidth: 4,
        pointBackgroundColor: "#007bff"
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })
})