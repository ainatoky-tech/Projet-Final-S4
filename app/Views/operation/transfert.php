<?= $this->extend('layout') ?>
<?= $this->section('title') ?>Transfert<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1 class="page-title">Transfert</h1>
<p class="page-sub">Envoyer de l'argent à un autre client.</p>
<div class="card form-card">
    <form method="post" action="/operations/transfert">
        <div class="field">
            <label for="destinataire">Numéro du destinataire</label>
            <input type="text" id="destinataire" name="destinataire" placeholder="0331111111" required>
        </div>
        <div class="field">
            <label for="montant">Montant (Ar)</label>
            <input type="number" id="montant" name="montant" min="1" step="0.01" placeholder="10000" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Effectuer le transfert</button>
    </form>
</div>
<?= $this->endSection() ?>
