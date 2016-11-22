<!DOCTYPE html>
<html lang="en">
    <head>

        <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?autoload=true&amp;skin=sunburst&amp;lang=css" defer="defer"></script>
        <style>.operative { font-weight: bold; border:1px solid yellow }</style>
    </head>

    <body>

        <h2>Includere questo codice nella pagina</h2>
        <pre class="prettyprint">
            &lt;div id=&quot;badge&quot; data-key=&quot;<span class="operative">INSERIRE_QUI_ID_STRUTTURA</span>&quot;&gt;&lt;/div&gt;
            &lt;script src=&quot;https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js&quot;&gt;&lt;/script&gt;
            &lt;script src=&quot;<?= base_url('public/badge/badge.js') ?>&quot;&gt;&lt;/script&gt;
        </pre>

        <h2>Anteprima</h2>
        <div id="badge" data-key="1"></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="<?= base_url('public/badge/badge.js') ?>"></script>
    </body>
</html>