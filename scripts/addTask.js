

document.getElementById("add-btn").addEventListener("click", () => {
  console.log("Add Task button clicked");
  window.location.href = "../pages/addTask.php";
});

let container = document.querySelector(".tasks");
const taskDiv = document.createElement("div");
taskDiv.className = "task";
taskDiv.innerHTML = `
        <div class="task-title">${task.taskName}</div>
        <div>Description: ${task.description}</div>
        <div>Priority: ${task.priority}</div>
        <div>Status: ${task.status}</div>
        <div>Due Date: ${task.dueDate}</div>
        <div class="task-buttons">
            <button class="edit" data-task-id="${task.taskId}">Edit</button>
            <button class="delete" data-task-id="${task.taskId}">Delete</button>
        `;
container.appendChild(taskDiv);
