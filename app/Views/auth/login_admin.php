<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Connexion Admin<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-1 fw-bold">Administration</h1>
<p class="text-muted mb-4">Connectez-vous avec vos identifiants.</p>
<div class="card shadow-sm mx-auto" style="max-width:420px">
    <div class="card-body p-4">
        <form method="post" action="/login/admin">
            <div class="mb-3">
                <label for="login" class="form-label fw-semibold">Login</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="admin" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </form>
        <p class="text-muted small mt-3 mb-0 text-center">Espace client ? <a href="/login/client">Connexion client</a></p>
    </div>
</div>
<?= $this->endSection() ?>
