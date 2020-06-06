<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="Description" content="Volunteer's activity within the selected association">
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
                
        <div id="active-tasks" class="current-activity">
            <?php
                foreach ($volunteer->activity as $task) {
                    echo "<div class='activity-task'>
                        <div class='task-panel'>
                        <div class='activity-duedate'>" . $task['hours_worked'] . " hours</div>
                        <div class='activity-duedate'>until " . $task['due_date'] . "</div>
                        <div class='assoc-icon'
                            style='background: url(/public/images/logo/" . $task['assoclogo'] . "); background-size: cover; background-position: center; background-repeat: no-repeat;'>
                        </div>
                        <button class='done-button' onclick='vol_markTaskDone(this, ". $task['task_id']  . ",". $_SESSION['id'] . "," . $task['assoc_id'] . ")'></button>
                    </div>
                    <div class='activity-title'>" . $task['title'] . "</div>
                    <div class='activity-desc'>" . $task['descr'] . "</div>
                    <div class='activity-notes'>" . $task['obs'] . "</div>
                    </div>";
                }
            ?>
        </div>

        <div class="collapsible-container active">
                        <div class="collapsible-btn">New Tasks</div>
                        <img alt="drodpown-btn" class="dropdown-btn svg-white" src="/public/images/arrow_drop_down_circle-24px.svg" >
                    </div>

            <div id="new-tasks-container" class="current-activity collapsible-content">
            <?php
                foreach ($volunteer->newTasks['projects'] as $project) {

                    echo "<div class='project'><div class='project-banner'>PROJECT: " . array_values($project['tasks'])[0]['proj_title'] . "
                    <div class='project-details'>
                    " . array_values($project['tasks'])[0]['proj_descr'] . "
                    </div>
                    </div>";

                    foreach ($project['tasks'] as $task) {
                        echo "<div class='activity-task'>
                    <div class='task-panel'>
                    <div class='activity-duedate'>" . $task['hours_worked'] . " hours</div>
                    <div class='activity-duedate'>until " . $task['due_date'] . "</div>
                    <div class='assoc-icon'
                            style='background: url(/public/images/logo/" . $task['assoclogo'] . "); background-size: cover; background-position: center; background-repeat: no-repeat;'>
                        </div>
                    </div>
                    <div class='activity-title'>" . $task['title'] . "</div>
                    <div class='activity-desc'>" . $task['descr'] . "</div>
                    <div class='activity-notes'>" . $task['obs'] . "</div>
                    <button class='enrollTask' onclick='assignTask(this, ". $task['task_id']  . ",". $_SESSION['id'] . "," . $task['assoc_id'] . ")'>I want this task</button>
                    </div>";
                    }

                    echo "</div>";
                }
            ?>
        </div>

        <div class="collapsible-container active">
                        <div class="collapsible-btn">Completed</div>
                        <img alt="drodpown-btn" class="dropdown-btn svg-white" src="/public/images/arrow_drop_down_circle-24px.svg" >
                    </div>

            <div id="completed-tasks-container" class="current-activity collapsible-content">
            <?php
                foreach ($volunteer->newTasks as $task) {
                    echo "<div class='activity-task'>
                    <div class='task-panel'>
                    <div class='activity-duedate'>" . $task['hours_worked'] . " hours</div>
                    <div class='activity-duedate'>until " . $task['due_date'] . "</div>
                    <div class='assoc-icon'
                            style='background: url(/public/images/logo/" . $task['assoclogo'] . "); background-size: cover; background-position: center; background-repeat: no-repeat;'>
                        </div>
                    </div>
                    <div class='activity-title'>" . $task['title'] . "</div>
                    <div class='activity-desc'>" . $task['descr'] . "</div>
                    <div class='activity-notes'>" . $task['obs'] . "</div>
                    <button class='enrollTask' onclick='assignTask(this, ". $task['task_id']  . ",". $_SESSION['id'] . "," . $task['assoc_id'] . ")'>I want this task</button>
                    </div>";
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