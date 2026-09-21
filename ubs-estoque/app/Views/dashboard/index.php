<?php
$titulo = 'Dashboard';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="app-shell">
    <?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>

    <div class="content-area">
        <header class="topbar">
            <button class="hamburger" type="button" onclick="toggleSidebar()" aria-label="Abrir menu">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <div class="user-area">
                <span>Olá, <?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Usuário') ?>!</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="7" r="3.2"/>
                    <path d="M5 21v-2.1a5.9 5.9 0 0 1 11.8 0V21"/>
                </svg>
            </div>
        </header>

        <main class="main-content">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Dashboard</h1>
                    <p class="page-subtitle">Visão geral do inventário e movimentações da UBS.</p>
                </div>
            </div>

            <section class="dashboard-cards">
                <article class="dashboard-card">
                    <div class="dashboard-label">Medicamentos</div>
                    <div class="dashboard-number"><?= (int) ($totalMedicamentos ?? 0) ?></div>
                    <div class="dashboard-text">cadastros</div>
                </article>

                <article class="dashboard-card">
                    <div class="dashboard-label">Abaixo do Mínimo</div>
                    <div class="dashboard-number dashboard-danger"><?= (int) ($abaixoMinimo ?? 0) ?></div>
                    <div class="dashboard-text">itens</div>
                </article>

                <article class="dashboard-card">
                    <div class="dashboard-label">Entradas no Mês</div>
                    <div class="dashboard-number dashboard-green"><?= (int) ($entradasMes ?? 0) ?></div>
                    <div class="dashboard-text">movimentações</div>
                </article>

                <article class="dashboard-card">
                    <div class="dashboard-label">Saídas no Mês</div>
                    <div class="dashboard-number dashboard-dark"><?= (int) ($saidasMes ?? 0) ?></div>
                    <div class="dashboard-text">movimentações</div>
                </article>
            </section>

            <section class="dashboard-section">
                <div class="dashboard-section-header">
                    <h2>Movimentações Recentes</h2>
                </div>

                <div class="table-card">
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Usuário</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" class="empty">Nenhuma movimentação registrada.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>

<style>
.dashboard-cards {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}

.dashboard-card {
    background: #fff;
    border: 1px solid var(--borda);
    border-radius: 8px;
    padding: 16px 18px;
    min-height: 112px;
}

.dashboard-label {
    color: var(--texto-leve);
    font-size: 12.5px;
    font-weight: 700;
    text-transform: uppercase;
}

.dashboard-number {
    color: var(--verde-escuro);
    font-size: 28px;
    font-weight: 700;
    line-height: 1;
    margin-top: 8px;
}

.dashboard-danger { color: #dc2626; }
.dashboard-green { color: var(--verde); }
.dashboard-dark { color: var(--texto); }

.dashboard-text {
    color: var(--texto-leve);
    font-size: 12px;
    margin-top: 6px;
}

.dashboard-section {
    margin-top: 8px;
}

.dashboard-section-header {
    margin-bottom: 12px;
}

.dashboard-section-header h2 {
    color: var(--verde-escuro);
    font-size: 16px;
    font-weight: 700;
    margin: 0;
}

@media (max-width: 1000px) {
    .dashboard-cards {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 600px) {
    .dashboard-cards {
        grid-template-columns: 1fr;
    }
}
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
