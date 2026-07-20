<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Administration<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Administration</h1>
<p class="page-sub">Vue d'ensemble du système.</p>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;">
    <div class="card" style="text-align:center;">
        <p style="margin:0 0 4px;font-size:.75rem;color:var(--muted);font-weight:600;text-transform:uppercase;">Clients actifs</p>
        <p style="margin:0;font-size:1.8rem;font-weight:700;color:var(--primary);"><?= (int) $total_clients ?></p>
    </div>
    <div class="card" style="text-align:center;">
        <p style="margin:0 0 4px;font-size:.75rem;color:var(--muted);font-weight:600;text-transform:uppercase;">Gains (frais)</p>
        <p style="margin:0;font-size:1.8rem;font-weight:700;color:var(--primary);"><?= number_format($total_gains, 2, ',', ' ') ?> Ar</p>
    </div>
    <div class="card" style="text-align:center;">
        <p style="margin:0 0 4px;font-size:.75rem;color:var(--muted);font-weight:600;text-transform:uppercase;">Opérations</p>
        <p style="margin:0;font-size:1.8rem;font-weight:700;color:var(--primary);"><?= (int) $total_operations ?></p>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:20px;">
    <a href="/admin/prefixes" class="card" style="display:block;text-decoration:none;color:inherit;">
        <h3 style="margin:0 0 4px;">Préfixes</h3>
        <p style="margin:0;color:var(--muted);font-size:.85rem;">Gérer les préfixes opérateur</p>
    </a>
    <a href="/admin/baremes" class="card" style="display:block;text-decoration:none;color:inherit;">
        <h3 style="margin:0 0 4px;">Barèmes de frais</h3>
        <p style="margin:0;color:var(--muted);font-size:.85rem;">Modifier les barèmes par tranche</p>
    </a>
    <a href="/admin/gains" class="card" style="display:block;text-decoration:none;color:inherit;">
        <h3 style="margin:0 0 4px;">Situation des gains</h3>
        <p style="margin:0;color:var(--muted);font-size:.85rem;">Gains via les frais</p>
    </a>
    <a href="/admin/comptes" class="card" style="display:block;text-decoration:none;color:inherit;">
        <h3 style="margin:0 0 4px;">Comptes clients</h3>
        <p style="margin:0;color:var(--muted);font-size:.85rem;">Situation des comptes</p>
    </a>
</div>
<?= $this->endSection() ?>
