<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Retrait<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-1 fw-bold">Retrait</h1>
<p class="text-muted mb-4">Retirer de l'argent de votre compte.</p>
<div class="card shadow-sm mx-auto" style="max-width:420px">
    <div class="card-body p-4">
        <form method="post" action="/operations/retrait">
            <div class="mb-3">
                <label for="montant" class="form-label fw-semibold">Montant (Ar)</label>
                <input type="number" class="form-control" id="montant" name="montant" min="1" step="0.01" placeholder="10000" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Effectuer le retrait</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
