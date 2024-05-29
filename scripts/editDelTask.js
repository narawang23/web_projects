

// event delegation for handling events on the "Edit" and "Delete" buttons
document.addEventListener("DOMContentLoaded", function () {
  document.querySelector(".tasks").addEventListener("click", function (event) {
    // Determine the event target and extract the taskId
    const target = event.target;
    const taskId = target.dataset.taskId;

    if (target.classList.contains("delete")) {
      // Confirm deletion with the user
      const confirmDelete = confirm(
        "Are you sure you want to delete this task?"
      );
      if (confirmDelete) {
        // Redirect to deleteTask.php with the taskId as a query parameter
        window.location.href = `../server/deleteTask.php?taskId=${taskId}`;
      }
    }
    if (target.classList.contains("edit")) {
      window.location.href = `../pages/editTask.php?taskId=${taskId}`;
    }
  });
});
