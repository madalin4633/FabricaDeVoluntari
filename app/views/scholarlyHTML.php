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
      <h1>Raport Scholarly HTML - Fabrica de Voluntari</h1>
</header>

    <div role="contentinfo">
    <section typeof="sa:ProjectLinks">
			<ul>
				<li typeof="schema:WebPage" role="link" resource="https://github.com/madalin4633/FabricaDeVoluntari"
					property="schema:citation" id="github">
					<cite property="schema:name">
						<a href="https://github.com/madalin4633/FabricaDeVoluntari">Github</a>
					</cite>
				</li>
				<li typeof="schema:WebPage" role="link" resource="https://app.swaggerhub.com/apis/FabricaDeVoluntari/Fabrica-de-Voluntari/1.0.0"
					property="schema:citation" id="github">
					<cite property="schema:name">
						<a href="https://app.swaggerhub.com/apis/FabricaDeVoluntari/Fabrica-de-Voluntari/1.0.0">Swagger</a>
					</cite>
				</li>
			</ul>
		</section>

    <section typeof="sa:AuthorsList">
			<h2>Autori</h2>
			<ul>
				<li typeof="sa:ContributorRole" property="schema:author">
					<span typeof="schema:Person">
						<meta property="schema:givenName" content="Madalin">
						<meta property="schema:familyName" content="Florea">
						<span property="schema:name">Madalin Florea</span>
					</span>
				</li>
				<li typeof="sa:ContributorRole" property="schema:author">
					<span typeof="schema:Person">
						<meta property="schema:givenName" content="Valeriu">
						<meta property="schema:familyName" content="Bejan">
						<span property="schema:name">Bejan Valeriu</span>
					</span>
				</li>
				<li typeof="sa:ContributorRole" property="schema:author">
					<span typeof="schema:Person">
						<meta property="schema:givenName" content="Dani">
						<meta property="schema:familyName" content="Dobre">
						<span property="schema:name">Dobre Dani</span>
					</span>
				</li>
			</ul>
		</section>

      <dl>
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
        este o <i>aplicatie Web cu API REST</i> propriu care permite asociatiilor de voluntari sa-si gestioneze activitatea. Mai exact, sa managerieze proiectele pe care le au si task-urile din cadrul acestora, avand toate informatiile reunite intr-un singur loc.
      </p>
    </section>
    <section id="introduction" role="doc-introduction">
      <h2>Introducere</h2>
      <p>
      Ideea <b> Fabrica de Voluntari </b> porneste de la sectia de voluntariat a Casei de Cultura a Studentilor Iasi. Multiple asociatii si ligi studentesti cauta ajutor in aceasta institutie, insa, pe drum, odata ce numarul voluntarilor creste, informatia se pierde, iar responsabilitatea se deleaga la nesfarsit. Prin urmare, este nevoie ca odata inceput un proiect cu o echipa prestabilita de oameni, task-urile care sunt de facut sa fie impartit exact, iar efortul depus sa fie contorizat. Astfel, a luat nastere aplicatia Fabrica de Voluntari, ce permite atat managerierea proiectelor si task-urilor, cat si monitorizarea datelor despre implicare si munca depusa, tocmai pentru a rasplati eforturile oamenilor implicati si valorosi din organizatii.
      </p>
    </section>
    
    <section id="model">
        <h2>Modelul de functionare <i>Fabrica de Voluntari</i></h2>
        <p>
            Exista 2 tipuri de conturi ce pot fi create pe aplicatia noastra - de asociatie si de voluntar. In linii mari, asociatia creeaza proiecte si task-uri, iar voluntarul intra in asociatii, vede proiecte si task-uri si le preia pentru a se ocupa de ele. Odata finalizate, se marcheaza acest lucru si se poate oferi feedback reciproc, lasand loc de o continua dezvoltare.
        </p>
        <p> Exemplu de voluntar si datele sale:
        <span typeof="schema:Person" resource="https://www.facebook.com/bader.maria.5">
        <meta property="schema:givenName" content="Bader">
        <meta property="schema:familyName" content="Jouda">
        <a href="https://www.facebook.com/bader.maria.5">
        <span property="schema:name">Jouda Bader</span>
        </p>
        <p> Exemplu de organizatie si datele sale:
        <span typeof="schema:Organization" resource="https://www.facebook.com/asociatiamoldavia">
          <a href="https://www.faceebok.com/asociatiamoldavia">
            <span property="schema:name">Asociatia Moldavia</span>
          </a>
          (<span property="schema:location" typeof="schema:Place">
          <span property="schema:address" typeof="schema:PostalAddress">
          <span property="schema:addressLocality">Str. Arcu, nr. 5</span>,
          <span property="schema:addressRegion">MD</span>,
          <span property="schema:addressCountry">RO</span>
          </span>
          </span>)
        </span>
        </p>
  </a>
</span>
    </section>

    <section id="structure">
      <h2>Structura aplicatiei</h2>
      <p>
        Am optat pentru arhitectura <a href="https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller">MVC</a> implementata in backend cu PHP, iar pentru frontend am folosit JavaScript, inclusiv tehnologia <a href="https://en.wikipedia.org/wiki/Ajax_(programming)">AJAX</a>.
        Fisierele resursa (media, .js si .css) sunt stocate intr-un director <i>public</i>, separat de directorul aplicatiei <i>app</i>. In directorul radacina avem fisierul <a href="http://www.htaccess-guide.com/">.htaccess</a>, un fisier de configuratie pentru serverul Apache care redirecteaza toate <a href="https://www.w3schools.com/tags/ref_httpmethods.asp">cererile HTTP</a> catre API REST, daca ruta contine /api/... , catre controller cand acesta exista sau catre o pagina de erroare <a href="https://en.wikipedia.org/wiki/List_of_HTTP_status_codes">404 Not Found</a>, altfel.
      </p>
      <figure typeof="sa:image">
				<img src="/../../public/images/MVC.png">
				<figcaption>Fig.1 - Structura MVC a fisierelor</figcaption>
			</figure>
      <p>
        Baza de date ruleaza in cloud pe <a href="https://www.heroku.com/">Heroku</a>. Am ales <i>Heroku Postgres</i> pe un plan gratuit <i>Hobby Dev</i> pentru a facilita dezvoltarea aplicatiei in sistem distribuit, la distanta, prin intermediul platformei <a href="https://github.com/">Git</a>. Accesul la baza de date s-a realizat prin intermediul aplicatiei pgAdmin, iar aplicatia FdV a rulat local pe un server XAMPP.
        </p>
      <section id="MVC">
        <!-- review? -->
        <h3>Arhitectura MVC</h3>
        <p>
          MVC (Model - View - Controller) este un model de arhitectura utilizat in ingineria software, pe care l-am abordat si noi. Succesul modelului se datoreaza izolarii partii logice (business) de consideratele interfete cu utilizatorul, rezultand o aplicatie unde aspectul vizual sau/si nivelele inferioare ale regulilor de business sunt mai suor de modificat, fara a afeca alte nivele. Astfel, reprezentarea informatiilor din interactiunea cu utilizatorul sunt separate de informatiile in sine.
        </p>
        
      </section>
        <section id="database">
        <h3>Baza de date</h3>
        <p>
        Logica de business ne-a condus la o schema relationala complexa cu 5 entitati si 3 relatii de asociere. Tabela tblAssociations reprezinta piesa centrala in schema bazei de date. Cu ajutorul relatiei de asociere many-to-many tblVolAssoc se stocheaza apartenenta voluntarilor in asociatii. In cadrul unei asociatii pot exista proiecte fara niciun task, si task-uri fara niciun voluntar asignat, astfel ca tblProjects este in relatie one-to-many cu tblAsociations, iar tblTasks este in relatie one-to-many cu tblProjects. Asignarea voluntarului la un task se stocheaza in relatia de asociere tblActivity. tblCertifications retine linkul spre folderul Google Drive atribuit de asociatie unui voluntar pentru a primi adeverinte, de aceea tblCertifications este in relatie cu tabela tblVolAssoc in loc de tblAssociations sau tblVolunteers.
        </p>
          <img alt='schema relationala' src='/../../public/images/FdV-DB-ER-model.png'/>
          <p>
              Toate scripturile de creare a tabelelor si a (SQL) VIEW-urilor le-am scris in <code>models/generateFillTables/</code>, fiecare in fisiere bine delimitate, usor de gestionat. Aceste scripturi sunt rulate printr-un api call la una din rutele:
        </p>             
         <ul>
         <li><code> POST /api/createTables/</code> pentru a crea tabelele</li>
         <li><code> POST /api/createTables/views</code> pentru a crea view-urile</li>
         <li><code> PUT /api/createTables/</code> pentru a popula tabelele cu date random luate din diverse API-uri publice</li>
        </ul>

        <p>
            Am ales sa pastram scripturi de creare a tabelelor din considerente practice, pentru a pastra centralizat logica bazei de date si pentru a permite tuturor membrilor echipei sa modifice scripturile dupa necesitati.
        </p>
        </section>
        </section>

        <section id="implementare">
        <h3>Implementare</h3>
        <p>
        S-a realizat un design responsive, care permite navigarea intre toate paginile site-ului folosind-use un meniu care pentru tableta este de tip acordeon, iar pentru mobile se restrange in partea stanga.
        <p>
        <figure typeof="sa:image">
				<img src="/../../public/images/meniu-mare.png">
				<figcaption>Fig.2 - Meniul pe desktop</figcaption>
        </figure>
        <figure typeof="sa:image">
				<img src="/../../public/images/meniu-acordeon.png">
				<figcaption>Fig.3 - Meniul acordeon pentru tablete</figcaption>
			</figure>
      <figure typeof="sa:image">
				<img src="/../../public/images/meniu-mic.png">
				<figcaption>Fig.4 - Meniul mic pentru smartphone-uri</figcaption>
			</figure>
		
       <section id="impl-login">
        <h3>Login si sesiuni</h3>
        <p>
        Odata ce un cont este creat, se poate realiza logarea in aplicatie, atat cu email si parola, cat si prin retele sociale externe (Facebook), utilizand API-ul oferit de ei pentru a realiza aceasta functionalitate. Imediat dupa apasarea butonului de login, se va crea o sesiune ce va stoca ID-ul utilizatorului si EMAIL-ul sau, fiind necesare ulterior in afisarea datelor din aplicatie si in interogarea bazei de date pentru informatii personalizate.
        </p>
        <figure typeof="sa:image">
				<img src="/../../public/images/sesiune.png">
				<figcaption>Fig.5 - Creare sesiune</figcaption>
			</figure>
       </section>
       
        <section id="impl-asoc">
        <h3>Asociatii</h3>
        <p>
        </p>
        <figure typeof="sa:image">
				<img src="/../../public/images/asssociation.png">
				<figcaption>Fig.6 - Exemplificare cont asociatie</figcaption>
			</figure>
       </section>
       
       <section id="impl-vol">
        <h3>Voluntari</h3>
        <p>
          Contul de voluntar ofera pe DASHBOARD toate organizatiile din care face parte, iar pe PROFILE un tabel cu datele personale, badge-urile pe care le are in colectie (si pentru care exista diverse criterii de colectionare) si feedback-urile primite ulterior rezolvarii task-urilor. Pe pagina ACTIVITY, voluntarul va putea marca task-uri ca fiind preluate sau incheiate prin butoane specifice.
        </p>
        <figure typeof="sa:image">
				<img src="/../../public/images/volunteer.png">
				<figcaption>Fig.7 - Exemplificare cont voluntar</figcaption>
			</figure>
       </section>
       
       <section id="impl-api">
        <h3>API REST</h3>
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


<a href="https://www.w3schools.com/php/php_sessions.asp">Despre sesiuni</a> <br>
<a href="http://www.pelagodesign.com/blog/2009/05/20/iso-8601-date-validation-that-doesnt-suck/">Despre validarea datelor in PostgreSQL</a> <br>
<a href="https://github.com/MrRio/jsPDF">Despre folosirea jsPDF</a> <br>
<a href="https://github.com/simonbengtsson/jsPDF-AutoTable">Adagare la jsPDF - jsPDF AutoTable</a> <br>
<a href="https://www.chartjs.org/docs/latest/">Documentatie charts.js</a> <br>
<a href="https://developers.facebook.com/docs/graph-api/making-multiple-requests#limits">Realizarea de request-uri multiple</a> <br>
<a href="https://developers.facebook.com/docs/facebook-login/access-tokens#long-via-code">Token de acces Facebook</a> <br>
        </p>
        </section>
        
</body>
</html>