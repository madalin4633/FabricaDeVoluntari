<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Scholarly HTML</title>
    <link rel="stylesheet" href="https://w3c.github.io/scholarly-html/css/scholarly.min.css">
    <script src="https://w3c.github.io/scholarly-html/js/scholarly.min.js"></script>
</head>
<body prefix="schema: http://schema.org">
<header>
      <div class="banner">
        <img src="/../../public/images/fdv_logo.png" width="227" height="50" alt="FdV logo">
      </div>
      <h1>Scholarly HTML</h1>
    </header>

    <div role="contentinfo">
      <dl>
        <dt>Autori</dt>
        <dd>
          Florea Madalin, Bejan Valeriu
          &amp;
          Dobre Dani
        </dd>
        <dt>Licenta</dt>
        <dd>
          <a href="https://opensource.org/licenses/MIT">MIT Licence</a>
        </dd>
      </dl>
    </div>
    <section typeof="sa:Abstract" id="abstract" role="doc-abstract">
      <h2>Abstract</h2>
      <p>
        Proiectul <b>Fabrica de Voluntari</b> 
        este o aplicatie Web cu API REST propriu care permite asociatiilor de voluntari sa-si gestioneze activitatea.
      </p>
    </section>
    <section id="introduction" role="doc-introduction">
      <h2>Introduction </h2>
      <p style='color:red; font-size:60px;'>
        
      Madalin, baga mare!
      </p>
    </section>
    
    <section id="model">
        <h2>Modelul de functionare <i>Fabrica de Voluntari</i></h2>
        <p style='color:red;'>
            Descrie cum functioneaza asociatia FdV si celelalte asociatii inregistrate, voluntari, proiecte, taskuri, etc. (ce se leaga de aplicatia noastra). 
            Ar fi un prilej bun sa bagi meta data la <a href="https://w3c.github.io/scholarly-html/#person-org">persons si organisations</a>
</p>
    </section>

    <section id="structure">
      <h2>Structura aplicatiei</h2>
      <p>
        Am optat pentru arhitectura <a href="https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller">MVC</a> implementata in backend cu PHP, iar pentru frontend am folosit JavaScript, inclusiv tehnologia <a href="https://en.wikipedia.org/wiki/Ajax_(programming)">AJAX</a>.
        Fisierele resursa (media, .js si .css) sunt stocate intr-un director <i>public</i>, separat de directorul aplicatiei <i>app</i>. In directorul radacina avem fisierul <a href="http://www.htaccess-guide.com/">.htaccess</a>, un fisier de configuratie pentru serverul Apache care redirecteaza toate <a href="https://www.w3schools.com/tags/ref_httpmethods.asp">cererile HTTP</a> catre API REST, daca ruta contine /api/... , catre controller cand acesta exista sau catre o pagina de erroare <a href="https://en.wikipedia.org/wiki/List_of_HTTP_status_codes">404 Not Found</a>, altfel.
      </p>
      <p>
        Baza de date ruleaza in cloud pe <a href="https://www.heroku.com/">Heroku</a>. Am ales <i>Heroku Postgres</i> pe un plan gratuit <i>Hobby Dev</i> pentru a facilita dezvoltarea aplicatiei in sistem distribuit, la distanta, prin intermediul platformei <a href="https://github.com/">Git</a>. Accesul la baza de date s-a realizat prin intermediul aplicatiei pgAdmin, iar aplicatia FdV a rulat local pe un server XAMPP.
        </p>
      <section id="MVC">
        <!-- review? -->
        <h3>Arhitectura MVC</h3>
        <p>
          
        </p>
        
      </section>
        <section id="database">
        <h3>Baza de date</h3>
        <p>
        Logica de business ne-a condus la o schema relationala complexa cu 5 entitati si 3 relatii de asociere. Tabela tblAssociations reprezinta piesa centrala in schema bazei de date. Cu ajutorul relatiei de asociere many-to-many tblVolAssoc se stocheaza apartenenta voluntarilor in asociatii. In cadrul unei asociatii pot exista proiecte fara niciun task, si task-uri fara niciun voluntar asignat, astfel ca tblProjects este in relatie one-to-many cu tblAsociations, iar tblTasks este in relatie one-to-many cu tblProjects. Asignarea voluntarului la un task se stocheaza in relatia de asociere tblActivity. tblCertifications retine linkul spre folderul Google Drive atribuit de asociatie unui voluntar pentru a primi adeverinte, de aceea tblCertifications este in relatie cu tabela tblVolAssoc in loc de tblAssociations sau tblVolunteers.
        </p>
          <img alt='schema relationala' src='/../../public/images/FdV-DB-ER-model.png'/>
          <p>
              Toate scripturile de creare a tabelelor si a (SQL) VIEW-urilor le-am scris in models/generateFillTables, fiecare in fisiere bine delimitate, usor de gestionat. Aceste scripturi sunt rulate printr-un api call la una din rutele:
              <ul>
                  <li><code> POST /api/createTables/</code> pentru a crea tabelele</li>
        </ul>
        </p>
        </section>
        </section>

<section id='resurse'>
    <h2>Resurse folosite la implementare</h2>
<p>
<a href="https://www.w3schools.com/howto/howto_js_collapsible.asp">Panou collapsible cu JavaScript</a> <br>
<a href="https://www.w3schools.com/css/css_tooltip.asp">Tooltip formatat cu CSS si JavaScript</a> <br>
<a href="https://medium.com/allenhwkim/close-div-when-clicking-outside-it-97255c20a221">Inchide un panou float cand dai click in exterior</a> <br>
<a href="https://css-tricks.com/star-ratings/">Stelute pentru recenzii doar cu CSS</a> <br>
<a href="https://www.w3schools.com/cssref/css3_pr_mediaquery.asp">CSS @media Rule</a> <br>
<a href="https://tobiasahlin.com/spinkit/">Spinner cu CSS</a> <br>
<a href="https://www.enterprisedb.com/postgres-tutorials/everything-you-need-know-about-postgresql-triggers">Trigger in postgres</a> <br>
<a href="https://www.the-art-of-web.com/sql/trigger-update-timestamp/">Update timestamp with postgres triggers</a> <br>


<a href="http://thecodinglove.com/post/95378251969/when-code-works-and-i-dont-know-why">Intreaba-l pe Valeriu</a> <br>
<a href="http://www.pelagodesign.com/blog/2009/05/20/iso-8601-date-validation-that-doesnt-suck/">Intreaba-l pe Valeriu</a> <br>
<a href="https://tools.ietf.org/html/rfc7230#section-3.1.2">Intreaba-l pe Madalin</a> <br>
<a href="https://www.youtube.com/watch?v=cpHCv3gbPuk">Intreaba-l pe Madalin</a> <br>
<a href="https://stackoverflow.com/questions/22084698/how-to-export-source-content-within-div-to-text-html-file">Intreaba-l pe Madalin</a> <br>
<a href="https://developers.facebook.com/docs/graph-api/making-multiple-requests#limits">Intrebati-va unul pe celalalt ce reprezinta linkurile astea</a> <br>
<a href="https://developers.facebook.com/docs/facebook-login/access-tokens#long-via-code">Intrebati-va unul pe celalalt ce reprezinta linkurile astea</a> <br>
<a href="http://www.cl.cam.ac.uk/~mgk25/iso-time.html">Intrebati-va unul pe celalalt ce reprezinta linkurile astea</a> <br>
        </p>
        </section>
        
</body>
</html>