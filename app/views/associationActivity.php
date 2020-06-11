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
    <link rel="stylesheet" type="text/css" href="/public/styles/spinner.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/feedback-form.css" />
    <link rel="icon" href="/public/images/fdv_logo.png" />
    <title>Fabrica de Voluntari</title>
</head>

<body>
    <div class="vertical-split">

        <?php require_once __DIR__ . "/components/menu.php"?>
        <?php require_once __DIR__ . "/components/feedback-form.php"?>
               
        <button type='button' class='add-button' id='add-project' onclick="showAddTaskForm(0)">+</button>
        <form class='project-form' id='add-task-0' method="POST">
            <input type="text" name="title" placeholder='Project Title'>
            <textarea name="descr" placeholder='Description'></textarea>
            <button name="add" type="submit" value="addProject">Add Project</button>
        </form>

        <div class="current-activity">
            <?php

            foreach ($association->projects as $project) {
                echo "<div data-in-campaign='" . (($project['in_campaign'] == 't') ? 'true' : 'false') . "' class='project'>
                <button class='campaign-button' onclick='assoc_ToggleCampaign(this, ". $project['id']  . ")'></button>
                <div class='project-banner'>";
                require __DIR__ . '/components/spinner.php';
                echo "
                <div>PROJECT: " . $project['title'] . "</div>
                <div class='project-details'>
                " . $project['descr'] . "
                </div>
                </div>
                <button type='button' class='add-button' value='". $project['id'] ."' onclick='showAddTaskForm(". $project['id'] . ")'>+</button>
                <form id='add-task-". $project['id'] . "' class='task-form' method='POST'>
                    <input type='text' name='projId' readonly style='display:none' value='". $project['id'] . "'>
                    <input type='text' name='title' placeholder='Task Title'>
                    <p class='break-row'></p>
                    <label>Max Volunteers</label>
                    <input type='number' name='max_volunteers' min=1 max=5 value=3>
                    <label>Hours</label>
                    <input type='number' name='hours' min=1>
                    <label>Due Date</label>
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
                    echo "<div data-task-id='task-". $task['task_id'] ."' class='activity-task'>";
                    require __DIR__ . '/components/spinner.php';
                    echo "<div class='task-panel'>
                    ";
                    if (isset($task['volunteers'])) {
                        foreach ($task['volunteers'] as $volunteer) {
                            if ($volunteer['profile_pic'] != null && file_exists(__DIR__ . "/../../public/images/profile-pics/" . $volunteer['profile_pic'])) {
                                echo "<div class='assoc-icon need-feedback'
                            style='background: url(/public/images/profile-pics/" . $volunteer['profile_pic'] . "); 
                            background-size: cover; background-position: center; background-repeat: no-repeat;'
                            >
                        ";
                            } else {
                                echo "<div class='assoc-icon need-feedback'
                            style='background-color: burlywood; background-size: cover; background-position: center; background-repeat: no-repeat;'
                            >";  
                            if($volunteer['initials']) 
                            echo $volunteer['initials']; 
                            else  
                            echo "?" ;
                            }
                            
                            echo "<div class='ore-lucrate'>". $volunteer['hours'] . "</div>
                            <button class='feedback-button' onclick="; echo '"showFeedbackForm(this, '. $task['task_id']  . ',true,' . $volunteer['volassoc_id'] . ',' . $_SESSION['id'] . ',\'' . $volunteer['profile_pic'] .'\',\'' . $volunteer['initials'] . '\')">'; echo"</button>
                            </div>";
                        }
                    }
                    echo "<div class='activity-duedate'>" . $task['due_date'] . "</div>    
                        <button class='done-button' onclick='assoc_markTaskDone(this, ". $task['task_id']  . ",null,null)'></button>
                 </div>
                    <div class='activity-title'>" . $task['title'] . "</div>
                    <div class='activity-desc'>" . $task['descr'] . "</div>
                    <div class='activity-notes'>" . $task['obs'] . "</div>
                    </div>";
                }
                echo "</div>";
                echo "<div class='completed-tasks'>";
                
                foreach ($project['completed'] as $task) {
                    echo "<div data-task-id='task-". $task['task_id'] ."' class='activity-task'>";
                    require __DIR__ . '/components/spinner.php';
                    echo "<div class='task-panel'>
                        ";
                    if (isset($task['volunteers'])) {
                        foreach ($task['volunteers'] as $volunteer) {
                            if ($volunteer['profile_pic'] != null && file_exists(__DIR__ . "/../../public/images/profile-pics/" . $volunteer['profile_pic'])) {
                                echo "<div class='assoc-icon" . (($volunteer['volhasfeedback'] != 't') ? ' need-feedback' : '') . "'
                            style='background: url(/public/images/profile-pics/" . $volunteer['profile_pic'] . "); 
                            background-size: cover; background-position: center; background-repeat: no-repeat;'
                            >
                        ";
                            } else {
                                echo "<div class='assoc-icon" . (($volunteer['volhasfeedback'] != 't' && $volunteer['initials']) ? ' need-feedback' : '') . "'
                            style='background-color: burlywood; background-size: cover; background-position: center; background-repeat: no-repeat;'
                            >" ;
                            if($volunteer['initials']) 
                            echo $volunteer['initials']; 
                            else  
                            echo "?" ;

                            }
                            
                            if ($volunteer['activity_done'] == 't') echo "<div class='ore-lucrate'>". $volunteer['hours'] . "</div>";
                            echo "<button class='feedback-button' onclick="; echo '"showFeedbackForm(this, '. $task['task_id']  . ',true,' . $volunteer['volassoc_id'] . ',' . $_SESSION['id'] . ',\'' . $volunteer['profile_pic'] .'\',\'' . $volunteer['initials'] . '\')">'; echo"</button>
                            </div>";
                        }
                    }
                    echo "<div class='activity-duedate'>" . $task['due_date'] . "</div>    
                    <button class='done-button' onclick='assoc_markTaskDone(this, ". $task['task_id']  . ",null, null)'></button>
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
    <script src="/public/javascript/feedback.js" ></script>
    <script>
        initCollapsible();
        initMenu();
    </script>
</body>

</html>