<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?> · Mobile Money</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <style>
        body{background:#F6F7FB}
        .brand-logo{width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#4F46E5,#7C73FF);display:grid;place-items:center;color:#fff;font-weight:800;font-size:.9rem}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
        <div class="container">
            <a href="/" class="navbar-brand d-flex align-items-center gap-2 fw-bold text-dark">
                <span class="brand-logo">M</span> Mobile Money
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <?php if (session()->get('logged_in')): ?>
                        <?php if (session()->get('user_type') === 'client'): ?>
                            <li class="nav-item"><a class="nav-link" href="/dashboard">Tableau de bord</a></li>
                            <li class="nav-item"><a class="nav-link" href="/operations/depot">Dépôt</a></li>
                            <li class="nav-item"><a class="nav-link" href="/operations/retrait">Retrait</a></li>
                            <li class="nav-item"><a class="nav-link" href="/operations/transfert">Transfert</a></li>
                            <li class="nav-item"><a class="nav-link" href="/operations/historiques">Historique</a></li>
                            <li class="nav-item"><span class="nav-link text-muted"><?= esc(session()->get('nom')) ?></span></li>
                        <?php elseif (session()->get('user_type') === 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="/admin/dashboard">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="/admin/operateurs">Opérateurs</a></li>
                            <li class="nav-item"><a class="nav-link" href="/admin/prefixes">Préfixes</a></li>
                            <li class="nav-item"><a class="nav-link" href="/admin/commissions">Commissions</a></li>
                            <li class="nav-item"><a class="nav-link" href="/admin/baremes">Barèmes</a></li>
                            <li class="nav-item"><a class="nav-link" href="/admin/gains">Gains</a></li>
                            <li class="nav-item"><a class="nav-link" href="/admin/comptes">Comptes</a></li>
                            <li class="nav-item"><span class="nav-link text-muted"><?= esc(session()->get('login')) ?></span></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="/logout">Déconnexion</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/login/client">Client</a></li>
                        <li class="nav-item"><a class="nav-link" href="/login/admin">Admin</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('message')) ?></div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-light text-muted py-3 text-center small border-top">
        Mobile Money — Projet S4 · CodeIgniter 4 + SQLite
    </footer>

    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
