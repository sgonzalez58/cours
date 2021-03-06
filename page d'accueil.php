<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Jadoo : un voyage culinaire gourmet et gourmand</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/fonts.css">
    </head>

    <body>
        <header class="left-pad">
            <a href="#">
                <div id="logo">
                    <img class="img-logo" src="img/logo_jadoo_1.svg" alt="logo1">
                    <img src="img/logo_jadoo_2.svg" alt="logo2">
                </div>
            </a>
            <nav>
                <div class="menu">
                    <label for="mobile">
                        <img src="img/burger_icon.svg" alt="menu portable">
                    </label>
                    <input type="checkbox" id="mobile" role="button">
                    <ul>
                        <li><a href="#nouveautes">Les Nouveautés</a></li>
                        <li><a href="#chef">Découvrir</a></li>
                        <li><a href="#commander">Commander</a></li>
                        <li><a href="#prendre_rdv">Contactez-nous</a></li>
                    </ul>
                </div>
            </nav>
            <a id="contact" href="#prendre_rdv">Contact</a>
        </header>
    <!--corps-->
        <main>
            <div id="overlay">
                <div id="confirmation">
                    <p>Votre formulaire a bien été envoyé</p>
                </div>
            </div>
            <?php
                if(isset($_COOKIE['form'])){
                    ?>
                    <script>
                        overlay = document.getElementById("overlay");
                        overlay.style.display = 'flex';
                        overlay.onclick = function() {overlay.style.display = 'none'};
                    </script>
                    <?php
                    setcookie("form", "", time() - 300);
                }
            ?>
            <section id="partie_presentation">
                <p class="slogan saumon">Un voyage culinaire gourmet et gourmand</p>

                <h2>Bienvenue <br> au restaurant <br><span class="souligne">Jadoo</span></h2>

                <p class="presentation gris">Jadoo vous accueille dans son ambiance zen et épurée, idéale pour découvrir ou
            redécouvrir
            la
            cuisine gastronomique du Chef Junichi Ilda.
                </p>
                <a href="#">
                    <button class="lien_carte" type="button">Découvrir la carte</button>
                </a>
            </section>
            <section id="nouveautes" class="middle">
                <p class="gris">Découvrez</p>
                <h3>Les nouveautés Jadoo</h3>
                <div id="plats">
                <?php
                    $serverName = "localhost";
                    $username = "root";
                    $password = "admin";
                    try{
                        $conn = new PDO("mysql:host=$serverName;dbname=jadoo;charset=utf8",$username, $password);
                        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
                    }
                    catch(PDOException $e){
                        echo 'Erreur :'.$e->getMessage();
                    }
                    $sth = $conn->prepare("SELECT Nom, Description, Image FROM plats
                                           WHERE Id_categorie = 1
                                           ORDER BY Id DESC
                                           LIMIT 3");
                    $sth -> execute();
                    $plats = $sth -> fetchALL(PDO::FETCH_ASSOC);
                    $i = 0;
                    foreach ($plats as $plat){
                        $i++;
                        if($i == 3){
                            ?>
                            <article class="carte" id="deco_filet">
                            <?php
                        }else{
                            ?>
                            <article class="carte">
                            <?php
                        }
                        ?>
                    <figure>
                        <img title="<?php echo $plat['Nom'] ?>" src="./img/<?php echo $plat['Image'] ?>" alt="Image <?php echo $plat['Nom'] ?>" />
                        <figcaption><?php echo $plat['Description'] ?></figcaption>
                    </figure>
                </article>
                <?php
                    }
                    ?>
                    <!--<figure>
                        <img src="img/plat_1.png" alt="boulettes de poulet">
                        <figcaption>Boulettes de poulet au<br>gimgembre sauce sucrée<br>salée "Tsukuné"</figcaption>
                    </figure>
                    <figure>
                        <img src="img/plat_2.png" alt="nouilles japonaises">
                        <figcaption>Nouilles japonaises<br>chaudes à base de farine<br>de blé "Udon"</figcaption>
                    </figure>
                    <div id="deco_filet">
                        <figure>
                            <img src="img/plat_3.png" alt="Echine de porc">
                            <figcaption>Echine de porc panée à la<br>japonaise "Tonkatsu-<br>Teishoku</figcaption>
                        </figure>
                    </div>-->
                    <article>
                        <figure id="dummy">
                            <img src="img/plat_2.png" alt="dummy">
                            <figcaption>Nouilles japonaises<br>chaudes à base de farine<br>de blé "Udon"</figcaption>
                        </figure>
                    <article>
                </div>
                <div id="maki">
                    <?php
                    $sth = $conn->prepare("SELECT P.Nom, P.Description, P.Image FROM plats as P
                                           INNER JOIN categories as C
                                           ON P.Id_Categorie = C.Id_Categorie
                                           WHERE C.Categorie = 'makis'
                                           ORDER BY Id DESC
                                           LIMIT 4");
                    $sth -> execute();
                    $makis = $sth -> fetchALL(PDO::FETCH_ASSOC);
                    foreach ($makis as $maki){
                        ?>
                    <article class="carte">
                        <figure>
                            <img title="<?php echo $maki['Nom'] ?>" src="./img/<?php echo $maki['Image'] ?>" alt="Image <?php echo $maki['Nom'] ?>" />
                            <figcaption><?php echo $maki['Description'] ?></figcaption>
                            <img class="decoration_maki" src="img/decoration_rose.svg" alt="decoration rose">
                        </figure>
                    </article>
                    <?php
                    }

                    ?><!--
                    <figure>
                        <img src="img/maki_1.png" alt="maki california tobiko">
                        <figcaption><span>California Tobiko</span>Saumon, thon, mayonnaise</figcaption>
                        <img class="decoration_maki" src="img/decoration_rose.svg" alt="decoration rose">
                    </figure>
                    <figure>
                        <img src="img/maki_2.png" alt="maki california rolls">
                        <figcaption><span>California Rolls</span>Saumon, avocat et mayonnaise</figcaption>
                        <img class="decoration_maki" src="img/decoration_rose.svg" alt="decoration rose">
                    </figure>
                    <figure>
                        <img src="img/maki_3.png" alt="maki ebi">
                        <figcaption><span>Ebi</span>Crevette, avocat, menthe, coriandre</figcaption>
                        <img class="decoration_maki" src="img/decoration_rose.svg" alt="decoration rose">
                    </figure>
                    <figure>
                        <img src="img/maki_4.png" alt="maki ikura rolls">
                        <figcaption><span>Ikura Rolls</span>Oeufs de saumon</figcaption>
                        <img class="decoration_maki" src="img/decoration_rose.svg" alt="decoration rose">
                    </figure>-->
                </div>
                <a href="#">
                    <button class="lien_carte" type="button">Découvrir la carte</button>
                </a>
                <?php
                $conn = null;
                ?>
            </section>
            <section id="chef">
                <div id="video_presentation" class="marg-left">
                    <video poster="./img/visu_video.jpg">
                        <source src="#">
                    </video>
                    <img id="play" src="img/button_play.svg" alt="bouton play">
                </div>
                <div id="conteneur_image">
                    <div id="conteneur-cuisinier">
                        <img id="cuisinier" src="img/illustration_chef.jpg" alt="cuisinier">
                    </div>
                    <div id="conteneur-plat"></div>
                </div>
                <h2 class="marg-left"><span class="souligne">Un voyage</span> gastronomique entre le Japon et la France...</h2>
                <p id="histoire" class="marg-left">Passé par des maisons étoilées en France, le cuisinier japonais s'est forgé
                    une solide expérience dans
                    l'Hexagone
                    : aujourd'hui franc-comtois d'adoption, il maîtrise chaque jour au sein de son restaurant gastronomique
                    japonais à
                    Paris
                </p>
                <div id="flot">
                    <img class="float_left" src="./img/wrapper_illustration_1.jpg" alt="baguettes">
                    <img class="float_left" src="./img/wrapper_illustration_2.jpg" alt="salle à manger">
                </div>
                <p id="commander" class="lancement marg-left gris">Rapide et pratique</p>
                <h4 class="marg-left"><span class="saumon">Commandez</span> <br> sur le site Jadoo</h4>
                <div class="marg-left" id="commandes_idees">
                    <a href="#">
                        <img class="logo" src="./img/logo_uberEats.png" alt="logo uber eat">
                        <p><span>UberEats</span><br>Commandez tous vos plats depuis UberEats</p>

                    </a>
                    <a href="#">
                        <img class="logo" src="./img/logo_jadoo_1.svg" alt="logo jadoo">
                        <p><span>Jadoo.fr</span><br>Ou commandez en ligne sur le site Officiel de Jadoo</p>

                    </a>
                    <div id="livraison">
                        <img class="logo" src="./img/logo_transport.png" alt="logo transport">
                        <p><span>Livraison ultra rapide</span><br>Soyez livrez en 20 minutes maximum</p>
                    </div>
                </div>
                <a href="#">
                    <button class="lien_carte marg-left" type="button">Découvrir la carte</button>
                </a>
            </section>


            <section id="prendre_rdv">
                <p class="lancement middle gris">Prendre rendez-vous</p>
                <h3 class="middle">Contactez-nous</h3>
                <h3 class="middle">pour réserver au restaurant</h3>
                <div id="fiche_de_contact">
                    <form id="formulaire" method="post" action="php/form.php">
                        <h5>Formulaire de contact</h5>
                        <p class="exemple">Remplissez le formulaire ci-dessous<br>pour nous contacter</p>
                        <div id="identite" class>
                            <div>
                                <label for="nom">Nom</label><br>
                                <input type="text" id="nom" name="nom" placeholder="DRABCZYNSKI" minlength="2" maxlength="30"
                                    required pattern="^[A-Za-z '-]+$">
                            </div>
                            <div>
                                <label for="prenom">Prénom</label><br>
                                <input type="text" id="prenom" name="prenom" placeholder="Alan" minlength="2" maxlength="30"
                                    required pattern="^[A-Za-z '-]+$">
                            </div>
                        </div>
                        <div>
                            <label for="mail">Adresse e-mail</label><br>
                            <input type="email" id="mail" name="mail" placeholder="alan.drabczynski@gmail.com" required
                                    pattern="^[A-Za-z0-9.]+@{1}[A-Za-z]+\.{1}[A-Za-z]{2,}$">
                        </div>
                        <div>
                            <label for="message">Message</label><br>
                            <input type="text" id="message" name="message" placeholder="Ecrivez votre message ici"
                                maxlength="500" required>
                        </div>
                        <br>
                        <br>
                        <div class="middle">
                            <input type="submit" value="Envoyer">
                            </input>
                        </div>
                    </form>
                    <?php
                    ?>
                    <div id="image_contact">
                        <img id="photo_formulaire" src="img/illustration_formulaire.jpg" alt="Plat de sushi appétisant">
                    </div>
                </div>
            </section>
        </main>
        <footer class="middle">
            <div id="boite_final">
                <div id="description">
                    <div>
                        <img class="img-logo" src="img/logo_jadoo_1.svg" alt="logo1">
                        <img src="img/logo_jadoo_2.svg" alt="logo2">
                    </div>
                    <p>Un voyage gastronomique entre<br>le Japon et la France</p>
                </div>
                <div id="lien_menu">
                    <div id="premiers_liens">
                        <h6>Restaurant</h6>
                        <a href="#nouveautes">Nouveautés</a>
                        <a href="#chef">Découvrir</a>
                        <a href="#commander">Commander</a>
                    </div>
                    <div id="seconds_liens">
                        <h6>Contact</h6>
                        <a href="#prendre_rdv">Prendre RDV</a>
                    </div>
                </div>
                <div id="appli_fin">
                    <figure>
                        <img src="./img/logo_uberEats_2.svg" alt="logo ecrit uber eats">
                        <figcaption>Téléchargez UberEats</figcaption>
                    </figure>
                    <a href="https://play.google.com/store/apps/details?id=com.ubercab.eats&hl=fr&gl=US" target="_blank">
                        <button class="lien_fin_page" type="button">
                            <img src="./img/logo_google_play.svg" alt="logo google play">
                            <p>GOOGLE PLAY</p>
                        </button>
                    </a>
                    <a href="https://apps.apple.com/fr/app/uber-eats-livraison-de-repas/id1058959277" target="_blank">
                        <button class="lien_fin_page" type="button">
                            <img src="./img/logo_apple.svg" alt="logo apple">
                            <p>APPLE STORE</p>
                        </button>
                    </a>
                </div>
            </div>
            <p id="fin">Tous droits réservés @jadoo.com</p>
        </footer>
    </body>
</html>