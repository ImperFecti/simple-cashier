// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Ambil data dari elemen script di view
const pendapatanBulananData = JSON.parse(
  document.getElementById("pendapatanBulananData").textContent
);

// Siapkan data bulanan untuk grafik
const bulanLabels = [
  "Januari",
  "Februari",
  "Maret",
  "April",
  "Mei",
  "Juni",
  "Juli",
  "Agustus",
  "September",
  "Oktober",
  "November",
  "Desember",
];
const pendapatanBulanan = new Array(12).fill(0);

// Masukkan data pendapatan ke array berdasarkan bulan
pendapatanBulananData.forEach((data) => {
  pendapatanBulanan[data.bulan - 1] = parseFloat(data.total);
});

// Membuat bar chart
var ctx = document.getElementById("myPendapatanChart").getContext("2d");
var myPendapatanChart = new Chart(ctx, {
  type: "line",
  data: {
    labels: bulanLabels,
    datasets: [
      {
        label: "Total Pendapatan",
        backgroundColor: "rgba(2,117,216,0.2)",
        borderColor: "rgba(2,117,216,1)",
        data: pendapatanBulanan,
      },
    ],
  },
  options: {
    scales: {
      x: {
        time: {
          unit: "month",
        },
        grid: {
          display: false,
        },
        ticks: {
          maxTicksLimit: 12,
        },
      },
      y: {
        ticks: {
          min: 0,
          maxTicksLimit: 5,
        },
        grid: {
          color: "rgba(0, 0, 0, .125)",
        },
      },
    },
    plugins: {
      legend: {
        display: false,
      },
    },
  },
});
