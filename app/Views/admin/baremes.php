<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Barèmes<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-1 fw-bold">Barèmes de frais</h1>
<p class="text-muted mb-4">Modifier les barèmes par type d'opération et tranche de montant.</p>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="h6 fw-bold mb-3">Ajouter un barème</h3>
        <form method="post" action="/admin/bareme/store" class="row g-2 align-items-end">
            <div class="col-auto">
                <label class="form-label small fw-semibold">Type</label>
                <select name="id_type_operation" class="form-select">
                    <?php foreach ($types as $t): ?>
                    <option value="<?= (int) $t['id'] ?>"><?= esc($t['libelle']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label small fw-semibold">Min (Ar)</label>
                <input type="number" name="montant_min" class="form-control" step="0.01" placeholder="0" style="width:100px" required>
            </div>
            <div class="col-auto">
                <label class="form-label small fw-semibold">Max (Ar)</label>
                <input type="number" name="montant_max" class="form-control" step="0.01" placeholder="10000" style="width:100px" required>
            </div>
            <div class="col-auto">
                <label class="form-label small fw-semibold">Frais (Ar)</label>
                <input type="number" name="frais" class="form-control" step="0.01" placeholder="200" style="width:100px" required>
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
        <tr><th>Type</th><th>Min (Ar)</th><th>Max (Ar)</th><th>Frais (Ar)</th><th>Statut</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($baremes as $b): ?>
        <tr>
            <form method="post" action="/admin/bareme/update/<?= (int) $b['id'] ?>">
            <td class="fw-semibold"><?= esc($b['type_libelle']) ?></td>
            <td><input type="number" name="montant_min" value="<?= (float) $b['montant_min'] ?>" step="0.01" class="form-control form-control-sm" style="width:100px"></td>
            <td><input type="number" name="montant_max" value="<?= (float) $b['montant_max'] ?>" step="0.01" class="form-control form-control-sm" style="width:100px"></td>
            <td><input type="number" name="frais" value="<?= (float) $b['frais'] ?>" step="0.01" class="form-control form-control-sm" style="width:100px"></td>
            <td>
                <select name="actif" class="form-select form-select-sm">
                    <option value="1" <?= $b['actif'] ? 'selected' : '' ?>>Actif</option>
                    <option value="0" <?= !$b['actif'] ? 'selected' : '' ?>>Inactif</option>
                </select>
            </td>
            <td><button type="submit" class="btn btn-primary btn-sm">Modifier</button></td>
            </form>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
