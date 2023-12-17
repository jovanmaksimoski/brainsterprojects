const filterCoding = document.querySelector("#codingFilter");
const filterDesign = document.querySelector("#designFilter");
const filterMarketing = document.querySelector("#marketingFilter");
const loadmore = document.querySelector(".loadmore");
const elementList = document.querySelectorAll(".card");
let mediaQuery = window.matchMedia("(max-width: 600px)");

// you can find explanation for this function at the bottom of this page

// adding event listener to coding checkbox(filter)
filterCoding.addEventListener("change", () => {
  if (filterCoding.checked) {
    // if filter(checkbox) for coding is checked first it removes show class from each card then adds show class only to coding cards
    // if ($(".coding:hidden").length === 0) {
    //     $(".loadmore").removeClass("show");
    //   }

    removeShow();
    // then adds show class only to coding cards

    document.querySelectorAll(".coding").forEach((card) => {
      card.classList.add("show");
    });
    // then removes active class from each filter
    removeActive();
    // than adds active class to only coding filter
    document.querySelector(".coding-filter").classList.add("active");
    //  if any of other checkboxes are checked, they are unchecked with below code
    filterMarketing.checked = false;
    filterDesign.checked = false;
    // below jquery code is for pagination when coding filter is selected
    // if code filter is selected, and there are cards not loaded, it adds show class to the loadmore button ( even if its hidden) so users can load more coding cards
    if (mediaQuery.matches) {
      if ($(".coding:hidden").length > 0) {
        $(".loadmore").addClass("show");
      }
      // after showing the button, this code adds event listener to the button, which on click adds mobile class to the next 6 hidden coding cards
      // mobile class is used for pagination. it has display block spec
      $(".loadmore").on("click", function () {
        $(".coding:hidden").slice(0, 6).addClass("mobile");
        //  if there are no hidden coding cards anymore, below code removes the show class from the loadmore button and it becomes hidden
        if ($(".coding:hidden").length == 0) {
          $(".loadmore").removeClass("show");
        }
      });
    }
    // if coding filter is not selected it adds shows all cards and removes the active class from the filter
  } else {
    removeActive();
    addShow();

    if ($(".card:hidden").length > 0) {
      $(".loadmore").addClass("show");
    }
    $(".loadmore").on("click", function () {
      $(".card:hidden").slice(0, 6).addClass("mobile");
      if ($(".card:hidden").length == 0) {
        $(".loadmore").removeClass("show");
      }
    });
  }
});
// same logic repeats for design filter
filterDesign.addEventListener("change", () => {
  if (filterDesign.checked) {
    // if ($(".design:hidden").length === 0) {
    //     $(".loadmore").removeClass("show");
    //   }
    removeShow();

    document.querySelectorAll(".design").forEach((card) => {
      card.classList.add("show");
    });
    removeActive();
    document.querySelector(".design-filter").classList.add("active");

    filterMarketing.checked = false;
    filterCoding.checked = false;
    if (mediaQuery.matches) {
      if ($(".design:hidden").length > 0) {
        $(".loadmore").addClass("show");
      }
      $(".loadmore").on("click", function () {
        $(".design:hidden").slice(0, 6).addClass("mobile");
        if ($(".design:hidden").length == 0) {
          $(".loadmore").removeClass("show");
        }
      });
    }
  } else {
    removeActive();
    addShow();

    if ($(".card:hidden").length > 0) {
      $(".loadmore").addClass("show");
    }
    $(".loadmore").on("click", function () {
      $(".card:hidden").slice(0, 6).addClass("mobile");
      if ($(".card:hidden").length == 0) {
        $(".loadmore").removeClass("show");
      }
    });
  }
});
// same logic repeats for marketing filter
filterMarketing.addEventListener("change", () => {
  if (filterMarketing.checked) {
    // if ($(".marketing:hidden").length === 0) {
    //     $(".loadmore").removeClass("show");
    //   }
    removeShow();

    document.querySelectorAll(".marketing").forEach((card) => {
      card.classList.add("show");
    });
    removeActive();
    document.querySelector(".marketing-filter").classList.add("active");

    filterDesign.checked = false;
    filterCoding.checked = false;
    if (mediaQuery.matches) {
      if ($(".marketing:hidden").length == 0) {
        $(".loadmore").removeClass("show");
      }
      $(".loadmore").on("click", function () {
        $(".marketing:hidden").slice(0, 6).addClass("mobile");
        if ($(".marketing:hidden").length == 0) {
          $(".loadmore").removeClass("show");
        }
      });
    }
  } else {
    removeActive();
    addShow();

    if ($(".card:hidden").length > 0) {
      $(".loadmore").addClass("show");
    }
    $(".loadmore").on("click", function () {
      $(".card:hidden").slice(0, 6).addClass("mobile");
      if ($(".card:hidden").length == 0) {
        $(".loadmore").removeClass("show");
      }
    });
  }
});
// removeActive function removes class- > active from each filter
function removeActive() {
  document.querySelector(".coding-filter").classList.remove("active");
  document.querySelector(".design-filter").classList.remove("active");
  document.querySelector(".marketing-filter").classList.remove("active");
}
// removeShow function removes class- > show from each card
function removeShow() {
  elementList.forEach((card) => {
    card.classList.remove("show");
  });
}
// addShow function adds class- > show to each card
function addShow() {
  elementList.forEach((card) => {
    card.classList.add("show");
  });
}
// Loadcard function is for pagination when none of filters are selected. first it uses AND operations to make sure that none of filters are selected,then  it loads 6 cards whenever you click to the button. if there is no card to load, button dissapears
function loadcard() {
  if (
    filterCoding.checked == false &&
    filterDesign.checked == false &&
    filterMarketing.checked == false
  ) {
    if ($(".card:hidden").length > 0) {
      $(".loadmore").addClass("show");
    }
    $(".loadmore").on("click", function () {
      $(".card:hidden").slice(0, 6).addClass("mobile");
      if ($(".card:hidden").length == 0) {
        $(".loadmore").removeClass("show");
      }
    });
  }
}
