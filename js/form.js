// CUSTOM SELECT BOX
var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function (e) {
      /* When an item is clicked, update the original select box,
        and the selected item: */
      var y, i, k, s, h, sl, yl;
      s = this.parentNode.parentNode.getElementsByTagName("select")[0];
      sl = s.length;
      h = this.parentNode.previousSibling;
      for (i = 0; i < sl; i++) {
        if (s.options[i].innerHTML == this.innerHTML) {
          s.selectedIndex = i;
          h.innerHTML = this.innerHTML;
          y = this.parentNode.getElementsByClassName("same-as-selected");
          yl = y.length;
          for (k = 0; k < yl; k++) {
            y[k].removeAttribute("class");
          }
          this.setAttribute("class", "same-as-selected");
          break;
        }
      }
      h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function (e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x,
    y,
    i,
    xl,
    yl,
    arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i);
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);

// FORM VALIDATION

// ALL INPUTS
const inputs = document.querySelectorAll("input");
// INPUTS BY THEIR ID
const nameInput = document.querySelector("#name");
const companyName = document.querySelector("#companyName");
const email = document.querySelector("#email");
const phone = document.querySelector("#phoneNumber");
const selectMenu = document.querySelector(".select-selected");
// FORM
const form = document.querySelector("form");
// ERROR MESSAGES
const nameError = document.querySelector(".error.name");
const companyError = document.querySelector(".error.companyName");
const emailError = document.querySelector(".error.email");
const phoneError = document.querySelector(".error.phoneNumber");
// REGEX PATTERNS
const patterns = {
  email:
    /^([a-zA-Z\d\.\-\_]+)@([a-zA-Z\d-]+)\.([a-zA-Z]{2,8})(\.[a-zA-Z]{2,8})?$/,
  phone: /^\+389([\d]{8,9})$/,
  fullname: /^([a-zA-Z\s]+)$/,
  companyName: /^([a-zA-Z\d\.\-\_\s]+)$/,
};

form.addEventListener("submit", (e) => {
  //  NAME VALIDATION  - can include only letters and space
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
  // COMPANY NAME VALIDATION / can include letters numbers and space
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

  // Email  VALIDATION - created simple email validation.  (Regular Expression- RegEx) it must be in name@domain.com or name@domain.com.xx where name can include only letters digits - _ and .
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
