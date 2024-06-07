const APP_URL = "http://localhost/wings/public";

let Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 5000,
});

// formatting value to indonesian currency
// ex rupiahIndonesia.format(100000)
// output : Rp 100.000,00
const rupiahIndonesia = new Intl.NumberFormat("id-ID", {
  style: "currency",
  currency: "IDR",
});

function formatRupiah(input) {
  // Menghapus karakter yang bukan angka
  let angka = input.value.replace(/\D/g, "");

  // Mengformat angka menjadi format rupiah
  let formattedRupiah = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

  // Menambahkan simbol Rupiah
  input.value = formattedRupiah;
}

let detailOrders = [];
$(document).on("click", ".btn-buy", function () {
  const code = $(this).data("code");
  $.ajax({
    url: `${APP_URL}/product/addProductToTemporaryOrder/${code}`,
    type: "GET",
    contentType: "application/json",
    success: (data) => {
      $(this).addClass("d-none").siblings(".btn-remove").removeClass("d-none");
      detailOrders = data;
    },
  });
});

$(document).on("click", ".btn-remove", function () {
  const code = $(this).data("code");
  $.ajax({
    url: `${APP_URL}/product/removeProductFromTemporaryOrder/${code}`,
    type: "GET",
    contentType: "application/json",
    success: (data) => {
      $(this).addClass("d-none").siblings(".btn-buy").removeClass("d-none");
      detailOrders = data;
    },
  });
});

$(document).on("change", 'input[name="quantities[]"]', function () {
  const qty = Number($(this).val());
  const price = Number($(this).siblings('input[name="prices[]"]').val());
  let subtotal = Number(qty * price);
  $(this).siblings('input[name="subtotals[]"]').val(subtotal);
  $(this)
    .parent()
    .next("p")
    .text(`Subtotal : ${rupiahIndonesia.format(subtotal)}`);

  let total = 0;

  $('input[name="subtotals[]"]').each(function () {
    let value = parseFloat($(this).val()) || 0;
    total += value;
  });

  $('input[name="total"]').val(total);
  $('input[name="total"]')
    .siblings("h6")
    .text(`TOTAL : ${rupiahIndonesia.format(total)}`);
});

$(document).on("blur", 'input[name="quantities[]"]', function () {
  const qty = Number($(this).val());
  const price = Number($(this).siblings('input[name="prices[]"]').val());
  let subtotal = Number(qty * price);
  $(this).siblings('input[name="subtotals[]"]').val(subtotal);
  $(this)
    .parent()
    .next("p")
    .text(`Subtotal : ${rupiahIndonesia.format(subtotal)}`);

  let total = 0;

  $('input[name="subtotals[]"]').each(function () {
    let value = parseFloat($(this).val()) || 0;
    total += value;
  });

  $('input[name="total"]').val(total);
  $('input[name="total"]')
    .siblings("h6")
    .text(`TOTAL : ${rupiahIndonesia.format(total)}`);
});
