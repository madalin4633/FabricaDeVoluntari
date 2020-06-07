<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="Description" content="Associations' overview of tasks">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/styles/commons.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/tooltip.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/userActivity.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/collapsible.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/menu.css" />
    <link rel="icon" href="/public/images/fdv_logo.png" />
    <title>Fabrica de Voluntari</title>
</head>

<body>
    <div class="vertical-split">

        <?php require_once __DIR__ . "/components/menu.php"?>
                
        <button type='button' class='add-button' id='add-project' onclick="showAddTaskForm(0)">+</button>
        <form class='project-form' id='add-task-0' method="POST" action="">
            <input type="text" name="title" placeholder='Project Title'>
            <textarea name="descr" placeholder='Description'></textarea>
            <button name="add" type="submit" value="addProject">Add Project</button>
        </form>

        <div class="current-activity">
            <?php

            foreach ($association->projects as $project) {
                echo "<div class='project'><div class='project-banner'>PROJECT: " . $project['title'] . "
                <div class='project-details'>
                " . $project['descr'] . "
                </div>
                </div>
                <button type='button' class='add-button' value='". $project['id'] ."' onclick='showAddTaskForm(". $project['id'] . ")'>+</button>
                <form id='add-task-". $project['id'] . "' class='task-form' method='POST' action=''>
                    <input type='text' name='projId' readonly style='display:none' value='". $project['id'] . "'>
                    <input type='text' name='title' placeholder='Task Title'>
                    <label for='max_volunteers'>Max Volunteers</label>
                    <input type='number' name='max_volunteers' min=1 max=5 value=3>
                    <label for='max_volunteers'>Hours</label>
                    <input type='number' name='hours' min=1>
                    <label for='due_date'>Due Date</label>
                    <input type='date' name='due_date'>
                    <p class='break-row'></p>
                    <textarea name='descr' placeholder='Description'></textarea>
                    <textarea name='obs' placeholder='Notes'></textarea>
                    <p class='break-row'></p>
                    <button name='add' type='submit' value='addTask'>Add Task</button>
                </form>

                <div class='active-tasks'>
        ";

                foreach ($project['activity'] as $task) {
                    echo "<div class='activity-task'>
                    <div class='task-panel'>
                        ";
                    if (isset($task['volunteers'])) {
                        foreach ($task['volunteers'] as $volunteer) {
                            if (file_exists(__DIR__ . "/../../public/images/profile-pics/" . $volunteer['profile_pic'])) {
                                echo "<div class='assoc-icon'
                            style='background: url(/public/images/profile-pics/" . $volunteer['profile_pic'] . "); 
                            background-size: cover; background-position: center; background-repeat: no-repeat;'
                            >
                        ";
                            } else {
                                echo "<div class='assoc-icon'
                            style='background-color: burlywood; background-size: cover; background-position: center; background-repeat: no-repeat;'
                            >" . $volunteer['initials'] ;
                            }
                            
                            echo "<div class='ore-lucrate'>". $volunteer['hours'] . "</div></div>";
                        }
                    }
                    echo "<div class='activity-duedate'>" . $task['due_date'] . "</div>    
                        <button class='done-button' onclick='assoc_markTaskDone(this, ". $task['task_id']  . ")'></button>
                    </div>
                    <div class='activity-title'>" . $task['title'] . "</div>
                    <div class='activity-desc'>" . $task['descr'] . "</div>
                    <div class='activity-notes'>" . $task['obs'] . "</div>
                    </div>";
                }
                echo "</div>";
                echo "<div class='completed-tasks'>";
                
                foreach ($project['completed'] as $task) {
                    echo "<div class='activity-task'>
                    <div class='task-panel'>
                        ";
                    if (isset($task['volunteers'])) {
                        foreach ($task['volunteers'] as $volunteer) {
                            if (file_exists(__DIR__ . "/../../public/images/profile-pics/" . $volunteer['profile_pic'])) {
                                echo "<div class='assoc-icon'
                            style='background: url(/public/images/profile-pics/" . $volunteer['profile_pic'] . "); 
                            background-size: cover; background-position: center; background-repeat: no-repeat;'
                            >
                        ";
                            } else {
                                echo "<div class='assoc-icon'
                            style='background-color: burlywood; background-size: cover; background-position: center; background-repeat: no-repeat;'
                            >" . $volunteer['initials'] ;
                            }
                            
                            echo "<div class='ore-lucrate'>". $volunteer['hours'] . "</div></div>";
                        }
                    }
                    echo "<div class='activity-duedate'>" . $task['due_date'] . "</div>    
                        <button class='done-button' onclick='assoc_markTaskDone(this, ". $task['task_id']  . ")'></button>
                    </div>
                    <div class='activity-title'>" . $task['title'] . "</div>
                    <div class='activity-desc'>" . $task['descr'] . "</div>
                    <div class='activity-notes'>" . $task['obs'] . "</div>
                    </div>";
                }
                
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <script src="/public/javascript/menu.js"></script>
    <script src="/public/javascript/useractivity.js"></script>
    <script>
        initCollapsible();
        initMenu();
    </script>
</body>

</html>