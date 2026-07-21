<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Opérateurs<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-1 fw-bold">Opérateurs</h1>
<p class="text-muted mb-4">Gestion des opérateurs.</p>

<div class="table-responsive">
<table class="table table-bordered bg-white shadow-sm">
    <thead class="table-light">
        <tr><th>ID</th><th>Nom</th><th>Statut</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($operateurs as $o): ?>
        <tr>
            <td><?= (int) $o['id'] ?></td>
            <td class="fw-semibold"><?= esc($o['nom']) ?></td>
            <td><span class="badge <?= $o['actif'] ? 'bg-success' : 'bg-danger' ?>"><?= $o['actif'] ? 'Actif' : 'Inactif' ?></span></td>
            <td><a class="text-danger small" href="/admin/operateur/toggle/<?= (int) $o['id'] ?>"><?= $o['actif'] ? 'Désactiver' : 'Activer' ?></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
