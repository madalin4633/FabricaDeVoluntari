<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="Description" content="Activity reports for volunteers">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/styles/commons.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/tooltip.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/userprofile.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/collapsible.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/menu.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/charts.css" />
    <link rel="icon" href="/public/images/fdv_logo.png" />
    <title>Fabrica de Voluntari</title>
    <script src="/public/javascript/userprofile.js" ></script>
    <script src="/public/javascript/menu.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.5.3/dist/jspdf.plugin.autotable.js"></script>
</head>

<body>
    <div class="vertical-split">
    <?php require_once __DIR__ . "/components/menu.php" ?>
        <div class="data">
        <h3>Genereaza rapoarte grafice si numerice din:</h3>
        <div class="buttonsContainer">
            <button id="LastWeek" type="button">
            Ultima saptamana
            </button>
            <button id="LastMonth" type="button">
            Ultima luna
            </button>
            <button id="LastYear" type="button">
            Ultimul an
            </button>
        </div>
        <h3>sau dintr-un anumit interval:</h3>
        <div class="datesParent">
        <div class="datesContainer">
            <input type="date" id="start" value="2020-01-01">
            <input type="date" id="end" value="2020-06-10">
            <button id="submitDates" type="button">
            Genereaza
            </button>
        </div>
        </div>
        <div id="exportContainer"></div>
        <div class="bigChart">
        <div class="chartContainer" id="chartContainer">
            <canvas id="activityChart" aria-label="Activitate in asociatie">
            <p>Graficele nu s-au generat</p>
            </canvas>
        </div> <!-- chartContainer-->
        </div> <!-- bigChart -->
            <div class="myDynamicTable" id="myDynamicTable"></div>
            
        </div> <!-- data -->
    </div>
    
    <script>initCollapsible();initMenu()</script>
    <script>
        var assoc_id = "<?php echo $_SESSION['id'] ?>";
    </script>
    <script src="/public/javascript/chart.js"></script>
</body>

</html>