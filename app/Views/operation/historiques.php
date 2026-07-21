<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Historique<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-1 fw-bold">Historique des opérations</h1>
<p class="text-muted mb-4">Tous vos mouvements récents.</p>

<?php if (empty($operations)): ?>
    <div class="card shadow-sm">
        <div class="card-body text-muted">Aucune opération pour le moment.</div> 
    </div>
<?php else: ?>
    <div class="table-responsive">
    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Sens</th>
                <th>Montant</th>
                <th>Frais</th>
                <th>Commission</th>
                <th>Détail</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($operations as $op): ?>
            <tr>
                <td><?= esc($op['date_mouvement']) ?></td>
                <td><?= esc($op['type_operation']) ?></td>
                <td><span class="badge <?= $op['sens'] === 'CREDIT' ? 'bg-success' : 'bg-danger' ?>"><?= $op['sens'] ?></span></td>
                <td><?= number_format($op['montant_mouvement'], 2, ',', ' ') ?> Ar</td>
                <td><?= number_format($op['frais'], 2, ',', ' ') ?> Ar</td>
                <td><?= number_format($op['commission'], 2, ',', ' ') ?> Ar</td>
                <td>
                    <?php if ($op['type_operation'] === 'Transfert' && $op['numero_destination'] && $op['sens'] === 'DEBIT'): ?>
                        Vers <?= esc($op['numero_destination']) ?>
                    <?php elseif ($op['type_operation'] === 'Retrait' && $op['sens'] === 'CREDIT'): ?>
                        Frais opérateur
                    <?php elseif ($op['type_operation'] === 'Transfert' && $op['sens'] === 'CREDIT'): ?>
                        Commission opérateur
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
