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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" type="text/javascript"></script>
</head>

<body>
    <div class="vertical-split">
    <?php require_once __DIR__ . "/components/menu.php" ?>
        <div class="buttonsContainer">
            <button id="GenerateBtn" type="button">
            Ultima saptamana
            </button>
            <button id="GenerateBtn" type="button">
            Ultima luna
            </button>
            <button id="GenerateBtn" type="button">
            Ultimul an
            </button>
        </div>
        <div class="chartContainer">
            <canvas id="activityChart" aria-label="Ore lucrate in asociatie" role="ore-lucrate">
            <p>Graficele nu s-au generat</p>
            </canvas>
        </div>
    </div>
    
    <script>initCollapsible();initMenu()</script>
    <script src="/public/javascript/chart.js"></script>
</body>

</html>