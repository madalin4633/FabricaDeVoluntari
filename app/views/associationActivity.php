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
                
        <button type='button' class='add-button' onclick="showAddTaskForm()">+</button>
        <form class='task-form' method="POST" action="">
            <input type="text" name="title" placeholder='Task Title'>
            <!-- <label for="max_volunteers">MAX:</label> -->
            <input type="number" name="max_volunteers" min=1 max=5 value=3>
            <input type="date" name="due_date">
            <p class='break-row'></p>
            <textarea name="descr" placeholder='Description'></textarea>
            <textarea name="obs" placeholder='Notes'></textarea>
            <p class='break-row'></p>
            <button name="add" type="submit" value="addTask">Add Task</button>
        </form>

        <div class="current-activity">
            <?php
                foreach ($association->activity as $task) {
                    echo "<div class='activity-task'>
                    <div class='task-panel'>
                        ";
                        if (isset($task['volunteers']))
                        foreach($task['volunteers'] as $volunteer) {
                            if (file_exists(__DIR__ . "/../../public/images/profile-pics/" . $volunteer['profile_pic']))
                            echo "<div class='assoc-icon'
                            style='background: url(/public/images/profile-pics/" . $volunteer['profile_pic'] . "); 
                            background-size: cover; background-position: center; background-repeat: no-repeat;'
                            >
                        "; 
                        else
                        echo "<div class='assoc-icon'
                            style='background-color: burlywood; background-size: cover; background-position: center; background-repeat: no-repeat;'
                            >" . $volunteer['initials'] ;
                            
                            echo "<div class='ore-lucrate'>". $volunteer['hours'] . "</div></div>"; 
                    }
                    echo "<div class='activity-duedate'>" . $task['due_date'] . "</div>    
                    </div>
                    <div class='activity-title'>" . $task['title'] . "</div>
                    <div class='activity-desc'>" . $task['descr'] . "</div>
                    <div class='activity-notes'>" . $task['obs'] . "</div>
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