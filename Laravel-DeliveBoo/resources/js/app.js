import "./bootstrap";
import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**"]);

import "./alert.js";

document.getElementById("img").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imgPreview = document.getElementById("img-preview");
            const currentImage = document.getElementById("current-img");
            imgPreview.src = e.target.result;
            imgPreview.style.display = "block";
            currentImage.style.display = "none";
        };
        reader.readAsDataURL(file);
    } else {
        const imgPreview = document.getElementById("img-preview");
        imgPreview.src = "#";
        imgPreview.style.display = "none";
    }
});
