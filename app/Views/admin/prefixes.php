<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Préfixes<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-1 fw-bold">Préfixes</h1>
<p class="text-muted mb-4">Gestion des préfixes par opérateur.</p>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="h6 fw-bold mb-3">Ajouter un préfixe</h3>
        <form method="post" action="/admin/prefixe/store" class="row g-2 align-items-end">
            <div class="col-auto">
                <label class="form-label small fw-semibold">Opérateur</label>
                <select name="id_operateur" class="form-select">
                    <?php foreach ($operateurs as $o): ?>
                    <option value="<?= (int) $o['id'] ?>"><?= esc($o['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label small fw-semibold">Préfixe</label>
                <input type="text" name="valeur" class="form-control" placeholder="033" maxlength="3" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive">
<table class="table table-bordered bg-white shadow-sm">
    <thead class="table-light">
        <tr><th>ID</th><th>Opérateur</th><th>Préfixe</th><th>Statut</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($prefixes as $p): ?>
        <tr>
            <td><?= (int) $p['id'] ?></td>
            <td><?= esc($p['operateur_nom']) ?></td>
            <td class="fw-semibold"><?= esc($p['valeur']) ?></td>
            <td><span class="badge <?= $p['actif'] ? 'bg-success' : 'bg-danger' ?>"><?= $p['actif'] ? 'Actif' : 'Inactif' ?></span></td>
            <td><a class="text-danger small" href="/admin/prefixe/toggle/<?= (int) $p['id'] ?>"><?= $p['actif'] ? 'Désactiver' : 'Activer' ?></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
