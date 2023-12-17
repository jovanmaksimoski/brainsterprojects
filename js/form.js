// FORM VALIDATION

const inputs = document.querySelectorAll("input");

const nameInput = document.querySelector("#name");
const companyName = document.querySelector("#companyName");
const email = document.querySelector("#email");
const phone = document.querySelector("#phoneNumber");
const selectMenu = document.querySelector(".select-selected");

const form = document.querySelector("form");

const nameError = document.querySelector(".error.name");
const companyError = document.querySelector(".error.companyName");
const emailError = document.querySelector(".error.email");
const phoneError = document.querySelector(".error.phoneNumber");

const patterns = {
  email:
    /^([a-zA-Z\d\.\-\_]+)@([a-zA-Z\d-]+)\.([a-zA-Z]{2,8})(\.[a-zA-Z]{2,8})?$/,
  phone: /^\+389([\d]{8,9})$/,
  fullname: /^([a-zA-Z\s]+)$/,
  companyName: /^([a-zA-Z\d\.\-\_\s]+)$/,
};

form.addEventListener("submit", (e) => {
  if (
    nameInput.value === "" ||
    nameInput.value == null ||
    patterns["fullname"].test(nameInput.value) == false
  ) {
    nameError.classList.add("show");
    nameInput.style.outline = "2px solid red";
    e.preventDefault();
  } else {
    nameInput.style.outline = "2px solid limegreen";
    nameError.classList.remove("show");
  }
  if (
    companyName.value === "" ||
    companyName.value == null ||
    patterns["companyName"].test(companyName.value) == false
  ) {
    companyError.classList.add("show");
    companyName.style.outline = "2px solid red";
    e.preventDefault();
  } else {
    companyName.style.outline = "2px solid limegreen";
    companyError.classList.remove("show");
  }

  if (
    email.value === "" ||
    email.value == null ||
    patterns["email"].test(email.value) == false
  ) {
    emailError.classList.add("show");
    email.style.outline = "2px solid red";
    e.preventDefault();
  } else {
    email.style.outline = "2px solid limegreen";
    emailError.classList.remove("show");
  }
  // PHONE VALIDATION phone number must start with +389 and it may have additional8or 9 digits (+38972321268 )
  if (
    phone.value === "" ||
    phone.value == null ||
    patterns["phone"].test(phone.value) == false
  ) {
    phoneError.classList.add("show");
    phone.style.outline = "2px solid red";
    e.preventDefault();
  } else {
    phone.style.outline = "2px solid limegreen";
    phoneError.classList.remove("show");
  }

  // SELECT MENU VALIDATION
  if (selectMenu.innerHTML == "Изберете тип на студент") {
    selectMenu.style.outline = "2px solid red";
    e.preventDefault();
  } else if (selectMenu.innerHTML !== "Изберете тип на студент") {
    selectMenu.style.outline = "2px solid limegreen";
  }
});

inputs.forEach((input) => {
  input.addEventListener("keyup", (e) => {
    validate(e.target, patterns[e.target.attributes.name.value]);
  });
});

function validate(field, regex) {
  if (regex.test(field.value)) {
    field.style.outline = "2px solid limegreen";
  } else {
    field.style.outline = "2px solid red ";
  }
}
