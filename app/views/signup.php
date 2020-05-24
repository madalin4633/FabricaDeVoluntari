<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="/public/styles/menu.css">
    <!-- <link rel="stylesheet" type="text/css" href="/public/styles/signup_voluntar.css"> -->
    <link rel="stylesheet" type="text/css" href="/public/styles/auth_style.css">
    <title>Register</title>
    <script src="/public/javascript/tabs.js"></script>
    <script src="/public/javascript/menu.js" ></script>
</head>

<body>
    <!-- <div class="user-notifications">
        <?= $GLOBALS['user-notifications']->showNotifications(); ?>
    </div> -->
    <!-- <p id="aventura">Aventura ta in Fabrica de Voluntari incepe acum. Alege tipul de cont. Completeaza campurile de mai jos, apoi vei
        putea explora oportunitati nelimitate.</p> -->
    <!-- <img src="/public/images/fabrica_logo.png" alt="FDV logo" id="fdv"> <br/> -->
    <div>
            <button class="btn_switch" id="accout-type" onclick="switch_register_account_type(event, 'voluntar_account', 'asociation_account')">Cont de voluntar</button>
            <button class="btn_switch" id="accout-type" onclick="switch_register_account_type(event, 'asociation_accout', 'voluntar_account')">Cont de asociatie</button>
        </div>
    
    <div class="container" id="register_page" style="grid-template-columns: repeat(1, 1fr);">
        
        <div id="voluntar_account" class = "tab_content" style="display: flex;">
            <div class = "login-content">
                <form method="POST" action="/user/register">
                    <br/>
                    <img class="avatar" src="/public/images/fabrica_logo.png" alt="logo">
                    
                    <br/>

                    <div class="form__group">
                        <input type="text" class="form__input" name="name" placeholder="Nume" required="" />
                    </div>

                    <div class="form__group">
                        <input type="text" class="form__input" name="surname" placeholder="Prenume" required="" />
                    </div>

                    <div class="form__group">
                        <input type="date" class="form__input" name="birthday" value="1999-01-17" min="1995-01-01," max="2005-01-01" />
                    </div>

                    <div class="form__group">
                        <input type="text" class="form__input" name="phone" placeholder="Telefon" required="" />
                    </div>

                    <div class="form__group">
                        <input type="text" class="form__input" name="email" placeholder="Email" required="" />
                    </div>
                    
                    <div class="form__group">
                        <SELECT class="form__input" name="gender">

                            <OPTION Value="feminin">Feminin</OPTION>
                            <OPTION Value="masculin">Masculin</OPTION>
                        
                        </SELECT>
                    </div>

                    <div class="form__group">
                        <SELECT class="form__input" name="status">

                            <OPTION Value="elev">Elev</OPTION>
                            <OPTION Value="student">Student</OPTION>
                            <OPTION Value="angajat">Angajat</OPTION>

                        </SELECT>
                    </div>

                    <div class="form__group">
                        <input type="text" class="form__input" name="institution" placeholder="Liceu/Facultate" required="" />
                    </div>

                    <div class="form__group">
                        <input type="password" class="form__input" name="password" placeholder="Parola" required="" />
                    </div>
                    
                    <div class="form__group">
                        <input type="password" class="form__input" name="confirm_password" placeholder="Confirmare parola" required="" />
                    </div>


                    <!-- <div>
                        <label for="motivatie">De ce vrei sa te inscrii?</label><br/>
                        <textarea required id="motivatie" name="motivation"></textarea>
                    </div> -->

                    <!-- <div class="form__group">
                        <input type="text" class="form__input" name="motivation" placeholder="De ce vrei sa te inscrii?" required="" />
                    </div> -->
                    
                    <!-- <div>
                        <img src="/public/images/fb.png" alt="Facebook logo" id="logo"><br/>
                        <input required type="url" id="retea" name="fb_link" placeholder="Link Fb. tau/alta retea"/>
                    </div> -->

                    <div class="form__group">
                        <input type="text" class="form__input" name="fb_link" placeholder="Facebook link" required="" />
                    </div>

                    <!-- <label>
                        <span>👆Incarca o imagine de profil👆</span> <br />
                        <input required type="file" hidden name="photo" />
                    </label> -->
                    <br/>
                    <div>
                        <label> Acord de prelucare a datelor personale: </label> <br />
                        <p id="GDPR">Sunt de acord cu privire la protecția datelor cu caracter personal conform Regulamentului (UE)
                            2016/679 aplicabil din 25 mai 2018: datele din formular vor fi prelucrate de catre moderatori in
                            scopul informarii cu privire la activitatea curenta. Sunt de acord sa fiu fotografiat(a) si
                            filmat(a) in timpul acțiunilor si ca aceste materiale sa fie publicate, pentru promovarea si
                            diseminarea rezultatelor, fara a afecta, insa, imaginea mea (cu exceptia cazurilor justificate,
                            in care voi solicita expres sa nu apar in aceste materiale). Sunt de acord să fiu contactat(a)
                            prin e-mail sau telefon de catre asociatii in scopul inscrierii in ele.</p>
                        <label for="da"> Esti de acord? </label><br/>
                        <label>Da</label>
                        <input type="radio" id="da" name="accord" value="yes"/>
                        <br/>
                        <label>Nu</label>
                        <input type="radio" id="da" name="accord" value="no" checked="checked"/>
                    </div>
                    <button type="submit" class="btn">Creare cont</button>
                    <a href="http://localhost:8888/user/register" id="reg_link"><button type="button" class="btn">Inapoi</button></a>
                </form>
            </div>
        </div>
        
        <div id="asociation_accout" class = "tab_content" style="display: none">
            <div class = "login-content">
                <form method="POST" action="/user/register_asociatie">
                        
                    <br/>
                    <img class="avatar" src="/public/images/fabrica_logo.png" alt="logo">
                    
                    <br/>
                    
                    <!-- <div>
                        <input required type="text" id="numeAsociatie" name="numeAsociatie" placeholder="Nume Asociatie/Fundatie"/>
                    </div> -->

                    <div class="form__group">
                        <input type="text" class="form__input" name="as_name" placeholder="Nume asociatie/fundatie" required="" />
                    </div>

                    <!-- <div>
                        <input required type="text" id="numePrenume" name="numePrenume" placeholder="Reprezentant legal"/>
                    </div> -->

                    <div class="form__group">
                        <input type="text" class="form__input" name="owner" placeholder="Reprezentant legal" required="" />
                    </div>
                    
                    <!-- <div>
                        <input required type="text" id="registru" name="registru" placeholder="Nr. in reg. asociatii"/>
                    </div> -->
                    
                    <div class="form__group">
                        <input type="text" class="form__input" name="registrery" placeholder="Nr. in reg. asociatii" required="" />
                    </div>

                    <!-- <div>
                        <label for="infiintare">Data infiintare:</label><br />
                        <input type="date" id="data-infiintare" name="data-infiintare" value="1999-06-10" min="1995-01-01," max="2005-01-01">
                    </div> -->
                    
                    <div class="form__group">
                        <label for="infiintare">Data infiintare</label><br />
                        <input type="date" class="form__input" name="birthday" value="1999-06-10" min="1995-01-01," max="2005-01-01" />
                    </div>

                    <!-- <div>
                        <input required type="text" id="numartelefon" name="numartelefon" placeholder="Numar de telefon"/>
                    </div> -->

                    <div class="form__group">
                        <input type="text" class="form__input" name="phone" placeholder="Telefon" required="" />
                    </div>
                    
                    <!-- <div>
                        <input required type="email" id="email" name="email" placeholder="Email"/>
                    </div> -->

                    <div class="form__group">
                        <input type="text" class="form__input" name="email" placeholder="Email" required="" />
                    </div>

                    <div class="form__group">
                        <input type="password" class="form__input" name="password" placeholder="Parola" required="" />
                    </div>
                    
                    <div class="form__group">
                        <input type="password" class="form__input" name="confirm_password" placeholder="Confirmare parola" required="" />
                    </div>
                    
                    <!-- <div>
                        <label for="motivatie">De ce vreti sa va inscrieti?</label><br/>
                        <textarea required id="motivatie" name="motivatie"></textarea>
                    </div> -->

                    
                    
                    <!-- <div>
                        <img src="/public/images/fb.png" alt="Facebook logo" id="logo"><br/>
                        <input required type="url" id="retea" name="retea" placeholder="Link Fb. ONG/alta retea"/>
                    </div> -->
                    <div class="form__group">
                        <input type="text" class="form__input" name="fb_link" placeholder="Link facebook ONG" required="" />
                    </div>
                    
                    <!-- <label>
                        <span>👆Incarca o imagine de profil👆</span> <br />
                        <input required type="file" hidden name="photo" />
                    </label> -->
                    
                    <br/>
                    <div>
                        <label> Acord de prelucare a datelor personale: </label> <br />
                        <p id="GDPR">Sunt de acord cu privire la protecția datelor cu caracter personal conform Regulamentului (UE)
                            2016/679 aplicabil din 25 mai 2018: datele din formular vor fi prelucrate de catre moderatori in
                            scopul informarii cu privire la activitatea curenta. Sunt de acord sa fiu fotografiat(a) si
                            filmat(a) in timpul acțiunilor si ca aceste materiale sa fie publicate, pentru promovarea si
                            diseminarea rezultatelor, fara a afecta, insa, imaginea mea (cu exceptia cazurilor justificate,
                            in care voi solicita expres sa nu apar in aceste materiale). Sunt de acord să fiu contactat(a)
                            prin e-mail sau telefon de catre asociatii in scopul inscrierii in ele.</p>
                        <<label for="da"> Esti de acord? </><br/>
                        <label>Da</label>
                        <input type="radio" id="da" name="accord" value="yes"/>
                        <br/>
                        <label>Nu</label>
                        <input type="radio" id="da" name="accord" value="no" checked="checked"/>
                    </div>
                    <button type="submit" class="btn">Creare cont</button>
                    <a href="http://localhost:8888/user/register" id="back_link"><button type="button" class="btn">Inapoi</button></a>
                </form>
            </div>
        </div>

    </div>
    

    <script>
        initMenu();
    </script>
</body>

</html>