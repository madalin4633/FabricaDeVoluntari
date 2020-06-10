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
    <link rel="stylesheet" type="text/css" href="/public/styles/spinner.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/feedback-form.css" />
    <link rel="icon" href="/public/images/fdv_logo.png" />
    <title>Fabrica de Voluntari</title>
</head>

<body>
    <div class="vertical-split">

    <?php require_once __DIR__ . "/components/menu.php"?>
    <?php require_once __DIR__ . "/components/feedback-form.php"?>
               
        <div class="collapsible-container active">
                        <div id="active-tasks-header"  data-count='<?= $volunteer->activity['count'] ?>' class="collapsible-btn">Active Tasks (<?= $volunteer->activity['count'] ?>)</div>
                        <img alt="drodpown-btn" class="dropdown-btn svg-white" src="/public/images/arrow_drop_down_circle-24px.svg" >
                    </div>

        <div id="active-tasks" class="current-activity collapsible-content">
            <?php
                foreach ($volunteer->activity['projects'] as $project) {
                    echo "<div data-proj-id='project-". $project['id'] ."' class='project'><div class='project-banner'>PROJECT: " . array_values($project['tasks'])[0]['proj_title'] . "
                    <div class='project-details'>
                    " . array_values($project['tasks'])[0]['proj_descr'] . "
                    </div>
                    </div>";

                    foreach ($project['tasks'] as $task) {
                        echo "<div data-task-id='task-". $task['task_id'] ."' class='activity-task need-feedback'>";
                        require __DIR__ . '/components/spinner.php';
                        echo "<div class='task-panel'>
                        <div class='activity-duedate'>" . $task['hours_worked'] . " hours</div>
                        <div class='activity-duedate'>until " . $task['due_date'] . "</div>
                        <div class='assoc-icon'
                            style='background: url(/public/images/logo/" . $task['assoclogo'] . "); background-size: cover; background-position: center; background-repeat: no-repeat;'>
                        </div>
                        <button class='done-button' onclick='vol_markTaskDone(this, ". $task['task_id']  . ",". $_SESSION['id'] . "," . $task['assoc_id'] . ")'></button>
                        <button class='feedback-button' onclick='showFeedbackForm(this, ". $task['task_id']  . ",false," . $task['volassoc_id'] . "," . $_SESSION['id'] . ")'></button>
                        <button class='enroll-button' onclick='assignTask(this, ". $task['task_id']  . ",". $_SESSION['id'] . "," . $task['assoc_id'] . ")'></button>
                        </div>
                        <div class='activity-title'>" . $task['title'] . "</div>
                        <div class='activity-desc'>" . $task['descr'] . "</div>
                        <div class='activity-notes'>" . $task['obs'] . "</div>
                    </div>";
                    }

                    echo "</div>";
                }
            ?>
        </div>

        <div class="collapsible-container">
                        <div id="new-tasks-header" data-count='<?= $volunteer->newTasks['count'] ?>' class="collapsible-btn">New Tasks (<?= $volunteer->newTasks['count'] ?>)</div>
                        <img alt="drodpown-btn" class="dropdown-btn svg-white" src="/public/images/arrow_drop_down_circle-24px.svg" >
                    </div>

            <div id="new-tasks-container" class="current-activity collapsible-content">
            <?php
                foreach ($volunteer->newTasks['projects'] as $project) {

                    echo "<div data-proj-id='project-". $project['id'] ."' class='project'><div class='project-banner'>PROJECT: " . array_values($project['tasks'])[0]['proj_title'] . "
                    <div class='project-details'>
                    " . array_values($project['tasks'])[0]['proj_descr'] . "
                    </div>
                    </div>";

                    foreach ($project['tasks'] as $task) {
                        echo "<div data-task-id='task-". $task['task_id'] ."' class='activity-task need-feedback'>";
                        require __DIR__ . '/components/spinner.php';
                        echo "<div class='task-panel'>
                        <div class='activity-duedate'>" . $task['hours_worked'] . " hours</div>
                        <div class='activity-duedate'>until " . $task['due_date'] . "</div>
                        <div class='assoc-icon'
                            style='background: url(/public/images/logo/" . $task['assoclogo'] . "); background-size: cover; background-position: center; background-repeat: no-repeat;'>
                        </div>
                        <button class='done-button' onclick='vol_markTaskDone(this, ". $task['task_id']  . ",". $_SESSION['id'] . "," . $task['assoc_id'] . ")'></button>
                        <button class='feedback-button' onclick='showFeedbackForm(this, ". $task['task_id']  . ",false," . $task['volassoc_id'] . "," . $_SESSION['id'] . ")'></button>
                        <button class='enroll-button' onclick='assignTask(this, ". $task['task_id']  . ",". $_SESSION['id'] . "," . $task['assoc_id'] . ")'></button>
                        </div>
                        <div class='activity-title'>" . $task['title'] . "</div>
                        <div class='activity-desc'>" . $task['descr'] . "</div>
                        <div class='activity-notes'>" . $task['obs'] . "</div>
                    </div>";
                    }

                    echo "</div>";
                }
            ?>
        </div>

        <div class="collapsible-container">
                        <div id="completed-tasks-header" data-count='<?= $volunteer->completedTasks['count'] ?>' class="collapsible-btn">Completed Tasks (<?= $volunteer->completedTasks['count'] ?>)</div>
                        <img alt="drodpown-btn" class="dropdown-btn svg-white" src="/public/images/arrow_drop_down_circle-24px.svg" >
                    </div>

            <div id="completed-tasks-container" class="current-activity completed-tasks collapsible-content">
            <?php
                foreach ($volunteer->completedTasks['projects'] as $project) {

                    echo "<div data-proj-id='project-". $project['id'] ."' class='project'><div class='project-banner'>PROJECT: " . array_values($project['tasks'])[0]['proj_title'] . "
                    <div class='project-details'>
                    " . array_values($project['tasks'])[0]['proj_descr'] . "
                    </div>
                    </div>";

                    foreach ($project['tasks'] as $task) {
                        echo "<div data-task-id='task-". $task['task_id'] ."' class='activity-task need-feedback'>";
                        require __DIR__ . '/components/spinner.php';
                        echo "<div class='task-panel'>
                            <div class='activity-duedate'>" . $task['hours_worked'] . " hours</div>
                            <div class='activity-duedate'>until " . $task['due_date'] . "</div>
                            <div class='assoc-icon' data-assoc-id=" . $task['assoc_id'] . "
                            style='background: url(/public/images/logo/" . $task['assoclogo'] . "); background-size: cover; background-position: center; background-repeat: no-repeat;'>
                            </div>
                            <button class='done-button' onclick='vol_markTaskDone(this, ". $task['task_id']  . ",". $_SESSION['id'] . "," . $task['assoc_id'] . ")'></button>
                            <button class='feedback-button' onclick='showFeedbackForm(this, ". $task['task_id']  . ",false," . $task['volassoc_id'] . "," . $_SESSION['id'] . ")'></button>
                            <button class='enroll-button' onclick='assignTask(this, ". $task['task_id']  . ")'></button>
                    </div>
                    <div class='activity-title'>" . $task['title'] . "</div>
                    <div class='activity-desc'>" . $task['descr'] . "</div>
                    <div class='activity-notes'>" . $task['obs'] . "</div>
                    </div>";
                    }

                    echo "</div>";
                }
            ?>
        </div>

    </div>

    <script src="/public/javascript/menu.js"></script>
    <script src="/public/javascript/useractivity.js"></script>
    <script src="/public/javascript/collapsible.js" ></script>
    <script src="/public/javascript/feedback.js" ></script>
    <script>
        
        initCollapsible();
        initMenu();
    </script>
</body>

</html>