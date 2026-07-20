<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Historique<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Historique des opérations</h1>
<p class="page-sub">Tous vos mouvements récents.</p>

<?php if (empty($operations)): ?>
    <div class="card">Aucune opération pour le moment.</div>
<?php else: ?>
    <div class="table-wrap">
    <table class="data">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Sens</th>
                <th>Montant</th>
                <th>Frais</th>
                <th>Détail</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($operations as $op): ?>
            <tr>
                <td><?= esc($op['date_mouvement']) ?></td>
                <td><?= esc($op['type_operation']) ?></td>
                <td><span class="badge badge-<?= $op['sens'] === 'CREDIT' ? 'actif' : 'inactif' ?>"><?= $op['sens'] ?></span></td>
                <td><?= number_format($op['montant_mouvement'], 2, ',', ' ') ?> Ar</td>
                <td><?= number_format($op['frais'], 2, ',', ' ') ?> Ar</td>
                <td>
                    <?php if ($op['type_operation'] === 'Transfert' && $op['sens'] === 'DEBIT'): ?>
                        Vers <?= esc($op['dest_nom']) ?>
                    <?php elseif ($op['type_operation'] === 'Transfert' && $op['sens'] === 'CREDIT'): ?>
                        De <?= esc($op['source_nom']) ?>
                    <?php elseif ($op['type_operation'] === 'Retrait' && $op['sens'] === 'CREDIT'): ?>
                        Frais opérateur
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
