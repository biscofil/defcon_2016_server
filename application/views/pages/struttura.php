<link rel="stylesheet" href="http://defcon2016.altervista.org/public/badge/badge.min.css">

<div class="jumbotron">
    <div class="container">

        <div class="row">
            <div class="col-sm-4">
                <img class="img-responsive img-thumbnail" src="<?= $struttura->url_img ?>" />
            </div>
            <div class="col-sm-8">
                <h1><?= $struttura->nome ?></h1>
                <div id="defcon2016_badge" data-key="<?= $struttura->id ?>"></div>
            </div>
        </div>

        <p><?= $struttura->descrizione ?></p>
        <p>
            <a class="btn btn-primary btn-lg" href="<?= $struttura->sito_web ?>" role="button">Vai al sito &raquo;</a>
            <a class="btn btn-primary btn-lg" href="<?= site_url('badge/index/' . $struttura->id) ?>" role="button">Ottieni il badge</a>
        </p>
    </div>
</div>