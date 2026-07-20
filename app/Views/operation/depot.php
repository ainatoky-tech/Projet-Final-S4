<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Dépôt<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Dépôt</h1>
<p class="page-sub">Créditer votre compte.</p>
<div class="card form-card">
    <form method="post" action="/operations/depot">
        <div class="field">
            <label for="montant">Montant (Ar)</label>
            <input type="number" id="montant" name="montant" min="1" step="0.01" placeholder="10000" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Effectuer le dépôt</button>
    </form>
</div>
<?= $this->endSection() ?>
