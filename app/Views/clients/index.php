<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Clients<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Clients</h1>
<p class="page-sub">Liste des clients enregistrés.</p>

<?php if (empty($clients)): ?>
    <div class="card">Aucun client pour l'instant. <a href="/clients/create">Ajouter le premier.</a></div>
<?php else: ?>
    <div class="table-wrap">
    <table class="data">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Numéro</th>
                <th>Date création</th>
                <th>Statut</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $c): ?>
            <tr>
                <td><?= (int) $c['id'] ?></td>
                <td><?= esc($c['nom']) ?></td>
                <td><?= esc($c['numero']) ?></td>
                <td><?= esc($c['date_creation']) ?></td>
                <td><span class="badge badge-<?= $c['actif'] ? 'actif' : 'inactif' ?>"><?= $c['actif'] ? 'Actif' : 'Inactif' ?></span></td>
                <td><a class="link-danger" href="/clients/delete/<?= (int) $c['id'] ?>" onclick="return confirm('Supprimer ce client ?')">Supprimer</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
