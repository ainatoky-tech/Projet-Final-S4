<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Gains<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-1 fw-bold">Situation des gains</h1>
<p class="text-muted mb-4">Revenus générés par les frais d'opération.</p>

<div class="card shadow-sm border-primary mb-4" style="border-left:4px solid !important">
    <div class="card-body">
        <p class="text-muted small fw-semibold mb-1">TOTAL GLOBAL</p>
        <p class="fs-2 fw-bold text-primary mb-0"><?= number_format($total_global, 2, ',', ' ') ?> Ar</p>
    </div>
</div>

<div class="table-responsive">
<table class="table table-bordered bg-white shadow-sm">
    <thead class="table-light">
        <tr><th>Type d'opération</th><th>Nombre</th><th>Total frais</th><th>Total commission</th><th>Total</th></tr>
    </thead>
    <tbody>
        <?php foreach ($gains as $g): ?>
        <tr>
            <td class="fw-semibold"><?= esc($g['type_operation']) ?></td>
            <td><?= (int) $g['nombre'] ?></td>
            <td><?= number_format($g['total_frais'], 2, ',', ' ') ?> Ar</td>
            <td><?= number_format($g['total_commission'], 2, ',', ' ') ?> Ar</td>
            <td class="fw-bold"><?= number_format($g['total'], 2, ',', ' ') ?> Ar</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
