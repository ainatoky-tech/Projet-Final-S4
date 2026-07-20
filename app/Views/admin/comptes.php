<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Comptes clients<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Comptes clients</h1>
<p class="page-sub">Situation des comptes clients.</p>

<div class="table-wrap">
<table class="data">
    <thead>
        <tr><th>ID</th><th>Nom</th><th>Numéro</th><th>Solde</th><th>Statut</th></tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $c): ?>
        <tr>
            <td><?= (int) $c['id'] ?></td>
            <td><?= esc($c['nom']) ?></td>
            <td><?= esc($c['numero']) ?></td>
            <td><strong><?= number_format($c['solde'], 2, ',', ' ') ?> Ar</strong></td>
            <td><span class="badge badge-<?= $c['client_actif'] ? 'actif' : 'inactif' ?>"><?= $c['client_actif'] ? 'Actif' : 'Inactif' ?></span></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
