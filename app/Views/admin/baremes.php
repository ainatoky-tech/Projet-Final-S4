<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Barèmes<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Barèmes de frais</h1>
<p class="page-sub">Modifier les barèmes par type d'opération et tranche de montant.</p>

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
