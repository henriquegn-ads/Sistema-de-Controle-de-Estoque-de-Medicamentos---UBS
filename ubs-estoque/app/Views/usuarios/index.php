<?php
$titulo = 'Usuários';
require_once __DIR__ . '/../layouts/header.php';

$sucesso = $_SESSION['sucesso_usuario'] ?? null;
$erro = $_SESSION['erro_usuario'] ?? null;
unset($_SESSION['sucesso_usuario'], $_SESSION['erro_usuario']);
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
                    <h1 class="page-title">Usuários</h1>
                    <p class="page-subtitle">Gerencie os usuários e seus perfis de acesso.</p>
                </div>
                <a href="/usuarios/create" class="new-button">+ Novo usuário</a>
            </div>

            <?php if ($sucesso): ?>
                <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
            <?php endif; ?>

            <?php if ($erro): ?>
                <div class="alert alert-error"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <div class="filter-box">
                <input class="filter-input" type="text" id="filtroUsuarios" placeholder="Buscar usuário..." autocomplete="off">
            </div>

            <section class="table-card">
                <div class="table-wrap">
                    <table id="tabelaUsuarios">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Perfil</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($usuarios)): ?>
                                <tr>
                                    <td colspan="4" class="empty">Nenhum usuário cadastrado.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <?php $ativo = (int) $usuario['ativo'] === 1; ?>
                                    <tr>
                                        <td>
                                            <strong><?= htmlspecialchars($usuario['nome']) ?></strong><br>
                                            <span style="color:var(--texto-leve);font-size:12px;"><?= htmlspecialchars($usuario['email']) ?></span>
                                        </td>
                                        <td><?= htmlspecialchars($usuario['perfil_nome']) ?></td>
                                        <td>
                                            <span class="badge <?= $ativo ? 'badge-ativo' : 'badge-inativo' ?>">
                                                <?= $ativo ? 'Ativo' : 'Inativo' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="/usuarios/edit/<?= (int) $usuario['id'] ?>" class="edit-button">Editar</a>

                                                <?php if ((int) $usuario['id'] !== (int) ($_SESSION['usuario_id'] ?? 0)): ?>
                                                    <form method="POST" action="/usuarios/status/<?= (int) $usuario['id'] ?>">
                                                        <button type="submit" class="edit-button">
                                                            <?= $ativo ? 'Inativar' : 'Ativar' ?>
                                                        </button>
                                                    </form>

                                                    <form method="POST" action="/usuarios/delete/<?= (int) $usuario['id'] ?>" onsubmit="return confirm('Deseja realmente excluir este usuário?');">
                                                        <button type="submit" class="delete-button">Excluir</button>
                                                    </form>
                                                <?php endif; ?>
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
const filtroUsuarios = document.getElementById('filtroUsuarios');

if (filtroUsuarios) {
    filtroUsuarios.addEventListener('input', function () {
        const filtro = this.value.toLowerCase().trim();
        const linhas = document.querySelectorAll('#tabelaUsuarios tbody tr');

        linhas.forEach(function (linha) {
            linha.style.display = linha.textContent.toLowerCase().includes(filtro) ? '' : 'none';
        });
    });
}
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
