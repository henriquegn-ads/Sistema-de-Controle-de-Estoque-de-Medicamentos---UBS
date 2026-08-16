<?php

$titulo = 'Login';

require_once __DIR__ . '/../layouts/header.php';

?>

<main>

    <h1>UBS Estoque</h1>

    <h2>Login</h2>

    <form>

        <div>
            <label for="usuario">
                Usuário
            </label>

            <input
                type="text"
                id="usuario"
                name="usuario"
            >
        </div>

        <div>
            <label for="senha">
                Senha
            </label>

            <input
                type="password"
                id="senha"
                name="senha"
            >
        </div>

        <button type="submit">
            Entrar
        </button>

    </form>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>