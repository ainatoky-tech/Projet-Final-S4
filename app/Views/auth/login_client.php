<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Connexion Client<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-1 fw-bold">Connexion Client</h1>
<p class="text-muted mb-4">Entrez votre numéro de téléphone.</p>
<div class="card shadow-sm mx-auto" style="max-width:420px">
    <div class="card-body p-4">
        <form method="post" action="/login/client">
            <div class="mb-3">
                <label for="numero" class="form-label fw-semibold">Numéro de téléphone</label>
                <input type="text" class="form-control" id="numero" name="numero" placeholder="0331234567" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </form>
        <p class="text-muted small mt-3 mb-0 text-center">Espace admin ? <a href="/login/admin">Connexion administrateur</a></p>
    </div>
</div>
<?= $this->endSection() ?>
