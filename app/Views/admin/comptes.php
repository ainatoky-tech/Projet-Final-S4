<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Comptes clients<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-1 fw-bold">Comptes clients</h1>
<p class="text-muted mb-4">Situation des comptes clients.</p>

<div class="table-responsive">
<table class="table table-bordered bg-white shadow-sm">
    <thead class="table-light">
        <tr><th>ID</th><th>Nom</th><th>Numéro</th><th>Solde</th><th>Statut</th></tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $c): ?>
        <tr>
            <td><?= (int) $c['id'] ?></td>
            <td><?= esc($c['nom']) ?></td>
            <td><?= esc($c['numero']) ?></td>
            <td class="fw-bold"><?= number_format($c['solde'], 2, ',', ' ') ?> Ar</td>
            <td><span class="badge <?= $c['client_actif'] ? 'bg-success' : 'bg-danger' ?>"><?= $c['client_actif'] ? 'Actif' : 'Inactif' ?></span></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
