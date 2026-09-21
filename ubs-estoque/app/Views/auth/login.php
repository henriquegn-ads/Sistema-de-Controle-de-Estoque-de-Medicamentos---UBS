<?php
$titulo = 'Login';
require_once __DIR__ . '/../layouts/header.php';
?>

<style>
    body {
        background: #eef5f5;
    }

    .login-container {
        min-height: calc(100vh - 1px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 20px;
    }

    .login-card {
        width: 100%;
        max-width: 430px;
        background: #fff;
        border-radius: 16px;
        padding: 32px 36px;
        box-shadow: 0 10px 28px rgba(0, 55, 55, 0.12);
        box-sizing: border-box;
    }

    .login-logo {
        display: block;
        width: 220px;
        max-width: 80%;
        margin: 0 auto 28px;
    }

    .login-error {
        margin-bottom: 18px;
        padding: 11px 14px;
        border-radius: 8px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        font-size: 14px;
        line-height: 1.4;
    }

    .login-group {
        margin-bottom: 18px;
    }

    .login-label {
        display: block;
        margin-bottom: 7px;
        color: #063f43;
        font-size: 16px;
        font-weight: 600;
    }

    .login-input {
        width: 100%;
        height: 44px;
        padding: 0 13px;
        border: 1px solid #3aa59a;
        border-radius: 8px;
        background: #fff;
        color: #063f43;
        font-size: 15px;
        outline: none;
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .login-input::placeholder {
        color: #86bdb9;
    }

    .login-input:focus {
        border-color: #087f73;
        box-shadow: 0 0 0 3px rgba(8, 127, 115, 0.10);
    }

    .senha-wrapper {
        position: relative;
    }

    .senha-wrapper .login-input {
        padding-right: 44px;
    }

    .senha-toggle {
        position: absolute;
        top: 0;
        right: 0;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 0;
        background: transparent;
        color: #063f43;
        cursor: pointer;
        padding: 0;
    }

    .senha-toggle svg {
        width: 20px;
        height: 20px;
    }

    .login-button {
        width: 100%;
        height: 44px;
        margin-top: 4px;
        border: 0;
        border-radius: 8px;
        background: #087f73;
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }

    .login-button:hover {
        background: #076b62;
    }

    .login-forgot {
        margin-top: 18px;
        text-align: center;
        color: #0284c7;
        font-size: 14px;
    }

    @media (max-width: 600px) {
        .login-container {
            padding: 24px 16px;
        }

        .login-card {
            max-width: 400px;
            padding: 28px 24px;
        }

        .login-logo {
            width: 200px;
            margin-bottom: 24px;
        }
    }
</style>

<div class="login-container">

    <div class="login-card">

        <img
            src="/images/logo-ubs.png?v=2"
            alt="UBS Estoque"
            class="login-logo"
        >

        <?php if (!empty($erro)): ?>
            <div class="login-error">
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/login">

            <div class="login-group">
                <label for="email" class="login-label">
                    Login
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Usuário"
                    autocomplete="username"
                    class="login-input"
                    required
                >
            </div>

            <div class="login-group">
                <label for="senha" class="login-label">
                    Senha
                </label>

                <div class="senha-wrapper">

                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Senha"
                        autocomplete="current-password"
                        class="login-input"
                        required
                    >

                    <button
                        type="button"
                        onclick="alternarSenha()"
                        aria-label="Mostrar ou ocultar senha"
                        class="senha-toggle"
                    >
                        <svg
                            id="iconeOlho"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12Z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                            />
                        </svg>
                    </button>

                </div>
            </div>

            <button
                type="submit"
                class="login-button"
            >
                Entrar
            </button>

        </form>

        <div class="login-forgot">
            Esqueceu sua senha?
        </div>

    </div>

</div>

<script>
function alternarSenha() {
    const campo = document.getElementById('senha');
    campo.type = campo.type === 'password' ? 'text' : 'password';
}
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>