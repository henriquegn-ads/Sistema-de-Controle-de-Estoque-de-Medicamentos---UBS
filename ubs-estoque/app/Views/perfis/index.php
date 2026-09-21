<?php
$titulo = 'Perfis de Acesso';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="app-shell">
    <?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>

    <div class="content-area">

        <header class="topbar">
            <button
                class="hamburger"
                type="button"
                onclick="toggleSidebar()"
                aria-label="Abrir menu"
            >
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <div class="user-area">
                <span>
                    Olá, <?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Utilizador') ?>!
                </span>

                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="7" r="3"/>
                    <path d="M5 21v-2a5 5 0 0 1 10 0v2"/>
                </svg>
            </div>
        </header>

        <main class="main-content">

            <div class="page-header">
                <div>
                    <h1 class="page-title">Perfis de Acesso</h1>
                    <p class="page-subtitle">
                        Gerencie os perfis de acesso dos usuários do sistema.
                    </p>
                </div>

                <a href="/perfis/create" class="btn-primary">
                    + Novo Perfil
                </a>
            </div>

            <?php if (!empty($_SESSION['sucesso_perfil'])): ?>

                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['sucesso_perfil']) ?>
                </div>

                <?php unset($_SESSION['sucesso_perfil']); ?>

            <?php endif; ?>

            <?php if (!empty($_SESSION['erro_perfil'])): ?>

                <div class="alert alert-error">
                    <?= htmlspecialchars($_SESSION['erro_perfil']) ?>
                </div>

                <?php unset($_SESSION['erro_perfil']); ?>

            <?php endif; ?>

            <form method="GET" action="/perfis" class="filter-box">

                <input
                    type="text"
                    name="busca"
                    value="<?= htmlspecialchars($busca ?? '') ?>"
                    placeholder="Buscar perfil"
                    class="filter-input"
                >

            </form>

            <div class="table-card">

                <div class="table-wrap">

                    <table>

                        <thead>
                            <tr>
                                <th>Perfil</th>
                                <th>Usuários</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (empty($perfis)): ?>

                                <tr>
                                    <td colspan="3" class="empty">
                                        Nenhum perfil encontrado.
                                    </td>
                                </tr>

                            <?php else: ?>

                                <?php foreach ($perfis as $perfil): ?>

                                    <tr>

                                        <td>
                                            <?= htmlspecialchars($perfil['nome']) ?>
                                        </td>

                                        <td>
                                            <?= (int) ($perfil['total_usuarios'] ?? 0) ?>
                                        </td>

                                        <td>

                                            <div class="actions">

                                                <a
                                                    href="/perfis/edit/<?= (int) $perfil['id'] ?>"
                                                    class="edit-button"
                                                >
                                                    Editar
                                                </a>

                                                <?php if ((int) $perfil['id'] === 1): ?>

                                                    <span
                                                        class="delete-button"
                                                        style="opacity: 0.5; cursor: not-allowed;"
                                                    >
                                                        Excluir
                                                    </span>

                                                <?php else: ?>

                                                    <form
                                                        method="POST"
                                                        action="/perfis/delete/<?= (int) $perfil['id'] ?>"
                                                        onsubmit="return confirmarExclusao();"
                                                        style="margin: 0;"
                                                    >
                                                        <button
                                                            type="submit"
                                                            class="delete-button"
                                                        >
                                                            Excluir
                                                        </button>
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

            </div>

        </main>

    </div>
</div>

<script>
function confirmarExclusao() {
    return confirm('Tem certeza que deseja excluir este perfil?');
}
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>