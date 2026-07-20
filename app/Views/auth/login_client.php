<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Connexion Client<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Connexion Client</h1>
<p class="page-sub">Entrez votre numéro de téléphone.</p>
<div class="card form-card">
    <form method="post" action="/login/client">
        <div class="field">
            <label for="numero">Numéro de téléphone</label>
            <input type="text" id="numero" name="numero" placeholder="0331234567" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
    </form>
    <p class="muted-note">Espace admin ? <a href="/login/admin">Connexion administrateur</a></p>
</div>
<?= $this->endSection() ?>
