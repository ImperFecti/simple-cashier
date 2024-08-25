// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Fungsi untuk mendapatkan data stok produk dari elemen data-stok
function getDataStok() {
  const stokData = JSON.parse(
    document.getElementById("stokProdukData").textContent
  );

  // Mengurutkan data berdasarkan nama produk (alfabetis)
  stokData.sort((a, b) => a.nama.localeCompare(b.nama));

  const labels = stokData.map((item) => item.nama);
  const data = stokData.map((item) => item.stok);

  return { labels, data };
}

// Fungsi untuk mendapatkan stok tertinggi
function getMaxStok(data) {
  return Math.max(...data);
}

// Mengambil data stok produk
const stokProduk = getDataStok();

// Area Chart Example
var ctx = document.getElementById("myStokChart");
var myStokChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: stokProduk.labels,
    datasets: [
      {
        label: "Stok Produk",
        lineTension: 0.3,
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(2,117,216,1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(2,117,216,1)",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: stokProduk.data,
      },
    ],
  },
  options: {
    scales: {
      xAxes: [
        {
          gridLines: {
            display: false,
          },
          ticks: {
            maxTicksLimit: stokProduk.labels.length, // Sesuaikan dengan jumlah produk
          },
        },
      ],
      yAxes: [
        {
          ticks: {
            min: 0,
            max: getMaxStok(stokProduk.data),
            maxTicksLimit: 5,
          },
          gridLines: {
            color: "rgba(0, 0, 0, .125)",
          },
        },
      ],
    },
    legend: {
      display: false,
    },
  },
});
