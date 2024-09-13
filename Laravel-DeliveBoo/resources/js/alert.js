let deleteModal = document.getElementById("deleteModal");
deleteModal.addEventListener("show.bs.modal", function (event) {
    // Button that triggered the modal
    let button = event.relatedTarget;
    // Extract info from data-* attributes
    let plateId = button.getAttribute("data-plate-id");
    // Update the form action
    let form = deleteModal.querySelector("#deleteForm");
    form.action = form.action.replace("/0", "/" + plateId);
});
