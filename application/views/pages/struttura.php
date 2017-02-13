<!-- Main jumbotron for a primary marketing message or call to action -->


<div class="jumbotron">
    <div class="container">

        <div class="row">
            <div class="col-sm-4">
                <img class="img-responsive img-thumbnail" src="<?= $struttura->url_img ?>" />
            </div>
            <div class="col-sm-8">
                <h1><?= $struttura->nome ?></h1>
            </div>
        </div>

        <p><?= $struttura->descrizione ?></p>
        <p><a class="btn btn-primary btn-lg" href="<?= $struttura->sito_web ?>" role="button">Vai al sito &raquo;</a></p>
    </div>
</div>

<pre><?php print_r($struttura); ?></pre>