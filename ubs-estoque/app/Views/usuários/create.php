<?php

$titulo = 'Novo usuário';

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<main class="max-w-5xl mx-auto px-6 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Novo usuário</h1>
        <p class="text-slate-500 mt-1">Cadastre um usuário e defina seu perfil.</p>
    </div>

    <?php if (!empty($erro)): ?>
        <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-red-700">
            <?= htmlspecialchars($erro) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($sucesso)): ?>
        <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-700">
            <?= htmlspecialchars($sucesso) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/ubs-estoque/public/usuarios/store" class="bg-white rounded-xl shadow-sm p-6 space-y-5">
        <div>
            <label for="nome" class="block text-sm font-medium text-slate-700 mb-1">Nome</label>
            <input type="text" id="nome" name="nome" class="w-full rounded-lg border border-slate-300 px-4 py-2" required>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">E-mail</label>
            <input type="email" id="email" name="email" class="w-full rounded-lg border border-slate-300 px-4 py-2" required>
        </div>

        <div>
            <label for="senha" class="block text-sm font-medium text-slate-700 mb-1">Senha</label>
            <input type="password" id="senha" name="senha" class="w-full rounded-lg border border-slate-300 px-4 py-2" required>
        </div>

        <div>
            <label for="perfil_id" class="block text-sm font-medium text-slate-700 mb-1">Perfil</label>
            <select id="perfil_id" name="perfil_id" class="w-full rounded-lg border border-slate-300 px-4 py-2" required>
                <option value="">Selecione</option>
                <?php foreach ($perfis as $perfil): ?>
                    <option value="<?= (int) $perfil['id'] ?>">
                        <?= htmlspecialchars($perfil['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="rounded-lg bg-slate-800 px-5 py-2 text-white hover:bg-slate-700">
            Cadastrar usuário
        </button>
    </form>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
