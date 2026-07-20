<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Tableau de bord<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Bonjour, <?= esc($nom) ?></h1>
<p class="page-sub">Vue d'ensemble de votre compte.</p>

<div class="card" style="border-left: 4px solid var(--primary);">
    <p style="margin:0 0 4px;font-size:.85rem;color:var(--muted);font-weight:600;">SOLDE DISPONIBLE</p>
    <p style="margin:0;font-size:2rem;font-weight:700;color:var(--primary);"><?= number_format($solde, 2, ',', ' ') ?> Ar</p>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:20px;">
    <div class="card">
        <p style="margin:0 0 4px;font-size:.75rem;color:var(--muted);font-weight:600;text-transform:uppercase;">Nom</p>
        <p style="margin:0;font-size:1.1rem;font-weight:600;"><?= esc($nom) ?></p>
    </div>
    <div class="card">
        <p style="margin:0 0 4px;font-size:.75rem;color:var(--muted);font-weight:600;text-transform:uppercase;">Numéro</p>
        <p style="margin:0;font-size:1.1rem;font-weight:600;"><?= esc($numero) ?></p>
    </div>
</div>
<?= $this->endSection() ?>
