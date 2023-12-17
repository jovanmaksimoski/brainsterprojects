let marketing = document.getElementById("marketing");
let code = document.getElementById("code");
let design = document.getElementById("design");
let codingCards = document.querySelectorAll(".coding");
let designCards = document.querySelectorAll(".design");
let marketingCards = document.querySelectorAll(".marketing");
let allCards = document.querySelectorAll(".card");

marketing.onclick = function () {
  toggleFilter(marketing);
  filteringCards(marketingCards);
  showCards(marketing);
};

code.onclick = function () {
  toggleFilter(code);
  filteringCards(codingCards);
  showCards(code);
};

design.onclick = function () {
  toggleFilter(design);
  filteringCards(designCards);
  showCards(design);
};

function showCards(cardType) {
  if (!cardType.classList.contains("filter-on")) {
    showAllCards();
  }
}

function toggleFilter(button) {
  if (!button.classList.contains("filter-on")) {
    button.classList.add("filter-on");
    if (button !== marketing) {
      marketing.classList.remove("filter-on");
    }
    if (button !== code) {
      code.classList.remove("filter-on");
    }
    if (button !== design) {
      design.classList.remove("filter-on");
    }
  } else {
    button.classList.remove("filter-on");
  }
}

function filteringCards(cards) {
  hideAllCards();

  cards.forEach((card) => {
    card.style.display = "block";
  });
}

function hideAllCards() {
  allCards.forEach((card) => {
    card.style.display = "none";
  });
}

function showAllCards() {
  allCards.forEach((card) => {
    card.style.display = "block";
  });
}
