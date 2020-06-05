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
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.4"></script>
</head>

<body>
    <div class="vertical-split">
    <?php require_once __DIR__ . "/components/menu.php" ?>
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
        <div class="chartContainer">
            <canvas id="activityChart" aria-label="Activitate in asociatie" role="activitate">
            <p>Graficele nu s-au generat</p>
            </canvas>
        </div>
        NEBUNIEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEe
    </div>
    
    <script>initCollapsible();initMenu()</script>
    <script type='text/javascript'>
        var assoc_id = "<?php echo $_SESSION['id'] ?>";
    </script>
    <script src="/public/javascript/chart.js"></script>
</body>

</html>