<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Administration<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-1 fw-bold">Administration</h1>
<p class="text-muted mb-4">Vue d'ensemble du système.</p>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body">
                <p class="text-muted small fw-semibold text-uppercase mb-1">Clients actifs</p>
                <p class="fs-1 fw-bold text-primary mb-0"><?= (int) $total_clients ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body">
                <p class="text-muted small fw-semibold text-uppercase mb-1">Gains (frais + commission)</p>
                <p class="fs-1 fw-bold text-primary mb-0"><?= number_format($total_gains, 2, ',', ' ') ?> Ar</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body">
                <p class="text-muted small fw-semibold text-uppercase mb-1">Opérations</p>
                <p class="fs-1 fw-bold text-primary mb-0"><?= (int) $total_operations ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <a href="/admin/operateurs" class="card shadow-sm text-decoration-none h-100">
            <div class="card-body">
                <h3 class="h6 fw-bold mb-1">Opérateurs</h3>
                <p class="text-muted small mb-0">Gérer les opérateurs</p>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="/admin/prefixes" class="card shadow-sm text-decoration-none h-100">
            <div class="card-body">
                <h3 class="h6 fw-bold mb-1">Préfixes</h3>
                <p class="text-muted small mb-0">Gérer les préfixes par opérateur</p>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="/admin/commissions" class="card shadow-sm text-decoration-none h-100">
            <div class="card-body">
                <h3 class="h6 fw-bold mb-1">Commissions</h3>
                <p class="text-muted small mb-0">Pourcentage par opérateur</p>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="/admin/baremes" class="card shadow-sm text-decoration-none h-100">
            <div class="card-body">
                <h3 class="h6 fw-bold mb-1">Barèmes de frais</h3>
                <p class="text-muted small mb-0">Modifier les barèmes par tranche</p>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="/admin/gains" class="card shadow-sm text-decoration-none h-100">
            <div class="card-body">
                <h3 class="h6 fw-bold mb-1">Situation des gains</h3>
                <p class="text-muted small mb-0">Frais et commissions</p>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="/admin/comptes" class="card shadow-sm text-decoration-none h-100">
            <div class="card-body">
                <h3 class="h6 fw-bold mb-1">Comptes clients</h3>
                <p class="text-muted small mb-0">Situation des comptes</p>
            </div>
        </a>
    </div>
</div>
<?= $this->endSection() ?>
