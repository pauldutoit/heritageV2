<?php get_header() ?>

<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>-->
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet">
<div class="landing-page">
    <div class="landing-page-photo"></div>
    <div class="landing-page-logo">
        <img src="https://media.discordapp.net/attachments/861218798881996801/875016511536893962/Logo-Heritage_b.png"
             alt="">
        <a class="heri-btn" id="discover_link" href="#">Découvrir</a>
    </div>
</div>
<div class="container">
    <div class="heri">
        <strong>Heritage</strong> c'est ...
    </div>
    <div class="section">
        <div class="section-photo"
             style="background-image: url(https://editorial01.shutterstock.com/wm-preview-1500/9868247a/12ad3859/morocco-weaver-working-at-his-loom-shutterstock-editorial-9868247a.jpg)">
            photo
        </div>
        <h2 class="text">Un savoir-faire ancéstrale qui se transmet de génération en génération avec aujourd'hui,
            les mêmes machines, les mêmes mouvements, les mêmes techniques de tissage pour une authenticité
            intacte</h2>
        <div class="section-photo"
             style="background-image: url(https://images.squarespace-cdn.com/content/v1/52669d1fe4b05199f0587707/1525719939352-9JO9A49I1U8YSR7ZEIQC/5.fatimalrhachi.jpg)">
            photo
        </div>
    </div>

    <div class="heri">
        <strong>C'est</strong> aussi ...
    </div>
    <div>
        <h3>Des être humains passionnés, qui ont baigné toute leur vie dans la conception de tapis. Ce sont des
            Artisans qualifiés du Maroc. Heritage c'est l'éthique et la bienveillance. C'est pourquoi nous tenions
            particulièrement à mettre en valeur ces artisans, à leur permettre des conidtions et un environnement de
            travail optimals</h3>
        <h1>Faîtes connaissances avec nos artisans</h1>
    </div>

    <iframe width="100%" height="900"
            src="https://www.youtube.com/watch?v=RF_p-82vxQ0&ab_channel=ChristianDior">
    </iframe>

    <div class="abass">
        <div class="abass-photo"
             style="background-image: url(https://media.routard.com/image/78/2/photo.1508782.w430.jpg)">
            <div>Youssef</div>
        </div>
        <div class="abass-photo"
             style="background-image: url(https://www.patrickwallet.com/fs01/IEL01/52/f/5559b1f40000000000000001_MEDIUM.jpg?t=20150602122400)">
            <div>Fatma</div>
        </div>
        <div class="abass-photo"
             style="background-image: url(https://www.podcastjournal.net/photo/art/default/5595864-8345999.jpg?v=1370801130)">
            <div>Hamid</div>
        </div>
        <div class="abass-photo"
             style="background-image: url(https://c8.alamy.com/compfr/ax6r19/1-l-un-homme-marocain-marocain-berbere-berbere-homme-l-erg-chebbi-proche-de-la-ville-de-merzouga-merzouga-province-d-errachidia-maroc-afrique-ax6r19.jpg)">
            <div>Aït Khizo</div>
        </div>
        <div class="abass-photo"
             style="background-image: url(https://c8.alamy.com/compfr/c7txrt/femme-berbere-maroc-c7txrt.jpg)">
            <div>Jawhara</div>
        </div>
        <!--    <div class="abass-text">Voici Abass et Fatma les responsables de l'atelier Heritage</div>-->
    </div>

    <div class="heri">
        <strong>Collection</strong> Classique ...
    </div>
    <div>
        <h3>Retrouvez dans notre Collection les modèles intemportels, les modèles traditionnels mais
            indémodables</h3>
    </div>

    <div class="section" style="display: flex; justify-content: space-between;text-align: right;">
        <div class="section-photo"
             style="background-image: url(https://img.grouponcdn.com/deal/31KMxW7QnS9WZ9zBFkZ4N1gUM9x6/31-1500x900/v1/t600x362.jpg);background-position: center;
    background-color: #000000a3;
    background-blend-mode: soft-light;padding: 30px"
        <div class="text">
            <div style="font-weight: 800;font-size: 50px;color: #0099cc;margin-bottom: 10px;}">Igolzane</div>
            <div style="font-weight: 400;color: #99cc33;">à partir de <strong style="color: #99CC33">689 €</strong></div>
            <a href="<?= wc_get_page_permalink('shop') ?>" class="heri-btn">Voir</a>
        </div>
    </div>

    <div class="section" style="display: flex; justify-content: space-between;">
        <div class="section-photo"
             style="background-image: url(https://www.lamaisongenerale.com/13096/tapis-berbere-azilal-100-laine-ecru-340x150cm.jpg);background-position: center;
    background-color: #000000a3;
    background-blend-mode: soft-light;padding: 30px"
        <div class="text">
            <div style="font-weight: 800;font-size: 50px;color: #0099cc;margin-bottom: 10px;}">Azilal</div>
            <div style="font-weight: 400;color: #99cc33;">à partir de <strong style="color: #99CC33">789 €</strong></div>
            <a href="<?= wc_get_page_permalink('shop') ?>" class="heri-btn">Voir</a>
        </div>
    </div>
    <a href="<?= wc_get_page_permalink('shop') ?>" class="heri-btn">Voir tous</a>


    <div class="heri" style="margin-top: 50px;">
        <strong>Vous désirez un tapis</strong> à votre image ?
    </div>

    <div>
        <h1><strong style="color: #99cc33 !important;">Heritage vous propose de créer un tapis complètement personnalisé à vos goûts</strong></h1>
        <h1>Collaborez directement avec les artisans et les designers Heritage pour concevoir une pièce unique que vous seul aurez dans le monde, et qui vous ressemble.
        </h1>
        <h3>Dernières créations de nos clients :</h3>
        <div class="abass">
            <div class="abass-photo"
                 style="background-image: url(https://media.adeo.com/marketplace/MKP/83084471/f742cd3aff6050966375beb2ca16f17b.jpeg?width=650&height=650&format=jpg&quality=80&fit=bounds)">
                <div>Pierre (Paris)<br>1 099 €</div>
            </div>
            <div class="abass-photo"
                 style="background-image: url(https://www.tapis24.fr/media/image/23/2b/b2/wohnzimmer-tepich-rauten-skandi-muster-1_600x600.jpg)">
                <div>Farida (Lille)<br>853 €</div>
            </div>
            <div class="abass-photo"
                 style="background-image: url(https://cdn.conforama.fr/prod/product/image/2e7a/G_CNF_H34355855_B.jpeg)">
                <div>Yanis (Metz)<br>533 €</div>
            </div>
            <div class="abass-photo"
                 style="background-image: url(https://www.passion-berbere.com/653-large_default/tapis-berbere-ancien-310-106.jpg)">
                <div>Adam (Marseille)<br>788 €</div>
            </div>
            <div class="abass-photo"
                 style="background-image: url(https://media.adeo.com/marketplace/MKP/83371588/9cf533754570b559d9ec8a7b16d06e6a.jpeg?width=650&height=650&format=jpg&quality=80&fit=bounds)">
                <div>Eva (Nantes)<br>459 €</div>
            </div>
            <!--    <div class="abass-text">Voici Abass et Fatma les responsables de l'atelier Heritage</div>-->
        </div>


        <h1>Comment faire ? c'est très simple, commencez par remplir ce formulaire qui va permettre de cibler vos goûts. Ensuite un conseiller Heritage vous contactera dans les quelques jours suivants pour commencer la collaboration. Pas d'inquiétude ça ne nécessite aucune compétence, nos designer s'occupent de transformer vos rêves en réalité</h1>
        <a href="<?= get_permalink(get_page_by_title('Créer mon tapis', 'OBJECT', 'page')) ?>" class="heri-btn">Je veux créer mon tapis</a>

    </div>
    <div class="heri" style="margin-top: 100px;">
        <strong>Commandez, </strong>et recevez un cadeau
    </div>
    <h1>La qualité de fabrication de nos tapis impliquent de long temps de livraison (8 à 14 semaines). Mais pas d'inquiétude ! Dès que vous aurez commandé, nous vous envoyons gratuitement un petit Métier à tisser avec des fils et tous les accessoires.</h1>


    <div class="section">
        <div class="section-photo"
             style="background-image: url(https://lh3.googleusercontent.com/proxy/9k7s3NMO5ZpY5A1zT2fITk2BH5BrftKipIkG9AM2SnDyGgwamH7qiLl3y66Fbi8It4vSygR1okCYLzKV3b2hFRLcPHBAR_lYKivWXsS7XxV8z0gteLCN8NH1O9TRWEgo)">

        </div>
        <h3 class="text">Vous aurez tout le temps de fabriquer différents objets de décoration berbère en attendant l'arrivée de votre tapis. Vous retrouverez différents tutoriels dans la section
            <a href="<?= get_permalink(get_page_by_title('Articles', 'OBJECT', 'page')) ?>">Webzine</a>. Cette activité saura occuper les petits comme les grands, les débutants comme les experimentés</h3>
        <div class="section-photo"
             style="background-image: url(https://i.pinimg.com/originals/cc/13/e2/cc13e230400c46ecb5c20b11dc72aaad.jpg)">

        </div>
    </div>

    <h1>Quelques idées ...</h1>
    <?php echo do_shortcode( '[gs_pinterest]' ); ?>

</div>



<?php get_footer() ?>
