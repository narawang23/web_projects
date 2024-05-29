
// Set up the event listener for the filter button
document.getElementById("apply-filter").addEventListener("click", function () {
  console.log("filter button clicked");
  //userId = $_SESSION["user_id"];
  let priority = document.getElementById("priority").value;
  let dueDate = document.getElementById("dueDate").value;
  let status = document.getElementById("status").value;

  //console.log(priority);


  let queryString = new URLSearchParams({
    priority: priority,
    dueDate: dueDate,
    status: status,
  }).toString();

 
  fetch("../server/filterTasks.php?" + queryString)
    .then((response) => response.text())
    .then((html) => {
      document.querySelector(".tasks").innerHTML = html;
    })
    .catch((error) => console.error("Error during fetch:", error));
});
