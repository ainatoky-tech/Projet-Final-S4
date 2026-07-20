<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Barèmes<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Barèmes de frais</h1>
<p class="page-sub">Modifier les barèmes par type d'opération et tranche de montant.</p>

<div class="card" style="margin-bottom:20px;">
    <h3 style="margin:0 0 12px;font-size:1rem;">Ajouter un barème</h3>
    <form method="post" action="/admin/bareme/store" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end;">
        <div class="field" style="margin:0;">
            <label style="font-size:.75rem;">Type</label>
            <select name="id_type_operation" style="padding:9px 12px;border:1px solid var(--border);border-radius:10px;">
                <?php foreach ($types as $t): ?>
                <option value="<?= (int) $t['id'] ?>"><?= esc($t['libelle']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="field" style="margin:0;">
            <label style="font-size:.75rem;">Min (Ar)</label>
            <input type="number" name="montant_min" step="0.01" placeholder="0" style="padding:9px 12px;border:1px solid var(--border);border-radius:10px;width:100px;" required>
        </div>
        <div class="field" style="margin:0;">
            <label style="font-size:.75rem;">Max (Ar)</label>
            <input type="number" name="montant_max" step="0.01" placeholder="10000" style="padding:9px 12px;border:1px solid var(--border);border-radius:10px;width:100px;" required>
        </div>
        <div class="field" style="margin:0;">
            <label style="font-size:.75rem;">Frais (Ar)</label>
            <input type="number" name="frais" step="0.01" placeholder="200" style="padding:9px 12px;border:1px solid var(--border);border-radius:10px;width:100px;" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<div class="table-wrap">
<table class="data">
    <thead>
        <tr><th>Type</th><th>Min (Ar)</th><th>Max (Ar)</th><th>Frais (Ar)</th><th>Statut</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($baremes as $b): ?>
        <tr>
            <form method="post" action="/admin/bareme/update/<?= (int) $b['id'] ?>">
            <td><strong><?= esc($b['type_libelle']) ?></strong></td>
            <td><input type="number" name="montant_min" value="<?= (float) $b['montant_min'] ?>" step="0.01" style="width:100px;padding:6px 8px;border:1px solid var(--border);border-radius:6px;"></td>
            <td><input type="number" name="montant_max" value="<?= (float) $b['montant_max'] ?>" step="0.01" style="width:100px;padding:6px 8px;border:1px solid var(--border);border-radius:6px;"></td>
            <td><input type="number" name="frais" value="<?= (float) $b['frais'] ?>" step="0.01" style="width:100px;padding:6px 8px;border:1px solid var(--border);border-radius:6px;"></td>
            <td>
                <select name="actif" style="padding:6px 8px;border:1px solid var(--border);border-radius:6px;">
                    <option value="1" <?= $b['actif'] ? 'selected' : '' ?>>Actif</option>
                    <option value="0" <?= !$b['actif'] ? 'selected' : '' ?>>Inactif</option>
                </select>
            </td>
            <td><button type="submit" class="btn btn-primary" style="padding:6px 14px;font-size:.8rem;">Modifier</button></td>
            </form>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
