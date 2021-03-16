<? extract($this -> get_inside_data()) ?>

<?= $this -> join('layouts/header') ?>

<?= $this -> content() ?>

<?= $this -> join('layouts/footer') ?>