document.addEventListener("DOMContentLoaded", function () {
    let deleteModal = document.getElementById("deleteModal");

    deleteModal.addEventListener("show.bs.modal", function (event) {
        let button = event.relatedTarget;
        let plateId = button.getAttribute("data-plate-id");

        let form = deleteModal.querySelector("form");
        form.setAttribute("action", "/admin/plates/" + plateId);
    });
});
