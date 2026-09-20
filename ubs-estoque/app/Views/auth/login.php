<?php

$titulo = 'Login';

require_once __DIR__ . '/../layouts/header.php';
?>

<div class="min-h-screen flex items-center justify-center px-6">
    <div class="w-full max-w-md bg-white rounded-xl shadow-sm p-8">
        <h1 class="text-2xl font-bold text-slate-800">UBS Estoque</h1>
        <p class="text-slate-500 mt-1 mb-6">Acesse sua conta.</p>

        <?php if (!empty($erro)): ?>
            <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-red-700">
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/ubs-estoque/public/login" class="space-y-5">
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">E-mail</label>
                <input type="email" id="email" name="email" class="w-full rounded-lg border border-slate-300 px-4 py-2" required>
            </div>

            <div>
                <label for="senha" class="block text-sm font-medium text-slate-700 mb-1">Senha</label>
                <input type="password" id="senha" name="senha" class="w-full rounded-lg border border-slate-300 px-4 py-2" required>
            </div>

            <button type="submit" class="w-full rounded-lg bg-slate-800 px-5 py-2 text-white hover:bg-slate-700">
                Entrar
            </button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
