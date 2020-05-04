

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/styles/commons.css" />
    <link rel="stylesheet" type="text/css" href="../../public/styles/tooltip.css" />
    <link rel="stylesheet" type="text/css" href="../../public/styles/userprofile.css" />
    <link rel="stylesheet" type="text/css" href="../../public/styles/collapsible.css" />
    <title>Document</title>
    <script src="../../public/javascript/userprofile.js">
    </script>
</head>

<body>
    <section class="vertical-split">

        <section class="top-menu">
            <div>menu 1</div>
            <div>menu 2</div>
        </section>
        <section class="horizontal-split">
            <nav class="leftPanel">
                <div class="vertical-split">
                    <div class="crop">
                        <img alt="profile pic" src="../../public/images/joshua-reddekopp-rTpR03TCFGQ-unsplash.jpg">
                    </div>
                    <div id="full-name">
                        User name
                    </div>
                </div>
                <div>
                    lista aptitudini
                </div>
                <div>
                    lista interese
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
                        <img class="dropdown-btn svg-white" src="../../public/images/arrow_drop_down_circle-24px.svg">
                    </button>
                    <div class="collapsible-content">
                        <table>
                            <tr>
                                <th>Nume</th>
                                <td>Duck</td>
                            </tr>
                            <tr>
                                <th>Prenume</th>
                                <td>Donald</td>
                            </tr>
                            <tr>
                                <th>Varsta</th>
                                <td>70</td>
                            </tr>
                            <tr>
                                <th>E-mail</th>
                                <td>donald@duck.com</td>
                            </tr>
                            <tr>
                                <th nowrap>Data inscriere</th>
                                <td>martie 2020</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="info-table">
                    <button class="collapsible-container active">
                        <div class="collapsible-btn">Asociatii</div>
                        <img class="dropdown-btn svg-white" src="../../public/images/arrow_drop_down_circle-24px.svg">
                    </button>
                    <div class="collapsible-content" style="max-height: fit-content;">
                        <table class="tabel-asociatii">
                            <tr>
                                <td>
                                    <div id="asoc-logo-1" class="asoc-logo">
                                    </div>
                                </td>
                                <td>
                                    <div class="progress-asociatie">
                                        <div class="tooltip"><span class="tooltiptext">Ore lucrate</span><img class="svg-white"  src="../../public/images/query_builder-24px.svg">
                                            <span class="ore-lucrate">205</span></div>
                                        <div class="tooltip"><span class="tooltiptext">Aprecieri</span><img class="svg-red" src="../../public/images/favorite-24px.svg">
                                            <span class="aprecieri">74</span></div>
                                        <div class="nowrap svg-yellow pack-tight">
                                            <img src="../../public/images/star-24px.svg">
                                            <img src="../../public/images/star-24px.svg">
                                            <img src="../../public/images/star-24px.svg">
                                            <img src="../../public/images/star_half-24px.svg">
                                            <img src="../../public/images/star_border-24px.svg">
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div id="asoc-logo-2" class="asoc-logo">
                                    </div>
                                </td>
                                <td>
                                    <div class="progress-asociatie">
                                        <div class="tooltip"><span class="tooltiptext">Ore lucrate</span><img class="svg-white" src="../../public/images/query_builder-24px.svg">
                                            <span class="ore-lucrate">870</span></div>
                                        <div class="tooltip"><span class="tooltiptext">Aprecieri</span><img class="svg-red" src="../../public/images/favorite-24px.svg">
                                            <span class="aprecieri">215</span></div>
                                        <div class="nowrap svg-yellow pack-tight">
                                            <img src="../../public/images/star-24px.svg">
                                            <img src="../../public/images/star-24px.svg">
                                            <img src="../../public/images/star-24px.svg">
                                            <img src="../../public/images/star-24px.svg">
                                            <img src="../../public/images/star_half-24px.svg">
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div id="asoc-logo-3" class="asoc-logo">
                                    </div>
                                </td>
                                <td>
                                    <div class="progress-asociatie">
                                        <div class="tooltip"><span class="tooltiptext">Ore lucrate</span><img class="svg-white"  src="../../public/images/query_builder-24px.svg">
                                            <span class="ore-lucrate">65</span></div>
                                        <div class="tooltip"><span class="tooltiptext">Aprecieri</span><img class="svg-red" src="../../public/images/favorite-24px.svg">
                                            <span class="aprecieri">4</span></div>
                                        <div class="nowrap svg-yellow pack-tight">
                                            <img src="../../public/images/star-24px.svg">
                                            <img src="../../public/images/star-24px.svg">
                                            <img src="../../public/images/star_half-24px.svg">
                                            <img src="../../public/images/star_border-24px.svg">
                                            <img src="../../public/images/star_border-24px.svg">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <ul>
                    <li id="customli" onmouseover="showSomething('!!')">
                        hover mouse over me
                    </li>
                </ul>
            </div>

        </section>
    </section>

    <script>initCollapsible();</script>
</body>

</html>