<?php

$titulo = 'Editar medicamento';

$erro = $_SESSION['erro'] ?? null;

unset($_SESSION['erro']);

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<main class="max-w-5xl mx-auto px-6 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Editar medicamento</h1>
        <p class="text-slate-500 mt-1">Atualize os dados do medicamento.</p>
    </div>

    <?php if ($erro): ?>
        <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-red-700">
            <?= htmlspecialchars($erro) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/ubs-estoque/public/medicamentos/update/<?= (int) $medicamento['id'] ?>" class="bg-white rounded-xl shadow-sm p-6 space-y-5">
        <div>
            <label for="nome" class="block text-sm font-medium text-slate-700 mb-1">Nome</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($medicamento['nome']) ?>" class="w-full rounded-lg border border-slate-300 px-4 py-2" required>
        </div>

        <div>
            <label for="principio_ativo" class="block text-sm font-medium text-slate-700 mb-1">Princípio ativo</label>
            <input type="text" id="principio_ativo" name="principio_ativo" value="<?= htmlspecialchars($medicamento['principio_ativo']) ?>" class="w-full rounded-lg border border-slate-300 px-4 py-2" required>
        </div>

        <div>
            <label for="fabricante" class="block text-sm font-medium text-slate-700 mb-1">Fabricante</label>
            <input type="text" id="fabricante" name="fabricante" value="<?= htmlspecialchars($medicamento['fabricante']) ?>" class="w-full rounded-lg border border-slate-300 px-4 py-2">
        </div>

        <div>
            <label for="unidade_medida" class="block text-sm font-medium text-slate-700 mb-1">Unidade de medida</label>
            <input type="text" id="unidade_medida" name="unidade_medida" value="<?= htmlspecialchars($medicamento['unidade_medida']) ?>" class="w-full rounded-lg border border-slate-300 px-4 py-2" required>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-slate-800 px-5 py-2 text-white hover:bg-slate-700">
                Salvar alterações
            </button>

            <a href="/ubs-estoque/public/medicamentos" class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 hover:bg-slate-50">
                Cancelar
            </a>
        </div>
    </form>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
