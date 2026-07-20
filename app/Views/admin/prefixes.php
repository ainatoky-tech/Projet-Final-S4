<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Préfixes<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Préfixes</h1>
<p class="page-sub">Gestion des préfixes par opérateur.</p>

<div class="card" style="margin-bottom:20px;">
    <h3 style="margin:0 0 12px;font-size:1rem;">Ajouter un préfixe</h3>
    <form method="post" action="/admin/prefixe/store" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end;">
        <div class="field" style="margin:0;">
            <label style="font-size:.75rem;">Opérateur</label>
            <select name="id_operateur" style="padding:9px 12px;border:1px solid var(--border);border-radius:10px;">
                <?php foreach ($operateurs as $o): ?>
                <option value="<?= (int) $o['id'] ?>"><?= esc($o['nom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="field" style="margin:0;">
            <label style="font-size:.75rem;">Préfixe</label>
            <input type="text" name="valeur" placeholder="033" maxlength="3" style="padding:9px 12px;border:1px solid var(--border);border-radius:10px;" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<div class="table-wrap">
<table class="data">
    <thead>
        <tr><th>ID</th><th>Opérateur</th><th>Préfixe</th><th>Statut</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($prefixes as $p): ?>
        <tr>
            <td><?= (int) $p['id'] ?></td>
            <td><?= esc($p['operateur_nom']) ?></td>
            <td><strong><?= esc($p['valeur']) ?></strong></td>
            <td><span class="badge badge-<?= $p['actif'] ? 'actif' : 'inactif' ?>"><?= $p['actif'] ? 'Actif' : 'Inactif' ?></span></td>
            <td><a class="link-danger" href="/admin/prefixe/toggle/<?= (int) $p['id'] ?>"><?= $p['actif'] ? 'Désactiver' : 'Activer' ?></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
