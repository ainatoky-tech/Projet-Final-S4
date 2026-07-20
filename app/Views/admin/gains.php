<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Gains<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Situation des gains</h1>
<p class="page-sub">Revenus générés par les frais d'opération.</p>

<div class="card" style="border-left:4px solid var(--primary);margin-bottom:20px;">
    <p style="margin:0 0 4px;font-size:.85rem;color:var(--muted);font-weight:600;">TOTAL GLOBAL</p>
    <p style="margin:0;font-size:2rem;font-weight:700;color:var(--primary);"><?= number_format($total_global, 2, ',', ' ') ?> Ar</p>
</div>

<div class="table-wrap">
<table class="data">
    <thead>
        <tr><th>Type d'opération</th><th>Nombre</th><th>Total frais</th><th>Total commission</th><th>Total</th></tr>
    </thead>
    <tbody>
        <?php foreach ($gains as $g): ?>
        <tr>
            <td><strong><?= esc($g['type_operation']) ?></strong></td>
            <td><?= (int) $g['nombre'] ?></td>
            <td><?= number_format($g['total_frais'], 2, ',', ' ') ?> Ar</td>
            <td><?= number_format($g['total_commission'], 2, ',', ' ') ?> Ar</td>
            <td><strong><?= number_format($g['total'], 2, ',', ' ') ?> Ar</strong></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
