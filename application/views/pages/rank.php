<div class="row">
    <?php
    if (is_array($strutture) && count($strutture)) {
        foreach ($strutture as $struttura) {
            $this->load->view('pages/item_struttura', array('struttura' => $struttura));
        }
    }
    ?>
</div>