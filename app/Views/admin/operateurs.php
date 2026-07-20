<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Opérateurs<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Opérateurs</h1>
<p class="page-sub">Gestion des opérateurs.</p>

<div class="table-wrap">
<table class="data">
    <thead>
        <tr><th>ID</th><th>Nom</th><th>Statut</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($operateurs as $o): ?>
        <tr>
            <td><?= (int) $o['id'] ?></td>
            <td><strong><?= esc($o['nom']) ?></strong></td>
            <td><span class="badge badge-<?= $o['actif'] ? 'actif' : 'inactif' ?>"><?= $o['actif'] ? 'Actif' : 'Inactif' ?></span></td>
            <td><a class="link-danger" href="/admin/operateur/toggle/<?= (int) $o['id'] ?>"><?= $o['actif'] ? 'Désactiver' : 'Activer' ?></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
