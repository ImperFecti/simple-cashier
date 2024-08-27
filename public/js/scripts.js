/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

// const popoverTriggerList = document.querySelectorAll(
//   '[data-bs-toggle="popover"]'
// );

// const popoverList = [...popoverTriggerList].map(
//   (popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl)
// );

document.addEventListener("DOMContentLoaded", function () {
  function updateTotal(element) {
    const produkSelect = element.querySelector(".produk");
    const jumlahInput = element.querySelector(".jumlah");
    const totalInput = element.querySelector(".total");
    const totalFormatted = element.querySelector(".total-formatted");

    // Ambil harga dari dataset produk yang dipilih
    const harga = parseInt(produkSelect.selectedOptions[0]?.dataset.harga || 0);
    const jumlah = parseInt(jumlahInput.value || 0);

    const total = harga * jumlah;
    totalInput.value = total; // Simpan nilai numerik

    // Tampilkan format mata uang
    totalFormatted.textContent =
      "Rp " + new Intl.NumberFormat("id-ID").format(total);
  }

  function addProduct() {
    const produkContainer = document.getElementById("produkContainer");
    const newProduct = document.querySelector(".produk-item").cloneNode(true);

    // Reset nilai input di elemen yang di-clone
    newProduct.querySelector(".produk").value = "";
    newProduct.querySelector(".jumlah").value = "1";
    newProduct.querySelector(".total").value = "";
    newProduct.querySelector(".total-formatted").textContent = "";

    produkContainer.appendChild(newProduct);

    // Tambah event listener pada produk baru
    newProduct.querySelector(".produk").addEventListener("change", function () {
      updateTotal(newProduct);
    });

    newProduct.querySelector(".jumlah").addEventListener("input", function () {
      updateTotal(newProduct);
    });

    // Handle tombol hapus produk
    newProduct
      .querySelector(".remove-produk")
      .addEventListener("click", function () {
        newProduct.remove();
      });

    // Inisialisasi total untuk produk baru
    updateTotal(newProduct);
  }

  // Inisialisasi perhitungan total pada produk pertama
  updateTotal(document.querySelector(".produk-item"));

  // Fungsi untuk menambah produk baru
  document
    .getElementById("addProductBtn")
    .addEventListener("click", addProduct);

  // Event listener untuk perubahan produk dan jumlah
  document.querySelectorAll(".produk").forEach(function (select) {
    select.addEventListener("change", function () {
      updateTotal(select.closest(".produk-item"));
    });
  });

  document.querySelectorAll(".jumlah").forEach(function (input) {
    input.addEventListener("input", function () {
      updateTotal(input.closest(".produk-item"));
    });
  });

  // Event listener untuk tombol hapus produk pada produk pertama
  document.querySelectorAll(".remove-produk").forEach(function (button) {
    button.addEventListener("click", function () {
      button.closest(".produk-item").remove();
    });
  });
});

function validateForm() {
  let isValid = true;
  document.querySelectorAll(".produk").forEach(function (select) {
    if (select.value === "") {
      isValid = false;
      alert("Silakan pilih produk!");
    }
  });

  document.querySelectorAll(".jumlah").forEach(function (input) {
    if (input.value === "" || input.value <= 0) {
      isValid = false;
      alert("Jumlah produk harus lebih dari 0!");
    }
  });

  return isValid;
}

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
