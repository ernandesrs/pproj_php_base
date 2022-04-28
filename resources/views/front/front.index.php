<?php $this->layout('layouts/front') ?>

<h1>FRONT</h1>

<?php $this->start('scripts') ?>
<script>
    console.log("Olá, script dinâmico!");
</script>
<?php $this->stop() ?>