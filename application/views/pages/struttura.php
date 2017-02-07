<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1><?= $struttura->nome ?></h1>
        <p><?= $struttura->descrizione ?></p>
        <p><a class="btn btn-primary btn-lg" href="<?= $struttura->sito_web ?>" role="button">Vai al sito &raquo;</a></p>
    </div>
</div>

<pre><?php print_r($struttura); ?></pre>