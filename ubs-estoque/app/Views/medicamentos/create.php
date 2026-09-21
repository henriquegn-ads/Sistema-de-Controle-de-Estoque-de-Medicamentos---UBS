<?php
$titulo = 'Novo medicamento';
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
                    <h1 class="page-title">Cadastro de Medicamentos</h1>
                    <p class="page-subtitle">Cadastre um novo medicamento no estoque.</p>
                </div>
            </div>

            <?php if (!empty($erro)): ?>
                <div class="alert alert-error"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <section class="form-card">
                <form method="POST" action="/medicamentos/store">
                    <div class="form-group">
                        <label for="nome">Nome do medicamento</label>
                        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($dados['nome'] ?? '') ?>" class="form-control" placeholder="Ex.: Dipirona 500mg - 100 comp." required>
                    </div>

                    <div class="form-group">
                        <label for="principio_ativo">Princípio ativo</label>
                        <input type="text" id="principio_ativo" name="principio_ativo" value="<?= htmlspecialchars($dados['principio_ativo'] ?? '') ?>" class="form-control" placeholder="Ex.: Dipirona" required>
                    </div>

                    <div class="form-group">
                        <label for="fabricante">Fabricante</label>
                        <input type="text" id="fabricante" name="fabricante" value="<?= htmlspecialchars($dados['fabricante'] ?? '') ?>" class="form-control" placeholder="Ex.: Medley">
                    </div>

                    <div class="form-group">
                        <label for="unidade_medida">Unidade de medida</label>
                        <input type="text" id="unidade_medida" name="unidade_medida" value="<?= htmlspecialchars($dados['unidade_medida'] ?? '') ?>" class="form-control" placeholder="Ex.: Comprimido" required>
                    </div>

                    <div class="form-group">
                        <label for="estoque_minimo">Estoque mínimo</label>
                        <input type="number" id="estoque_minimo" name="estoque_minimo" value="<?= htmlspecialchars($dados['estoque_minimo'] ?? 0) ?>" class="form-control" min="0" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Salvar</button>
                        <a href="/medicamentos" class="btn-secondary">Cancelar</a>
                    </div>
                </form>
            </section>
        </main>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
