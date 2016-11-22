<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="<?= base_url('public/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="<?= base_url('public/badge/badge.min.css') ?>">
        <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?autoload=true&amp;skin=sunburst&amp;lang=css" defer="defer"></script>
        <style>.operative { font-weight: bold; border:1px solid yellow }</style>
    </head>

    <body>

        <div class="container">
            <h2>Includere questo codice nella pagina</h2>
            <pre class="prettyprint">
            &lt;div id=&quot;defcon2016_badge&quot; data-key=&quot;<span class="operative">INSERIRE_QUI_ID_STRUTTURA</span>&quot;&gt;&lt;/div&gt;
            &lt;link rel=&quot;stylesheet&quot; href=&quot;<?= base_url('public/badge/badge.min.css') ?>&quot;&gt;
            &lt;script src=&quot;https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js&quot;&gt;&lt;/script&gt;
            &lt;script src=&quot;<?= base_url('public/badge/badge.min.js') ?>&quot;&gt;&lt;/script&gt;
            </pre>


            <h2>Anteprima</h2>
            <div id="defcon2016_badge" data-key="1"></div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="<?= base_url('public/badge/badge.min.js') ?>"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?= base_url('public/bootstrap/js/bootstrap.min.js') ?>"></script>
    </body>
</html>