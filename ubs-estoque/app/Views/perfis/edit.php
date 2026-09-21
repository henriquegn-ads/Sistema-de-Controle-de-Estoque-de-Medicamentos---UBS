<?php
$titulo = 'Editar Perfil';
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
                    <h1 class="page-title">Editar Perfil</h1>
                    <p class="page-subtitle">
                        Atualize as informações do perfil de acesso.
                    </p>
                </div>
            </div>

            <?php if (!empty($erro)): ?>
                <div class="alert-error">
                    <?= htmlspecialchars($erro) ?>
                </div>
            <?php endif; ?>

            <div class="form-card">

                <form method="POST" action="/perfis/update/<?= (int) $perfil['id'] ?>">

                    <div class="form-group">
                        <label for="nome">Nome do Perfil</label>

                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            class="form-control"
                            value="<?= htmlspecialchars($_POST['nome'] ?? $perfil['nome']) ?>"
                            required
                        >
                    </div>

                    <div class="form-actions">

                        <a href="/perfis" class="btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn-primary">
                            Salvar Alterações
                        </button>

                    </div>

                </form>

            </div>

        </main>
    </div>
</div>

<style>
.form-card {
    max-width: 700px;
    background: #fff;
    border: 1px solid var(--borda);
    border-radius: 8px;
    padding: 24px;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 7px;
    color: #174f52;
    font-size: 14px;
    font-weight: 600;
}

.form-control {
    width: 100%;
    height: 42px;
    padding: 0 12px;
    border: 1px solid #78b9b2;
    border-radius: 7px;
    background: #fff;
    color: #315e60;
    font-size: 14px;
    box-sizing: border-box;
    outline: none;
}

.form-control:focus {
    border-color: #087f73;
    box-shadow: 0 0 0 2px rgba(8, 127, 115, 0.10);
}

.textarea {
    height: auto;
    padding: 11px 12px;
    resize: vertical;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 24px;
}

.btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 42px;
    padding: 0 18px;
    border: 1px solid #78b9b2;
    border-radius: 7px;
    background: #fff;
    color: #174f52;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.btn-primary {
    min-height: 42px;
    padding: 0 18px;
    border: none;
    border-radius: 7px;
    background: #087f73;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

.btn-primary:hover {
    background: #076b62;
}

.alert-error {
    max-width: 700px;
    margin-bottom: 18px;
    padding: 11px 14px;
    border-radius: 7px;
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #b91c1c;
    font-size: 14px;
}
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>