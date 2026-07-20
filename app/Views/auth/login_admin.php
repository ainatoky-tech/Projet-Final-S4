<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Connexion Admin<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Administration</h1>
<p class="page-sub">Connectez-vous avec vos identifiants.</p>
<div class="card form-card">
    <form method="post" action="/login/admin">
        <div class="field">
            <label for="login">Login</label>
            <input type="text" id="login" name="login" placeholder="admin" required>
        </div>
        <div class="field">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
    </form>
    <p class="muted-note">Espace client ? <a href="/login/client">Connexion client</a></p>
</div>
<?= $this->endSection() ?>
