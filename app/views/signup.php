<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="/public/styles/commons.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/menu.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/signup_voluntar.css">
    <title>Signup FDV</title>
    <script src="/public/javascript/tabs.js"></script>
    <script src="/public/javascript/menu.js" ></script>
</head>

<body>
    <div class="user-notifications">
        <?= $GLOBALS['user-notifications']->showNotifications(); ?>
    </div>
    <p id="aventura">Aventura ta in Fabrica de Voluntari incepe acum. Alege tipul de cont. Completeaza campurile de mai jos, apoi vei
        putea explora oportunitati nelimitate.</p>
    <img src="/public/images/fabrica_logo.png" alt="FDV logo" id="fdv"> <br/>
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'voluntar')">Cont de voluntar</button>
        <button class="tablinks" onclick="openCity(event, 'asociatie')">Cont de asociatie</button>
    </div>
    <div id="voluntar" class="tabcontent" style="display: block;">
        <div class="plate">
            <form method="POST" action="/signup_page.php">
                <div>
                    <input required type="text" id="nume" name="nume" placeholder="Nume"/>
                </div>
                <br />
                <div>
                    <input required type="text" id="prenume" name="prenume" placeholder="Prenume"/>
                </div>
                <br />
                <div>
                    <label for="nastere">Data nasterii:</label><br />
                    <input type="date" id="nastere" name="data-nastere" value="1999-06-10" min="1995-01-01," max="2005-01-01">
                </div>
                <br />
                <div>
                    <input required type="text" id="numartelefon" name="numartelefon" placeholder="Numar de telefon"/>
                </div>
                <br />
                <div>
                    <input required type="email" id="email" name="email" placeholder="Email"/>
                </div>
                <br />
                <div>
                    <label> Gen: </label> <br />
                    <label for="masculin"> Masculin</label>
                    <input type="radio" id="masculin" name="gen" />

                    <label for="feminin"> Feminin</label>
                    <input type="radio" id="feminin" name="gen" />
                </div>
                <br />
                <div>
                    <label> Ocupatie: </label> <br />
                    <label for="elev"> Elev</label>
                    <input type="radio" id="elev" name="ocupatie" />
                </br>
                    <label for="student"> Student</label>
                    <input type="radio" id="student" name="ocupatie" />
                </br>
                    <label for="student"> Angajat</label>
                    <input type="radio" id="angajat" name="ocupatie" />
                </div>
                <br />
                <div>
                    <input required type="text" id="institutie" name="institutie" placeholder="Liceul/facultatea"/>
                </div>
                <br />
                <div>
                    <label for="motivatie">De ce vrei sa te inscrii?</label><br/>
                    <textarea required id="motivatie" name="motivatie"></textarea>
                </div>
                <br />
                <div>
                    <img src="/public/images/fb.png" alt="Facebook logo" id="logo"><br/>
                    <input required type="url" id="retea" name="retea" placeholder="Link Fb. tau/alta retea"/>
                </div>
                <br />
                <label>
                    <span>👆Incarca o imagine de profil👆</span> <br />
                    <input required type="file" hidden name="photo" />
                </label>
                <br />
                <div>
                    <label> Acord de prelucare a datelor personale: </label> <br />
                    <p id="GDPR">Sunt de acord cu privire la protecția datelor cu caracter personal conform Regulamentului (UE)
                        2016/679 aplicabil din 25 mai 2018: datele din formular vor fi prelucrate de catre moderatori in
                        scopul informarii cu privire la activitatea curenta. Sunt de acord sa fiu fotografiat(a) si
                        filmat(a) in timpul acțiunilor si ca aceste materiale sa fie publicate, pentru promovarea si
                        diseminarea rezultatelor, fara a afecta, insa, imaginea mea (cu exceptia cazurilor justificate,
                        in care voi solicita expres sa nu apar in aceste materiale). Sunt de acord să fiu contactat(a)
                        prin e-mail sau telefon de catre asociatii in scopul inscrierii in ele.</p>
                    <label for="da"> De acord: </label>
                    <input type="radio" id="da" name="acord" />
                </div>
                <button type="submit" class="btn">Creare cont</button>
            </form>
        </div>
    </div>

    <div id="asociatie" class="tabcontent" style="display: none;">
        <div class="plate">
            <form method="POST" action="/signup_page.php">
                <div>
                    <input required type="text" id="numeAsociatie" name="numeAsociatie" placeholder="Nume Asociatie/Fundatie"/>
                </div>
                <br />
                <div>
                    <input required type="text" id="numePrenume" name="numePrenume" placeholder="Reprezentant legal"/>
                </div>
                <br />
                <div>
                    <input required type="text" id="registru" name="registru" placeholder="Nr. in reg. asociatii"/>
                </div>
                <br />
                <div>
                    <label for="infiintare">Data infiintare:</label><br />
                    <input type="date" id="data-infiintare" name="data-infiintare" value="1999-06-10" min="1995-01-01," max="2005-01-01">
                </div>
                <br />
                <div>
                    <input required type="text" id="numartelefon" name="numartelefon" placeholder="Numar de telefon"/>
                </div>
                <br />
                <div>
                    <input required type="email" id="email" name="email" placeholder="Email"/>
                </div>
                <br />
                <div>
                    <label for="motivatie">De ce vreti sa va inscrieti?</label><br/>
                    <textarea required id="motivatie" name="motivatie"></textarea>
                </div>
                <br />
                <div>
                    <img src="/public/images/fb.png" alt="Facebook logo" id="logo"><br/>
                    <input required type="url" id="retea" name="retea" placeholder="Link Fb. ONG/alta retea"/>
                </div>
                <br />
                <label>
                    <span>👆Incarca o imagine de profil👆</span> <br />
                    <input required type="file" hidden name="photo" />
                </label>
                <br />
                <div>
                    <label> Acord de prelucare a datelor personale: </label> <br />
                    <p id="GDPR">Sunt de acord cu privire la protecția datelor cu caracter personal conform Regulamentului (UE)
                        2016/679 aplicabil din 25 mai 2018: datele din formular vor fi prelucrate de catre moderatori in
                        scopul informarii cu privire la activitatea curenta. Sunt de acord sa fiu fotografiat(a) si
                        filmat(a) in timpul acțiunilor si ca aceste materiale sa fie publicate, pentru promovarea si
                        diseminarea rezultatelor, fara a afecta, insa, imaginea mea (cu exceptia cazurilor justificate,
                        in care voi solicita expres sa nu apar in aceste materiale). Sunt de acord să fiu contactat(a)
                        prin e-mail sau telefon de catre asociatii in scopul inscrierii in ele.</p>
                    <label for="da"> De acord: </label>
                    <input type="radio" id="da" name="acord" />
                </div>
                <button type="submit" class="btn">Creare cont</button>
            </form>
        </div>
    </div>


    <script>
        initMenu();
    </script>
</body>

</html>