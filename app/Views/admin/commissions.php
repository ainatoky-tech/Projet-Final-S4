<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Commissions<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Commissions</h1>
<p class="page-sub">Pourcentage de commission par opérateur.</p>

<div class="card" style="margin-bottom:20px;">
    <h3 style="margin:0 0 12px;font-size:1rem;">Ajouter une commission</h3>
    <form method="post" action="/admin/commission/store" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end;">
        <div class="field" style="margin:0;">
            <label style="font-size:.75rem;">Opérateur</label>
            <select name="id_operateur" style="padding:9px 12px;border:1px solid var(--border);border-radius:10px;">
                <?php foreach ($operateurs as $o): ?>
                <option value="<?= (int) $o['id'] ?>"><?= esc($o['nom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="field" style="margin:0;">
            <label style="font-size:.75rem;">% Commission</label>
            <input type="number" name="pourcentage" step="0.01" placeholder="5.00" style="padding:9px 12px;border:1px solid var(--border);border-radius:10px;width:100px;" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<div class="table-wrap">
<table class="data">
    <thead>
        <tr><th>ID</th><th>Opérateur</th><th>Commission (%)</th><th>Statut</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($commissions as $c): ?>
        <tr>
            <td><?= (int) $c['id'] ?></td>
            <td><strong><?= esc($c['operateur_nom']) ?></strong></td>
            <td><?= number_format($c['pourcentage'], 2) ?> %</td>
            <td><span class="badge badge-<?= $c['actif'] ? 'actif' : 'inactif' ?>"><?= $c['actif'] ? 'Actif' : 'Inactif' ?></span></td>
            <td><a class="link-danger" href="/admin/commission/toggle/<?= (int) $c['id'] ?>"><?= $c['actif'] ? 'Désactiver' : 'Activer' ?></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
