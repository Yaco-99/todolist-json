<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <?php /* include 'assets/php/content.php'; */?>
    <script src="assets/data/task.json"></script>
    <script defer src="assets/js/script.js"></script>
    
  </head>
  <body>
    <div class="container-fluid">
      <div class="row mb-3">
        <div class="col col-md-4 offset-md-4 taskList">
          <div>
            <h4>To do :</h4>
            <form
              action="assets/php/archiving.php"
              method="POST"
              target="hiddenFrame2">
              <div class="dragContainer" id="targetTask">

              </div>
              <?php
                /* foreach($toDo as $task){
                  echo "<div><input class='checkbox' type='checkbox' name='task[]' value='$task[task]'><label class='ml-2' for='task'>$task[task]</label></div>";
                }  */
                ?>
            <button
                type="submit"
                name="submit"
                class="btn btn-outline-dark d-block mr-auto"
                id="saveBtn"
              >
                Save
              </button>
            </form>
          </div>
          <div>
            <h4 class="my-3">Archive :</h4>
            <div id="targetArchive">
            <?php
               /* foreach($archive as $task){
                echo "<div><input disabled checked type='checkbox' name='task[]' value='$task[task]'><label class='ml-2 archived' for='task'>$task[task]</label></div>";
              }  */
            ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col col-md-6 offset-md-3 taskList">
          <div>
            <h5>Add a new task</h5>
            <form
              action="assets/php/form.php"
              method="POST"
              target="hiddenFrame"
            >
              <div class="form-group">
                <label for="task">Thing to do</label>
                <textarea id="newOutput" class="form-control" name="task" rows="3"></textarea>
              </div>
              <button
                type="submit"
                name="submit"
                id="newTask"
                class="btn btn-outline-dark d-block ml-auto"
              >
                Submit
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <iframe name="hiddenFrame" style="display: none"></iframe>
    <iframe name="hiddenFrame2" style="display: none"></iframe>
    <!-- JS, Popper.js, and jQuery -->
    <script src="assets/node_modules/jquery/dist/jquery.slim.js"></script>
    <script src="assets/node_modules/@popperjs/core/dist/umd/popper.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.js"></script>
  </body>
</html>
