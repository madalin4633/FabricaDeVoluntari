<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="userprofile.css" />
    <title>Document</title>
</head>

<body>
    <section class="vertical-split">
        <section class="banner">
            <img src="img/dimitar-belchev-TQZ7OqSEG6Q-unsplash.jpg" alt="banner">
        </section>
        <section class="top-menu">
            <div>menu 1</div>
            <div>menu 2</div>
        </section>
        <section class="horizontal-split">
            <nav class="leftPanel">
                <div class="vertical-split">
                    <div class="crop">
                        <img alt="profile pic" src="img/joshua-reddekopp-rTpR03TCFGQ-unsplash.jpg">
                    </div>
                    <div id="full-name">
                        User name
                    </div>
                </div>

                <div>
                    poza
                </div>
                <div>
                    detalii personale
                </div>
                <div>
                    lista aptitudini
                </div>
                <div class="myclass">
                    lista interese
                </div>
                <div>
                    badge-uri
                </div>
                <div>
                    Feedback
                </div>
            </nav>

            <div class="left_menu">
                <ul>
                    <li>info 1</li>
                    <li>info 2</li>
                    <li>
                    <?php
                    echo "hello PHP";
                    ?></li>
                </ul>
            </div>

        </section>
    </section>
</body>

</html>