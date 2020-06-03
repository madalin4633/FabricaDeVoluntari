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
                
        <div class='add-buton'>+</div>
        <div class="current-activity">
            <?php
                foreach ($association->activity as $task) {
                    echo "<div class='activity-task'>
                    <div class='task-panel'>
                        ";
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

    <script>
        initCollapsible();
        initMenu();
    </script>
    <script src="/public/javascript/menu.js"></script>
</body>

</html>