import Choices from "choices.js";
import "choices.js/public/assets/styles/choices.min.css";

window.addEventListener("click", function (event) {
    if (event.target.matches("#select-all")) {
        event.preventDefault();
        let checkboxes = document.querySelectorAll("input[type='checkbox']");
        checkboxes.forEach((checkbox) => {
            checkbox.checked = true;
        });
    }
});

window.addEventListener("load", function () {
    let choicesElements = document.querySelectorAll(".choices");
    choicesElements.forEach((element) => {
        new Choices(element, {
            searchEnabled: true,
            itemSelectText: "",
        });
    });
});
