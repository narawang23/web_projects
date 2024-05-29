
// Set up the event listener for the search button
document.querySelector("#search").addEventListener("click", function () {
  console.log("search Button clicked!");
  let searchQuery = document.querySelector("#searchTerm").value; //get the search inbox value to pass to server
  fetch("../server/search.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "query=" + encodeURIComponent(searchQuery),
  })
    .then((response) => response.text())
    .then((html) => {
      document.querySelector(".tasks").innerHTML = html;
    })
    .catch((error) => {
      console.error("Error during fetch:", error);
    });
});
