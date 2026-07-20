<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Retrait<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Retrait</h1>
<p class="page-sub">Retirer de l'argent de votre compte.</p>
<div class="card form-card">
    <form method="post" action="/operations/retrait">
        <div class="field">
            <label for="montant">Montant (Ar)</label>
            <input type="number" id="montant" name="montant" min="1" step="0.01" placeholder="10000" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Effectuer le retrait</button>
    </form>
</div>
<?= $this->endSection() ?>
