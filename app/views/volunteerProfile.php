<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="Description" content="Volunteer's profile showing personal details">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/styles/commons.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/tooltip.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/userprofile.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/collapsible.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/menu.css" />
    <link rel="icon" href="/public/images/fdv_logo.png" />
    <title>Fabrica de Voluntari</title>
    <script src="/public/javascript/userprofile.js" ></script>
    <script src="/public/javascript/menu.js" ></script>
    
</head>

<body>
    <div class="vertical-split">

        <?php require_once __DIR__ . "/components/menu.php" ?>
        
        <div class="horizontal-split">
            <nav class="leftPanel">
                <div class="vertical-split">
                    <div class="crop">
                        <img alt="profile pic" src=/public/images/<?= $volunteer -> pic?> >
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
                    <div class="collapsible-container">
                        <div class="collapsible-btn">Detalii personale</div>
                        <img alt="drodpown-btn" class="dropdown-btn svg-white" src="/public/images/arrow_drop_down_circle-24px.svg">
                    </div>
                    <div class="collapsible-content">
                        <table>
                            <?php 
                                foreach($volunteer -> personalDetails as $key => $detail) {
                                    if (strpos($key, '_ignore_') === false) {
                                    echo "<tr>
                                        <th style='white-space:nowrap'>
                                            " . str_replace('_noedit_', '', $key) . "
                                        </th>
                                        <td "; if (strpos($key, '_noedit_') !== false) echo " contenteditable='true'"; echo ">
                                            " . $detail . ' ' . "
                                        </td>
                                    </tr>";}
                                };
                            ?>
                        </table>
                    </div>
                </div>
                <div class="info-table">
                    <div class="collapsible-container">
                        <div class="collapsible-btn">Aptitudini</div>
                        <img alt="drodpown-btn" class="dropdown-btn svg-white" src="/public/images/arrow_drop_down_circle-24px.svg" >
                    </div>
                    <div class="collapsible-content">
                        <div class="under-construction">Under construction</div>
                    </div>
                </div>
                <div class="info-table">
                    <div class="collapsible-container">
                        <div class="collapsible-btn">Interese</div>
                        <img alt="drodpown-btn" class="dropdown-btn svg-white" src="/public/images/arrow_drop_down_circle-24px.svg" >
                    </div>
                    <div class="collapsible-content">
                        <div class="under-construction">Under construction</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>initCollapsible();initMenu()</script>
</body>

</html>