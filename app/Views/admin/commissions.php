<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Commissions<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-1 fw-bold">Commissions</h1>
<p class="text-muted mb-4">Pourcentage de commission par opérateur.</p>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="h6 fw-bold mb-3">Ajouter une commission</h3>
        <form method="post" action="/admin/commission/store" class="row g-2 align-items-end">
            <div class="col-auto">
                <label class="form-label small fw-semibold">Opérateur</label>
                <select name="id_operateur" class="form-select">
                    <?php foreach ($operateurs as $o): ?>
                    <option value="<?= (int) $o['id'] ?>"><?= esc($o['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label small fw-semibold">% Commission</label>
                <input type="number" name="pourcentage" class="form-control" step="0.01" placeholder="5.00" style="width:100px" required>
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
        <tr><th>ID</th><th>Opérateur</th><th>Commission (%)</th><th>Statut</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($commissions as $c): ?>
        <tr>
            <td><?= (int) $c['id'] ?></td>
            <td class="fw-semibold"><?= esc($c['operateur_nom']) ?></td>
            <td><?= number_format($c['pourcentage'], 2) ?> %</td>
            <td><span class="badge <?= $c['actif'] ? 'bg-success' : 'bg-danger' ?>"><?= $c['actif'] ? 'Actif' : 'Inactif' ?></span></td>
            <td><a class="text-danger small" href="/admin/commission/toggle/<?= (int) $c['id'] ?>"><?= $c['actif'] ? 'Désactiver' : 'Activer' ?></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
