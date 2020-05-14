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
            <nav class="leftPanel">
                <div class="vertical-split">
                    <div class="crop">
                        <img alt="profile pic" src=<?= $GLOBALS['URL_HOST'] . "/public/images/". $volunteer -> pic; ?>>
                    </div>
                    <div id="full-name">
                        <?php echo $volunteer -> username; ?>
                    </div>
                </div>
                <div>
                    Profil
                </div>
                <div>
                    Deconectare
                </div>
                <div>
                    badge-uri
                </div>
                <div>
                    Feedback
                </div>
            </nav>

            <div class="details-container">
                <div class="info-table">
                    <button class="collapsible-container">
                        <div class="collapsible-btn">Detalii personale</div>
                        <img class="dropdown-btn svg-white" src=<?= $GLOBALS['URL_HOST'] . "/public/images/arrow_drop_down_circle-24px.svg" ?>>
                    </button>
                    <div class="collapsible-content">
                        <table>
                            <?php 
                                foreach($volunteer -> personalDetails as $key => $detail) {
                                    if (strpos($key, '_ignore_') === false) {
                                    echo "<tr>
                                        <th nowrap>
                                            " . str_replace('_noedit_', '', $key) . "
                                        </th>
                                        <td "; if (strpos($key, '_noedit_') !== false) echo " noedit='true'"; echo ">
                                            " . $detail . ' ' . "
                                        </td>
                                    </tr>";}
                                };
                            ?>
                        </table>
                    </div>
                </div>
                <div class="info-table">
                    <button class="collapsible-container">
                        <div class="collapsible-btn">Aptitudini</div>
                        <img class="dropdown-btn svg-white" src=<?= $GLOBALS['URL_HOST'] . "/public/images/arrow_drop_down_circle-24px.svg" ?>>
                    </button>
                    <div class="collapsible-content">
                        <div class="under-construction">Under construction</div>
                    </div>
                </div>
                <div class="info-table">
                    <button class="collapsible-container">
                        <div class="collapsible-btn">Interese</div>
                        <img class="dropdown-btn svg-white" src=<?= $GLOBALS['URL_HOST'] . "/public/images/arrow_drop_down_circle-24px.svg" ?>>
                    </button>
                    <div class="collapsible-content">
                        <div class="under-construction">Under construction</div>
                    </div>
                </div>
            </div>

        </section>
    </section>

    <script>initCollapsible();initMenu()</script>
</body>

</html>