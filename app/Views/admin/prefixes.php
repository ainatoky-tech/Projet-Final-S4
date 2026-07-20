<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Préfixes<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Préfixes</h1>
<p class="page-sub">Gestion des préfixes valides de l'opérateur.</p>

<div class="card form-card" style="margin-bottom:20px;">
    <form method="post" action="/admin/prefixe/store" style="display:flex;gap:10px;">
        <div class="field" style="flex:1;margin:0;">
            <input type="text" name="valeur" placeholder="033" maxlength="3" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<div class="table-wrap">
<table class="data">
    <thead>
        <tr><th>ID</th><th>Préfixe</th><th>Statut</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($prefixes as $p): ?>
        <tr>
            <td><?= (int) $p['id'] ?></td>
            <td><strong><?= esc($p['valeur']) ?></strong></td>
            <td><span class="badge badge-<?= $p['actif'] ? 'actif' : 'inactif' ?>"><?= $p['actif'] ? 'Actif' : 'Inactif' ?></span></td>
            <td><a class="link-danger" href="/admin/prefixe/toggle/<?= (int) $p['id'] ?>"><?= $p['actif'] ? 'Désactiver' : 'Activer' ?></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
