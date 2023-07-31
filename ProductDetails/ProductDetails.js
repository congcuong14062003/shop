// Get the modal
const modalBill = document.querySelector(".modal-product");
const inputElement = document.querySelector(".amount");
const inputElementBill = document.querySelector(".bill-amount");
const minusButton = document.querySelector(".btn-minus");
const plusButton = document.querySelector(".btn-plus");
minusButton.addEventListener("click", () => {
  var valueInput = parseInt(inputElement.value);
  if (valueInput > 1) {
    // Sửa lỗi logic
    inputElement.value = valueInput - 1; // Sửa lỗi cú pháp
    document.querySelector(".amount").value = parseInt(inputElement.value);
    inputElementBill.value = document.querySelector(".amount").value;
  }
});

plusButton.addEventListener("click", () => {
  var valueInput = parseInt(inputElement.value);
  inputElement.value = valueInput + 1; // Sửa lỗi cú pháp
  document.querySelector(".amount").value = parseInt(inputElement.value);
  inputElementBill.value = document.querySelector(".amount").value;
});

// Get the button that opens the modal
var btnBuy = document.querySelector(".buy-btn");

// Get the <span> element that closes the modal
var spanClose = document.querySelector(".close");

// When the user clicks on the button, open the modal
btnBuy.onclick = () => {
  console.log(123)
  modalBill.style.display = "block";
  document.querySelector(".bill-total-price").value = (parseInt(inputElementBill.value) * parseInt(priceProduct)).toLocaleString();
};

spanClose.onclick = function () {
  modalBill.style.display = "none";
};
