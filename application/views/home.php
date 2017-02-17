<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AppStation : Home</title>

        <link href="<?= base_url('public/themes/AppStation/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('public/themes/AppStation/css/skdslider.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('public/themes/AppStation/css/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('public/themes/AppStation/css/animate.css') ?>">
        <link rel="stylesheet" href="<?= base_url('public/themes/AppStation/style.css') ?>">
        <link rel="shortcut icon" type="image/png" href="<?= base_url('public/themes/AppStation/img/favicon.png') ?>"/>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src = "https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>

        <header id="headerArea">
            <a href="#" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="slider_area">
                        <div class="menuarea">
                            <div class="navbar navbar-default navbar-fixed-top" role="navigation">
                                <div class="container">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        <!-- For Text Logo -->
                                        <a class="navbar-brand logo" href="#"><span>Eco</span>Me</a>
                                        <!-- For Img Logo -->
                                        <!--  <a class="navbar-brand logo" href="#"><img src="img/logo.png" alt="logo"></a> -->
                                    </div>
                                    <div id="navbar" class="navbar-collapse collapse">
                                        <ul class="nav navbar-nav navbar-right custom_nav mobnav" id="top-menu">
                                            <li class="active"><a href="#headerArea">HOME</a></li>
                                            <li><a href="#featuresSection">FEATURES </a></li>
                                            <li><a href="#download">DOWNLOAD </a></li>
                                            <li><a href="#contact">CONTACT</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul id="demo1" class="slides">
                            <li>
                                <img src="<?= base_url('public/themes/AppStation/img/slider/asfalt.png') ?>" />
                                <div class="slide-desc">
                                    <div class="slide_descleft">
                                        <img src="<?= base_url('public/themes/AppStation/img/mobile_img1.png') ?>" alt="img">
                                    </div>
                                    <div class="slide_descright">
                                        <h1>Modalità METER</h1>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make</p>
                                        <div class="header_btnarea">
                                            <a href="<?= site_url("strutture") ?>" class="learnmore_btn">Strutture</a>
                                            <a href="#" class="download_btn">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <img src="<?= base_url('public/themes/AppStation/img/slider/dark_wall.png') ?>" />
                                <div class="slide-desc">
                                    <div class="slide_descleft">
                                        <img src="<?= base_url('public/themes/AppStation/img/mobile_img2.png') ?>" alt="img">
                                    </div>
                                    <div class="slide_descright">
                                        <h1>Mappa</h1>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make</p>
                                        <div class="header_btnarea">
                                            <a href="<?= site_url("strutture") ?>" class="learnmore_btn">Strutture</a>
                                            <a href="#" class="download_btn">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <img src="<?= base_url('public/themes/AppStation/img/slider/stardust.png') ?>" />
                                <div class="slide-desc">
                                    <div class="slide_descleft">
                                        <img src="<?= base_url('public/themes/AppStation/img/mobile_img3.png') ?>" alt="img">
                                    </div>
                                    <div class="slide_descright">
                                        <h1>Gestione dinamica degli OpenData</h1>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                        <div class="header_btnarea">
                                            <a href="<?= site_url("strutture") ?>" class="learnmore_btn">Strutture</a>
                                            <a href="#" class="download_btn">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <img src="<?= base_url('public/themes/AppStation/img/slider/dark_wood.png') ?>" />
                                <div class="slide-desc">
                                    <div class="slide_descleft">
                                        <img src="<?= base_url('public/themes/AppStation/img/mobile_img4.png') ?>" alt="img">
                                    </div>
                                    <div class="slide_descright">
                                        <h1>Build With Bootstrap V3.1.1</h1>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make</p>
                                        <div class="header_btnarea">
                                            <a href="<?= site_url("strutture") ?>" class="learnmore_btn">Strutture</a>
                                            <a href="#" class="download_btn">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <section id="featuresSection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="features_ara">
                            <h1>Buildt with Bootstrap v3.1.1</h1>
                            <p> Lorem ipsum dolor sit amet. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                                amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="features_productarea">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="featprodcs_img wow fadeInLeft">
                                <img class="img-responsive" src="<?= base_url('public/themes/AppStation/img/mobile_img1.png') ?>" alt="img">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="featprodcs_content wow fadeInRight">
                                <h1>Detailed documentation</h1>
                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Stet clita kasd gubergren, no sea takimata.</p>
                                <div class="media features_widget">
                                    <a class="pull-left" href="#">
                                        <span class="fa fa-clock-o clock_icon"></span>
                                    </a>
                                    <div class="media-body media_content">
                                        <h4>Badge per il web</h4>
                                        <p>Includi un badge che riporta il tuo punteggio.</p>
                                        <a href="http://defcon2016.altervista.org/index.php/badge">Scopri</a>
                                    </div>
                                </div>
                                <div class="media features_widget">
                                    <a class="pull-left" href="#">
                                        <span class="fa fa-wrench clock_icon"></span>
                                    </a>
                                    <div class="media-body media_content">
                                        <h4>Easy to set up</h4>
                                        <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="download" class="features_productarea sample_appparea">
                <div class="row" >
                    <div class="col-lg-12 col-md-12">
                        <div class="appdownload_area">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="appdownload">
                                        <p><span>Scarica ora!</span></p>
                                        <a href="https://play.google.com/store/apps/details?id=com.biscofil.defcon2016" id="download_android" class="download_btn appdown_btn">Android</a>
                                        <a href="https://play.google.com/store/apps/details?id=com.biscofil.defcon2016" id="download_ios" class="download_btn appdown_btn">Ios</a>
                                        <script>
                                            $("#download_ios").mouseover(function () {
                                                $("#download_ios").html("Android");
                                                $("#download_android").html("Ios");
                                            });
                                            $("#download_android").mouseover(function () {
                                                $("#download_ios").html("Ios");
                                                $("#download_android").html("Android");
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="contact_area">
                            <h1>Get in touch</h1>
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="contact_left wow fadeInLeft">
                                        <h1>Contact</h1>
                                        <div class="media contact_media">
                                            <i class="fa fa-envelope"></i>
                                            <div class="media-body contact_media_body">
                                                <h4>Email:info@codeengine.com</h4>
                                            </div>
                                        </div>
                                        <div class="contact_social">
                                            <h1>Social</h1>
                                            <a class="gplus" href="#"><i class="fa fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="contact_left wow fadeInLeft">
                                        <h1>Contact</h1>
                                        <div class="media contact_media">
                                            <i class="fa fa-envelope"></i>
                                            <div class="media-body contact_media_body">
                                                <h4>Email:info@codeengine.com</h4>
                                            </div>
                                        </div>
                                        <div class="contact_social">
                                            <h1>Social</h1>
                                            <a class="gplus" href="#"><i class="fa fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="contact_left wow fadeInLeft">
                                        <h1>Contact</h1>
                                        <div class="media contact_media">
                                            <i class="fa fa-envelope"></i>
                                            <div class="media-body contact_media_body">
                                                <h4>Email:info@codeengine.com</h4>
                                            </div>
                                        </div>
                                        <div class="contact_social">
                                            <h1>Social</h1>
                                            <a class="gplus" href="#"><i class="fa fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="footer_area">
                            <p>Designed By <a href="http://wpfreeware.com/" rel="nofollow">WpFreeware</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="<?= base_url('public/themes/AppStation/js/skdslider.min.js') ?>"></script>
        <script src="<?= base_url('public/themes/AppStation/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('public/themes/AppStation/js/wow.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('public/themes/AppStation/js/custom.js') ?>"></script>
    </body>
</html>