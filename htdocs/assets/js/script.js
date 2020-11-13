document.addEventListener("DOMContentLoaded", async () => {
  let checked,
    disable = false,
    arr;
  let afterElement;
  let draggabled;

  await display();

  document.getElementById("newTask").addEventListener("click", async () => {
    const xmlhttpNew = new XMLHttpRequest();

    xmlhttpNew.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        display();
        document.getElementById("newOutput").value = "";
      }
    };

    xmlhttpNew.open("GET", `assets/php/form.php`, true);
    xmlhttpNew.send();
  });

  function listener() {
    const draggables = document.querySelectorAll(".draggable");
    const containers = document.querySelectorAll(".dragContainer");

    checked.forEach((checkbox) => {
      checkbox.addEventListener("click", async () => {
        checked.forEach((el) => {
          if (el.checked === true) {
            disable = true;
          }
        });
        document.getElementById("saveBtn").disabled = disable;
        xmlSave(checkbox.value);
        await display();
      });
      disable = false;
    });

    draggables.forEach((draggable) => {
      draggable.addEventListener("dragstart", () => {
        draggable.classList.add("dragging");
      });

      draggable.addEventListener("dragend", () => {
        draggable.classList.remove("dragging");
      });

      draggable.addEventListener("drop", () => {
        console.log("test");
        savePosition(afterElement.innerText, draggabled.innerText);
      });
    });

    containers.forEach((container) => {
      container.addEventListener("dragover", (e) => {
        e.preventDefault();
        afterElement = getDragAfterElement(container, e.clientY);
        draggabled = document.querySelector(".dragging");
        if (afterElement == null) {
          container.appendChild(draggabled);
        } else {
          container.insertBefore(draggabled, afterElement);
        }
      });
    });
  }

  function getDragAfterElement(container, y) {
    const draggableElements = [
      ...container.querySelectorAll(".draggable:not(.dragging)"),
    ];

    return draggableElements.reduce(
      (closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        if (offset < 0 && offset > closest.offset) {
          return { offset: offset, element: child };
        } else {
          return closest;
        }
      },
      { offset: Number.NEGATIVE_INFINITY }
    ).element;
  }

  function xmlSave(box) {
    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = async function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("saveBtn").disabled = false;
        // await display();
      }
    };

    xmlhttp.open(
      "GET",
      `assets/php/onChange.php?box=${box}&disable=${!disable}`,
      true
    );

    xmlhttp.send();
    return;
  }

  function savePosition(position, taskName) {
    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = async function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.response);
      }
    };

    xmlhttp.open(
      "GET",
      `assets/php/savePosition.php?position=${position}&task=${taskName}`,
      true
    );

    xmlhttp.send();
    return;
  }

  function display() {
    //display Task
    const displayTasks = new Promise((res) => {
      const xmlhttpTask = new XMLHttpRequest();

      xmlhttpTask.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          arr = this.response.split("$,$");
          document.getElementById("targetTask").innerHTML = "";
          for (let i = 0; i < arr.length; i++) {
            const newTask = document.createElement("div");
            newTask.draggable = true;
            newTask.classList.add("draggable");
            newTask.innerHTML = arr[i];
            document.getElementById("targetTask").appendChild(newTask);
          }

          checked = document.querySelectorAll(".checkbox");
          listener();
          res();
        }
      };

      xmlhttpTask.open("GET", `assets/php/content.php?d=todo`, true);
      xmlhttpTask.send();
    });

    // Display Archive
    const displayArchived = new Promise((res) => {
      const xmlhttpArchive = new XMLHttpRequest();

      xmlhttpArchive.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("targetArchive").innerHTML = this.response;
          res();
        }
      };

      xmlhttpArchive.open("GET", `assets/php/content.php?d=archive`, true);
      xmlhttpArchive.send();
    });

    return Promise.all([displayArchived, displayTasks]);
  }
});
