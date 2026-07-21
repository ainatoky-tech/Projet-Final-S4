<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Tableau de bord<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-1 fw-bold">Bonjour, <?= esc($nom) ?></h1>
<p class="text-muted mb-4">Vue d'ensemble de votre compte.</p>

<div class="card shadow-sm border-primary mb-4" style="border-left:4px solid !important">
    <div class="card-body">
        <p class="text-muted small fw-semibold mb-1">SOLDE DISPONIBLE</p>
        <p class="fs-2 fw-bold text-primary mb-0"><?= number_format($solde, 2, ',', ' ') ?> Ar</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted small fw-semibold text-uppercase mb-1">Nom</p>
                <p class="fs-5 fw-semibold mb-0"><?= esc($nom) ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted small fw-semibold text-uppercase mb-1">Numéro</p>
                <p class="fs-5 fw-semibold mb-0"><?= esc($numero) ?></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
