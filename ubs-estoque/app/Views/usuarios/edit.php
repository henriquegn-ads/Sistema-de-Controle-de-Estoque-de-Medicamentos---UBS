<?php
$titulo = 'Editar usuário';
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
                    <h1 class="page-title">Editar usuário</h1>
                    <p class="page-subtitle">Atualize os dados e o perfil do usuário.</p>
                </div>
            </div>

            <?php if (!empty($erro)): ?>
                <div class="alert alert-error"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <section class="form-card">
                <form method="POST" action="/usuarios/update/<?= (int) $usuario['id'] ?>">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input class="form-control" type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input class="form-control" type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Nova senha</label>
                        <input class="form-control" type="password" id="senha" name="senha" placeholder="Deixe em branco para manter a senha atual">
                    </div>

                    <div class="form-group">
                        <label for="perfil_id">Perfil</label>
                        <select class="form-control" id="perfil_id" name="perfil_id" required>
                            <?php foreach ($perfis as $perfil): ?>
                                <option value="<?= (int) $perfil['id'] ?>" <?= ((int) $usuario['perfil_id'] === (int) $perfil['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($perfil['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Salvar alterações</button>
                        <a href="/usuarios" class="btn-secondary">Cancelar</a>
                    </div>
                </form>
            </section>
        </main>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
