<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Nouveau client<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Nouveau client</h1>
<p class="page-sub">Ajouter un client au système.</p>
<div class="card form-card">
    <form method="post" action="/clients/store">
        <div class="field">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Nom complet" required>
        </div>
        <div class="field">
            <label for="numero">Numéro</label>
            <input type="text" id="numero" name="numero" placeholder="0331234567" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
    </form>
</div>
<?= $this->endSection() ?>
