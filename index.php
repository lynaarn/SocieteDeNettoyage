<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
    <!-- site metas -->
    <title>EclatNet</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
    <!-- Tweaks for older IEs-->
    <link
      rel="stylesheet"
      href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"
    />
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
      media="screen"
    />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .services_section {
            padding: 60px 0;
            background-color: #ffffff;
        }
        .services_section h1 {
            text-align: center;
            font-size: 3em;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .services_section p {
            text-align: center;
            margin-bottom: 40px;
            color: #666;
            font-size: 1.1em;
        }
        .services_grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .card {
          padding: 20px;
            border: 2px solid #cccccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: center;
        }
        .card-text {
            color: #777;
            font-size: 1em;
        }
        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }
        .carousel-control-prev i,
        .carousel-control-next i {
            font-size: 1.5em;
            color: white;
        }
        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
        .comments_section {
            padding: 60px 0;
            background-color: #ffffff;
        }
        .comments_section h2 {
            text-align: center;
            font-size: 2.5em;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .comment_card {
            border: 2px solid black;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            background-color: #fff;
        }
        .comment_header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .comment_user {
            font-size: 1.2em;
            color: #333;
            font-weight: bold;
        }
        .comment_stars {
            color: #f39c12;
        }
        .comment_body {
            margin-top: 10px;
            color: #777;
            font-size: 1em;
        }
        .pagination {
            justify-content: center;
            margin-top: 30px;
            padding: 20px;
            margin: 20px;
        }
        .titre {
            font-size: 3em;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: center;
        }
        .job-section {
            padding: 60px 0;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .job-offer {
            max-width: 600px;
            width: 100%;
            border: 2px solid #cccccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            margin: 0 auto;
        }
        .job-offer:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .job-offer img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .job-offer .card-body {
            padding: 20px;
        }
        .job-offer .card-title {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: center;
        }
        .job-offer .dates, .job-offer .skills {
            padding: 20px;
            text-align: left;
        }
        .job-offer .dates p, .job-offer .skills p {
            margin-bottom: 10px;
        }
        .job-offer .skills ul {
            list-style: none;
            padding: 0;
        }
        .job-offer .skills ul li {
            margin-bottom: 5px;
        }
        .job-offer .skills ul li::before {
            content: "•";
            color: #ffcc00;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        /* Styles for the button */
        .postuler-button {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        .postuler-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #50C878;
            color: #333;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .postuler-button a:hover {
            background-color: #ffdb4d;
        }
        .modal-content {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    }
    .modal-header {
        background-color: #aacee4;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .modal-footer {
        background-color: #f1f1f1;
    }
    .modal-body p, .modal-body ul {
        font-size: 16px;
        line-height: 1.6;
    }
    .modal-body ul {
        list-style-type: none;
        padding-left: 0;
    }
    .modal-body ul li::before {
        content: "• ";
        color: #aacee4;
        font-weight: bold;
    }
        
    </style>
     
  </head>
  <body>
    <!--header section start -->
    <div class="header_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="logo">
              <a href="index.html"><img src="images/logoo.png" /></a>
            </div>
          </div>
          <div class="col-md-9">
            <div class="menu_text">
              <ul>
                <div class="togle_3">
                  <div class="menu_main">
                    <div class="padding_left0">
                      <a href="creationcompte.php">Créer compte</a>
                      <span class="padding_left0"></span>
                        <a href="authentification.php">Se connecter</a></span>
                    </div>
                  </div>
                </div>
                <div id="myNav" class="overlay">
                  <a
                    href="javascript:void(0)"
                    class="closebtn"
                    onclick="closeNav()"
                    >&times;</a
                  >
                  <div class="overlay-content">
                    <a href="index.html">Acceuil</a>
                    <a href="services.html">Services</a>
                    <a href="about.html">A propos</a>
                    <a href="choose.html">Choose</a>
                    <a href="team.html">Team</a>
                    <a href="contact.html">Contactez nous</a>
                  </div>
                </div>
                <span class="navbar-toggler-icon"></span>
                <span onclick="openNav()"
                  ><img src="" class="toggle_menu"
                /></span>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- banner section start -->
      <div class="banner_section layout_padding">
        <div class="container">
          <div class="row">
            <div class="col-sm-5">
              <h1 class="banner_taital">Nettoyage IMPECCABLE</h1>
              <h1 class="banner_taital_1">satisfaction garantie.</h1>
              <p class="banner_text">
                Nous offrons le meilleur service de nettoyage, vous ne serez pas
                déçu de notre efficacité et de notre professionnalisme.
              </p>
            </div>

            <div class="col-sm-5">
              <div><img src="images/img-1.png" class="image_1" /></div>
            </div>
          </div>
        </div>
      </div>
      <!-- banner section end -->
    </div>
    <!-- header section end -->
    <div class="about_section layout_padding">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div><img src="images/img-2.png" class="image_2" /></div>
          </div>
          <div class="col-md-6">
            <h1 class="services_taital">
              <span>A propos </span> <img src="images/icon-1.png" />
              <span style="color: #1f1f1f">De nous</span>
            </h1>
            <p class="ipsum_text">
              Notre entreprise de nettoyage offre des services exceptionnels
              grâce à une équipe expérimentée et des méthodes modernes. Nous
              nous engageons à fournir un nettoyage de qualité supérieure pour
              les entreprises, les établissements de santé, les écoles et les
              particuliers. La satisfaction de nos clients est notre priorité,
              et nous nous efforçons constamment de dépasser leurs attentes.
              Confiez-nous vos espaces pour une propreté impeccable et une
              tranquillité d'esprit totale.
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- services section start -->
    <div class="services_section">
    <div class="container">
        <h1 class="choose_taital">Nos Services</h1>
        <p>Découvrez nos services de nettoyage complets et sur mesure, adaptés à vos besoins spécifiques. Faites confiance à notre équipe expérimentée pour garder vos espaces impeccables.</p>
        <div id="servicesCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                            <h5 class="card-title">Nettoyage d'entrepôt</h5>
                                <img src="images/29.jpg" class="card-img-top" alt="Nettoyage d'entrepôt">
                                <div class="card-body">
                                  
                                    <p class="card-text">Nous assurons le nettoyage d'entrepôts avec efficacité et professionnalisme pour maintenir un environnement propre et sécurisé.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                            <h5 class="card-title">Nettoyage de maison</h5>
                                <img src="images/49.jpg" class="card-img-top" alt="Nettoyage de maison">
                                <div class="card-body">
                                   
                                    <p class="card-text">Profitez d'un service professionnel de nettoyage résidentiel pour une maison impeccable et confortable dans les plus courts délais.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                            <h5 class="card-title">Nettoyage des centres éducatifs</h5>
                                <img src="images/50.jpg" class="card-img-top" alt="Nettoyage des centres éducatifs">
                                <div class="card-body">
                                   
                                    <p class="card-text">Notre service de nettoyage des centres éducatifs garantit un environnement d'apprentissage impeccable et sécurisé pour les élèves et le personnel.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                            <h5 class="card-title">Nettoyage d'hôpitaux</h5>
                                <img src="images/51.jpg" class="card-img-top" alt="Nettoyage d'hôpitaux">
                                <div class="card-body">
                                   
                                    <p class="card-text">Notre service de nettoyage d'hôpitaux assure un environnement hygiénique et sûr pour les patients, le personnel médical et les visiteurs.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                            <h5 class="card-title">Nettoyage d'usines</h5>
                                <img src="images/34.jpg" class="card-img-top" alt="Nettoyage d'usines">
                                <div class="card-body">
                                  
                                    <p class="card-text">Notre service de nettoyage d'usines garantit des installations impeccables, conformes aux normes de sécurité et d'hygiène les plus strictes.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                            <h5 class="card-title">Désinfection de meubles</h5>
                                <img src="images/28.jpg" class="card-img-top" alt="Désinfection de meubles">
                                <div class="card-body">
                                   
                                    <p class="card-text">Notre service de désinfection de meubles garantit un environnement propre et hygiénique, en éliminant les germes et les bactéries des surfaces.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#servicesCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Précédent</span>
            </a>
            <a class="carousel-control-next" href="#servicesCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Suivant</span>
            </a>
        </div>
    </div>
</div>

<div class="comments_section">
    <div class="container">
        <h2>Commentaires des Utilisateurs</h2>
        <div class="row" id="commentRow">
            <!-- Commentaires seront ajoutés ici dynamiquement -->
        </div>
        <div class="pagination">
            <button class="btn ajout mb-3" id="prevCommentsBtn">Précédent</button>
            <button class="btn ajout mb-3" id="nextCommentsBtn">Suivant</button>
        </div>
    </div>
</div>
<h1 class="titre">Nos offres d'emplois</h1>
<div class="job-section">
        <div id="jobCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <!-- First Job Offer -->
                <div class="carousel-item active">
                    <div class="job-offer">
                        <div class="card">
                            <img src="images/69.jpg" alt="Job Image" />
                            <div class="card-body">
                                <h2 class="card-title">Employé de Nettoyage</h2>
                                <p class="card-text">Nous recherchons un employé de nettoyage motivé et rigoureux pour maintenir la propreté de nos locaux. Vous jouerez un rôle crucial dans la garantie d'un environnement sain et propre pour tous.</p>
                                <div class="dates">
                                    <p class="card-title">Date de début : 01/06/2024</p>
                                    <p class="card-title">Date de fin : 30/06/2024</p>
                                </div>
                                <div class="skills">
                                    <h3>Compétences requises :</h3>
                                    <ul>
                                        <li>Expérience en nettoyage professionnel</li>
                                        <li>Attention aux détails</li>
                                        <li>Capacité à travailler de manière autonome</li>
                                        <li>Bonne condition physique</li>
                                        <li>Connaissance des produits de nettoyage et des techniques</li>
                                    </ul>
                                </div>
                                <div class="postuler-button">
                                <a href="#" id="postulerBtn">Postuler pour cette offre</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Second Job Offer -->
                <div class="carousel-item">
                    <div class="job-offer">
                        <div class="card">
                            <img src="images/70.jpg" alt="Job Image" />
                            <div class="card-body">
                                <h2 class="card-title">Technicien de surface</h2>
                                <p class="card-text">Nous recherchons un employé de nettoyage motivé et rigoureux pour maintenir la propreté de nos locaux. Vous jouerez un rôle crucial dans la garantie d'un environnement sain et propre pour tous.</p>
                                  <div class="dates">
                                    <p class="card-title">Date de début : 01/07/2024</p>
                                    <p class="card-title">Date de fin : 30/07/2024</p>
                                </div>
                                <div class="skills">
                                    <h3>Compétences requises :</h3>
                                    <ul>
                                    <li>Expérience en nettoyage professionnel</li>
                                        <li>Attention aux détails</li>
                                        <li>Capacité à travailler de manière autonome</li>
                                        <li>Bonne condition physique</li>
                                        <li>Connaissance des produits de nettoyage et des techniques</li>
                                    </ul>
                                </div>
                                <div class="postuler-button">
                                <a href="#" id="postulerBtn">Postuler pour cette offre</a>
</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#jobCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#jobCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="modal fade" id="cvModal" tabindex="-1" role="dialog" aria-labelledby="cvModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cvModalLabel">Formulaire de Candidature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenu du formulaire -->
                <form id="candidatureForm">
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Âge:</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="experience">Expérience:</label>
                        <textarea class="form-control" id="experience" name="experience" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="education">Éducation:</label>
                        <textarea class="form-control" id="education" name="education" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Soumettre</button>
                </form>
            </div>
        </div>
    </div>
</div>





    <!-- about section end -->
    <!-- choose section start -->
    <div class="choose_section layout_padding">
      <div class="container">
        <h1 class="choose_taital">
          <span>Pourquoi </span> <img src="images/icon-1.png" />
          <span style="color: #1f1f1f">Nous choisir</span>
        </h1>
        <p class="choose_text">
          Pendant plusieurs années, nous avons accumulé une précieuse
          expérience, recueilli de nombreux avis positifs et fidélisé une
          clientèle confiante.
        </p>
        <div class="choose_section_2 layout_padding">
          <div class="row">
            <div class="col-lg-3 col-sm-6">
              <div class="choose_box">
                <h1 class="client_taital">1200+</h1>
                <h4 class="client_text">Nos clients</h4>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="choose_box">
                <h1 class="client_taital">1000+</h1>
                <h4 class="client_text">Clients satisfaits</h4>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="choose_box">
                <h1 class="client_taital">15+</h1>
                <h4 class="client_text">Années d'expériences</h4>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="choose_box">
                <h1 class="client_taital">120+</h1>
                <h4 class="client_text">Nos employés</h4>
              </div>
            </div>
          </div>
          <div class="image_3"><img src="images/img-3.png" /></div>
        </div>
      </div>
    </div>
    <!-- choose section end -->
   
    <!-- team section start -->
    <!-- newsletter section start -->

    <!-- newsletter section end -->
    <!-- footer section start -->
    <div class="footer_section layout_padding">
      <div class="container">
        <div class="footer_main">
          <div class="footer_left">
            <h1 class="contact_taital">
              <span>Contactez </span> <img src="images/icon-2.png" />
              <span>Nous</span>
            </h1>
          </div>
          <div class="footer_left">
            <div class="location_text">
              <a href="#"
                ><img src="images/map-icon.png" /><span class="padding_left_15"
                  >Bab ezzouar, Algiers, ALgeria</span
                ></a
              >
            </div>
          </div>
          <div class="footer_left">
            <div class="location_text">
              <a href="#"
                ><img src="images/call-icon.png" />
                <span class="padding_left_15">+213 559899570 </span>
                <span class="padding_left_15"> +213 541676585</span>
              </a>
            </div>
          </div>
          <div class="footer_left">
            <div class="location_text">
              <a href="#"
                ><img src="images/map-icon.png" /><span class="padding_left_15"
                  >aouranelyna@gmail.com imad.safa19@gmail.com</span
                ></a
              >
            </div>
          </div>
        </div>
        <div class="contact_section">
          <div class="row"> 
            <div class="col-md-6">
              <div class="map_main">
                <div class="map-responsive">
                  <iframe
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=USTHB+BebZouar+Alger+Algerie"
                    width="600"
                    height="280"
                    frameborder="0"
                    style="border: 0; width: 100%"
                    allowfullscreen
                  ></iframe>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- javascript -->
    <script src="js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
      $(document).ready(function () {
        $(".fancybox").fancybox({
          openEffect: "none",
          closeEffect: "none",
        });

        $(".zoom").hover(
          function () {
            $(this).addClass("transition");
          },
          function () {
            $(this).removeClass("transition");
          }
        );
      });
    </script>
    <script>
      function openNav() {
        document.getElementById("myNav").style.width = "100%";
      }
      function closeNav() {
        document.getElementById("myNav").style.width = "0%";
      }
    </script>
    <script>
    // Données de commentaires (simulées pour l'exemple)
    var comments = [
        { user: "Alice Dupont", stars: "★★★★★", body: "Excellent service ! Mon appartement n'a jamais été aussi propre. Je recommande vivement." },
        { user: "Sophie Lefevre", stars: "★★★★★", body: "Très satisfaite du service de nettoyage. Équipe professionnelle et efficace." },
        { user: "Jean Martin", stars: "★★★★☆", body: "Bon travail dans l'ensemble, mais ils ont oublié de nettoyer une petite zone dans la cuisine." },
        { user: "Pierre Moreau", stars: "★★★☆☆", body: "Le service était correct, mais la ponctualité pourrait être améliorée." },
        { user: "Marie Leclerc", stars: "★★★★★", body: "Je suis impressionnée par la qualité du nettoyage. Très méticuleux et attentionné." },
        { user: "Luc Dubois", stars: "★★★☆☆", body: "Service satisfaisant dans l'ensemble, mais quelques détails ont été négligés." }
    ];

    // Nombre de commentaires par page
    var commentsPerPage = 2;

    // Index de la première page de commentaires
    var startIndex = 0;

    // Afficher les commentaires initiaux
    displayComments(startIndex);

    // Fonction pour afficher les commentaires
    function displayComments(startIndex) {
        var commentRow = document.getElementById("commentRow");
        commentRow.innerHTML = ""; // Effacer les commentaires précédents

        for (var i = startIndex; i < startIndex + commentsPerPage; i++) {
            if (i < comments.length) {
                var comment = comments[i];
                var commentHTML = `
                    <div class="col-md-6">
                        <div class="comment_card">
                            <div class="comment_header">
                                <span class="comment_user">${comment.user}</span>
                                <span class="comment_stars">${comment.stars}</span>
                            </div>
                            <div class="comment_body">${comment.body}</div>
                        </div>
                    </div>
                `;
                commentRow.innerHTML += commentHTML;
            }
        }
    }

    // Bouton Suivant
    document.getElementById("nextCommentsBtn").addEventListener("click", function() {
        if (startIndex + commentsPerPage < comments.length) {
            startIndex += commentsPerPage;
            displayComments(startIndex);
        }
    });

    // Bouton Précédent
    document.getElementById("prevCommentsBtn").addEventListener("click", function() {
        if (startIndex - commentsPerPage >= 0) {
            startIndex -= commentsPerPage;
            displayComments(startIndex);
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var postulerBtn = document.getElementById('postulerBtn');
        postulerBtn.addEventListener('click', function(e) {
            e.preventDefault();
            $('#cvModal').modal('show');
        });
    });
</script>


  </body>
</html>
