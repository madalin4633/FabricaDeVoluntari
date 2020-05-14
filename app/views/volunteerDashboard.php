<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href=<?= $GLOBALS['URL_HOST'] . "/public/styles/commons.css"?> />
    <link rel="stylesheet" type="text/css" href=<?= $GLOBALS['URL_HOST'] . "/public/styles/tooltip.css"?> />
    <link rel="stylesheet" type="text/css" href=<?= $GLOBALS['URL_HOST'] . "/public/styles/userprofile.css"?> />
    <link rel="stylesheet" type="text/css" href=<?= $GLOBALS['URL_HOST'] . "/public/styles/collapsible.css"?> />
    <link rel="stylesheet" type="text/css" href=<?= $GLOBALS['URL_HOST'] . "/public/styles/menu.css"?> />
    <title>Document</title>
    <script src=<?= $GLOBALS['URL_HOST'] . "/public/javascript/userprofile.js"?> ></script>
    <script src=<?= $GLOBALS['URL_HOST'] . "/public/javascript/menu.js"?> ></script>
</head>

<body>
    <section class="vertical-split">

        <?php require_once __DIR__ . "/components/menu.php"; ?>
                
        <section class="horizontal-split">
            <div class="details-container">
                <div class="info-table">
                    <button class="collapsible-container active">
                        <div class="collapsible-btn">Asociatiile mele</div>
                        <img class="dropdown-btn svg-white" src=<?= $GLOBALS['URL_HOST'] . "/public/images/arrow_drop_down_circle-24px.svg" ?>>
                    </button>
                    <div class="collapsible-content" style="max-height: fit-content;">
                        <table class="tabel-asociatii">
                            <?php require_once __DIR__ . "/components/volunteer.myAssoc.php" ?>
                        </table>
                    </div>
                </div>
                <div class="info-table">
                    <button class="collapsible-container active">
                        <div class="collapsible-btn">Asociatii Sugerate</div>
                        <img class="dropdown-btn svg-white"
                            src=<?= $GLOBALS['URL_HOST'] . "/public/images/arrow_drop_down_circle-24px.svg" ?>>
                    </button>
                    <div class="collapsible-content" style="max-height: fit-content;">
                        <div class="flex-grid-expandable-list">
                            <?php 
                            foreach($volunteer -> suggestedAssociations as $assoc) {
                                echo  
                                    "<div class='flex-grid-expandable'>
                                <div class='tooltip' style='background: url(" . $GLOBALS['URL_HOST'] . "/public/images/logo/no-logo-png-4.png); background-size: cover; background-position: center; background-repeat: no-repeat;'><span class='tooltiptext'>" . $assoc['nume'] . "</span>
                                    <div class='asoc-logo'
                                        style='background: url(" . $GLOBALS['URL_HOST'] . "/public/images/logo/" . $assoc['logo'] . "); background-size: cover; background-position: center; background-repeat: no-repeat;'>
                                    </div>
                                </div>
                            </div>";
                        }?>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </section>

    <script>
        initCollapsible();
        initMenu();
    </script>
</body>

</html>