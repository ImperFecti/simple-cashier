/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

document.addEventListener("DOMContentLoaded", function () {
  function updateTotal(element) {
    const produkSelect = element.querySelector(".produk");
    const jumlahInput = element.querySelector(".jumlah");
    const totalInput = element.querySelector(".total");

    const harga = parseInt(produkSelect.selectedOptions[0].dataset.harga);
    const jumlah = parseInt(jumlahInput.value);
    totalInput.value =
      "Rp" + new Intl.NumberFormat("id-ID").format(harga * jumlah);
  }

  function addProduct() {
    const produkContainer = document.getElementById("produkContainer");
    const newProduct = document.querySelector(".produk-item").cloneNode(true);

    // Clear the values in the cloned node
    newProduct.querySelector(".produk").value = "";
    newProduct.querySelector(".jumlah").value = "1";
    newProduct.querySelector(".total").value = "";

    produkContainer.appendChild(newProduct);

    // Add event listeners for the new product item
    newProduct.querySelector(".produk").addEventListener("change", function () {
      updateTotal(newProduct);
    });
    newProduct.querySelector(".jumlah").addEventListener("input", function () {
      updateTotal(newProduct);
    });

    // Handle the remove button
    newProduct
      .querySelector(".remove-produk")
      .addEventListener("click", function () {
        newProduct.remove();
      });
  }

  // Initialize the first product total calculation
  updateTotal(document.querySelector(".produk-item"));

  // Add product button functionality
  document
    .getElementById("addProductBtn")
    .addEventListener("click", addProduct);

  // Update total on change
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

  // Handle the remove button on the first product (if needed)
  document.querySelectorAll(".remove-produk").forEach(function (button) {
    button.addEventListener("click", function () {
      button.closest(".produk-item").remove();
    });
  });
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
