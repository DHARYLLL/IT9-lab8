<?php

session_start();
include "../operations/database.php";

if (!isset($_SESSION['user_id'])) {
    header("location: ../Authentication/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// get user name and email
$user_name = "SELECT fname, lname, email FROM user WHERE user_id = ?";
$user_stmt = $conn->prepare($user_name);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user_name = $user_result->fetch_assoc();
$user_stmt->close();


// user task
$sql = "SELECT id, task, completed FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$tasks = [];
while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

$stmt->close();
$conn->close();
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TODO Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col col-12 col-sm-6 ">

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="col col-auto me-3">
                                <i class="bi bi-person-circle fs-1"></i>
                            </div>
                            <div class="col">
                                <span class="fs-3"> <strong>Name: </strong><?php echo ($user_name['fname'] . ' ' . $user_name['lname']); ?></span>
                                <br>
                                <span class="fs-4"> <strong>Email: </strong> <?php echo ($user_name['email']); ?> </span>
                            </div>
                            <form action="../Authentication/logout.php" method="POST">
                                <div>
                                    <a href="../Authentication/login.php" class="btn btn-primary">Log out</a>
                                </div>
                            </form>

                        </div>

                        <h2 class="card-title">To Do List</h2>
                        <p class="card-text small text-secondary">Manage your task efficiently.</p>

                        <!-- Input group -->
                        <form action="../operations/op_add_task.php" class="input-group mb-3" method="POST">
                            <input required type="text" class="form-control" placeholder="Add new task here" aria-label="Recipient's username" aria-describedby="button-addon2"
                                name="task">
                            <button class="btn btn-success" type="submit" id="button-addon2">Add</button>
                        </form>

                        <!-- task -->
                        <div class="d-flex flex-column gap-3">
                            <?php
                            if (empty($tasks)) {
                                echo "<p class='text-center text-secondary'>No tasks added yet. Start by adding one!</p>";
                            } else {
                                foreach ($tasks as $task) {
                            ?>
                                    <div class="d-flex  justify-content-between">
                                        <form action="../operations/op_mark_task.php" method="POST">
                                            <div class="d-flex align-items-center gap-2">
                                                <input value="<?= $task['id'] ?>" hidden name="id">
                                                <input type="Checkbox" class="form-check-input mt-0"
                                                    onchange="this.form.submit();"
                                                    <?php echo ($task['completed'] == 1) ? 'checked' : ''; ?>>

                                                <label class="form-check-label"><?php echo $task['task']; ?></label>

                                                <small class="badge rounded-pill <?php echo ($task['completed'] == 1) ? 'bg-success text-white' : 'bg-warning text-dark'; ?>">
                                                    <?php echo ($task['completed'] == 1) ? 'done' : 'pending'; ?>
                                                </small>
                                            </div>
                                        </form>

                                        <form action="operations/delete_task.php" method="post">
                                            <input value="<?= $task['id'] ?>" hidden name="id">
                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"> Delete</i>
                                            </button>
                                        </form>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>