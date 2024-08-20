/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

document.addEventListener("DOMContentLoaded", function () {
  const produkSelect = document.getElementById("produk");
  const jumlahInput = document.getElementById("jumlah");
  const totalInput = document.getElementById("total");

  function updateTotal() {
    const harga = parseInt(produkSelect.selectedOptions[0].dataset.harga);
    const jumlah = parseInt(jumlahInput.value);
    totalInput.value =
      "Rp" + new Intl.NumberFormat("id-ID").format(harga * jumlah);
  }

  produkSelect.addEventListener("change", updateTotal);
  jumlahInput.addEventListener("input", updateTotal);

  // Inisialisasi hitungan pertama kali
  updateTotal();
});

window.addEventListener("DOMContentLoaded", (event) => {
  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector("#sidebarToggle");
  if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener("click", (event) => {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      localStorage.setItem(
        "sb|sidebar-toggle",
        document.body.classList.contains("sb-sidenav-toggled")
      );
    });
  }
});
