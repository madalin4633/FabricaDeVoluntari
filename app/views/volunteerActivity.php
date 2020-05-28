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
    <script src="/public/javascript/menu.js" ></script>
</head>

<body>
    <div class="vertical-split">

        <?php require_once __DIR__ . "/components/menu.php"?>
                
        <div class="current-activity">
            <?php
                foreach ($volunteer->activity as $task) {
                    echo "<div class='activity-task'>
                    <div class='task-panel'>
                        <div class='activity-duedate'>" . $task['due_date'] . "</div>
                        <div class='assoc-icon'
                            style='background: url(/public/images/logo/" . $task['assoclogo'] . "); background-size: cover; background-position: center; background-repeat: no-repeat;'>
                        </div>
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
</body>

</html>