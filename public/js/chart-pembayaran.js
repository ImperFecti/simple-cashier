// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Pie Chart Example
document.addEventListener("DOMContentLoaded", function () {
  // Data Metode Pembayaran dari server
  const metodePembayaranData = JSON.parse(
    document.getElementById("metodePembayaranData").textContent
  );

  // Label dan Data Chart Pie
  const labels = metodePembayaranData.map((item) => item.nama_pembayaran);
  const data = metodePembayaranData.map((item) => item.jumlah);

  const ctx = document.getElementById("myPembayaranChart").getContext("2d");
  const myPembayaranChart = new Chart(ctx, {
    type: "pie",
    data: {
      labels: labels,
      datasets: [
        {
          data: data,
          backgroundColor: [
            "#FF6384",
            "#36A2EB",
            "#FFCE56",
            "#4BC0C0",
            "#9966FF",
          ],
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: "top",
        },
        tooltip: {
          callbacks: {
            label: function (tooltipItem) {
              return tooltipItem.label + ": " + tooltipItem.raw + " transaksi";
            },
          },
        },
      },
    },
  });
});
