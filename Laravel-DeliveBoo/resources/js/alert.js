document.addEventListener("DOMContentLoaded", function () {
    let deleteModal = document.getElementById("deleteModal");
    let deleteRestaurant = document.getElementById("deleteRestaurant");
    deleteRestaurant.addEventListener("show.bs.modal", function (event) {
        console.log("Ristorante");
        let button = event.relatedTarget;
        let restaurantId = button.getAttribute("data-restaurant-id");
        let form = deleteModal.querySelector("form");
        form.setAttribute("action", "/admin/restaurants/" + restaurantId);
    });

    deleteModal.addEventListener("show.bs.modal", function (event) {
        console.log("Piatto");
        let button = event.relatedTarget;
        let plateId = button.getAttribute("data-plate-id");
        let form = deleteModal.querySelector("form");
        form.setAttribute("action", "/admin/plates/" + plateId);
    });
});
