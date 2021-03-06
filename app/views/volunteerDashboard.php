<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="Description" content="Volunteer's dashboard showing personal activity within the associations">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/styles/commons.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/tooltip.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/userprofile.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/collapsible.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/menu.css" />
    <link rel="icon" href="/public/images/fdv_logo.png" />
    <title>Fabrica de Voluntari</title>
    <script src="/public/javascript/collapsible.js" ></script>
    <script src="/public/javascript/menu.js" ></script>
</head>

<body>
    <div class="vertical-split">

        <?php require_once __DIR__ . "/components/menu.php"?>
                
        <div class="horizontal-split">
            <div class="details-container">
                <div class="info-table">
                    <div class="collapsible-container active">
                        <div class="collapsible-btn">My Associations</div>
                        <img alt="drodpown-btn" class="dropdown-btn svg-white" src="/public/images/arrow_drop_down_circle-24px.svg" >
                    </div>
                    <div class="collapsible-content" style="max-height: fit-content;">
                        <div class="flex-grid-expandable-list">
                            <?php require_once __DIR__ . "/components/volunteer.myAssoc.php" ?>
                        </div>
                    </div>
                </div>
                <div class="info-table">
                    <div class="collapsible-container active">
                        <div class="collapsible-btn">Campaigns</div>
                        <img alt="drodpown-btn" class="dropdown-btn svg-white"
                            src="/public/images/arrow_drop_down_circle-24px.svg" >
                        </div>
                        <div class="collapsible-content" style="max-height: fit-content;">
                        <div class="flex-grid-expandable-list">
                            <?php
                            foreach ($volunteer -> suggestedAssociations as $assoc) {
                                echo
                                    "<div class='flex-grid-expandable'>
                                        <div data-assoc-id='" . $assoc['assoc_id'] . "' class='tooltip' style='background: url(/public/images/logo/no-logo-png-4.png); background-size: cover; background-position: center; background-repeat: no-repeat;'><span class='tooltiptext'>" . $assoc['nume'] . "</span>
                                            <div class='asoc-logo'
                                                style='background: url(/public/images/logo/" . $assoc['logo'] . "); background-size: cover; background-position: center; background-repeat: no-repeat;'>
                                            </div>
                                        </div>
                                        <div class='assoc-details'>
                                        <div> # Projects: " . $assoc['no_projects'] . "</div>
                                        <div> # Volunteers: " . $assoc['no_volunteers'] . "</div>
                                        <button type='button' onclick="; echo '"javascript:window.location.href = \'mailto:' . $assoc['email'] . '\'"'; echo ">Contact Us</button>
                                        </div>
                                    </div>"
                                ;
                            }?>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        initCollapsible();
        initMenu();
    </script>
</body>

</html>