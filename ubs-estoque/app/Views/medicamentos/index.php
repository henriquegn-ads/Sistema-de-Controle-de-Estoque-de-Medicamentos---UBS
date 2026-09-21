<?php
$titulo = 'Medicamentos';
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
                    <h1 class="page-title">Medicamentos</h1>
                    <p class="page-subtitle">Medicamentos cadastrados no sistema.</p>
                </div>
                <a href="/medicamentos/create" class="new-button">Novo medicamento</a>
            </div>

            <?php if (!empty($sucesso)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
            <?php endif; ?>

            <?php if (!empty($erro)): ?>
                <div class="alert alert-error"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <div class="filter-box">
                <input type="text" id="filtroMedicamentos" class="filter-input" placeholder="Filtrar medicamentos..." autocomplete="off">
            </div>

            <section class="table-card">
                <div class="table-wrap">
                    <table id="tabelaMedicamentos">
                        <thead>
                            <tr>
                                <th>ID Medicamento</th>
                                <th>Princípio Ativo</th>
                                <th>Fabricante</th>
                                <th>Unidade</th>
                                <th>Estoque Mínimo</th>
                                <th>Saldo Atual</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($medicamentos)): ?>
                                <tr>
                                    <td colspan="7" class="empty">Nenhum medicamento cadastrado.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($medicamentos as $medicamento): ?>
                                    <tr>
                                        <td><?= (int) $medicamento['id'] ?></td>
                                        <td><?= htmlspecialchars($medicamento['principio_ativo'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($medicamento['fabricante'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($medicamento['unidade_medida'] ?? '') ?></td>
                                        <td><?= (int) ($medicamento['estoque_minimo'] ?? 0) ?></td>
                                        <td><?= (int) ($medicamento['saldo_atual'] ?? 0) ?></td>
                                        <td>
                                            <div class="actions">
                                                <a href="/medicamentos/edit/<?= (int) $medicamento['id'] ?>" class="edit-button">Editar</a>
                                                <form method="POST" action="/medicamentos/delete/<?= (int) $medicamento['id'] ?>" onsubmit="return confirm('Deseja realmente excluir este medicamento?');">
                                                    <button type="submit" class="delete-button">Excluir</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</div>

<script>
const filtroMedicamentos = document.getElementById('filtroMedicamentos');

if (filtroMedicamentos) {
    filtroMedicamentos.addEventListener('input', function () {
        const filtro = this.value.toLowerCase().trim();
        const linhas = document.querySelectorAll('#tabelaMedicamentos tbody tr');

        linhas.forEach(function (linha) {
            linha.style.display = linha.textContent.toLowerCase().includes(filtro) ? '' : 'none';
        });
    });
}
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
