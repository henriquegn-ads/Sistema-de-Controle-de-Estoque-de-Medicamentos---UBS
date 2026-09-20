<?php

$titulo = 'Medicamentos';

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<main class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Medicamentos</h1>
            <p class="text-slate-500 mt-1">Medicamentos cadastrados no sistema.</p>
        </div>

        <a href="/ubs-estoque/public/medicamentos/create" class="rounded-lg bg-slate-800 px-5 py-2 text-white hover:bg-slate-700">
            Novo medicamento
        </a>
    </div>

    <?php if (!empty($sucesso)): ?>
        <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-700">
            <?= htmlspecialchars($sucesso) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($erro)): ?>
        <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-red-700">
            <?= htmlspecialchars($erro) ?>
        </div>
    <?php endif; ?>

    <div class="overflow-x-auto bg-white rounded-xl shadow-sm">
        <table class="w-full text-left">
            <thead class="bg-slate-100">
                <tr>
                    <th class="px-5 py-3 text-sm font-semibold text-slate-700">ID</th>
                    <th class="px-5 py-3 text-sm font-semibold text-slate-700">Medicamento</th>
                    <th class="px-5 py-3 text-sm font-semibold text-slate-700">Princípio ativo</th>
                    <th class="px-5 py-3 text-sm font-semibold text-slate-700">Fabricante</th>
                    <th class="px-5 py-3 text-sm font-semibold text-slate-700">Unidade</th>
                    <th class="px-5 py-3 text-sm font-semibold text-slate-700">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <?php if (empty($medicamentos)): ?>
                    <tr>
                        <td colspan="6" class="px-5 py-6 text-center text-slate-500">
                            Nenhum medicamento cadastrado.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($medicamentos as $medicamento): ?>
                        <tr>
                            <td class="px-5 py-4"><?= (int) $medicamento['id'] ?></td>
                            <td class="px-5 py-4"><?= htmlspecialchars($medicamento['nome']) ?></td>
                            <td class="px-5 py-4"><?= htmlspecialchars($medicamento['principio_ativo']) ?></td>
                            <td class="px-5 py-4"><?= htmlspecialchars($medicamento['fabricante']) ?></td>
                            <td class="px-5 py-4"><?= htmlspecialchars($medicamento['unidade_medida']) ?></td>
                            <td class="px-5 py-4">
                                <div class="flex gap-2">
                                    <a href="/ubs-estoque/public/medicamentos/edit/<?= (int) $medicamento['id'] ?>" class="rounded-lg border border-slate-300 px-3 py-1 text-sm text-slate-700 hover:bg-slate-50">
                                        Editar
                                    </a>

                                    <form method="POST" action="/ubs-estoque/public/medicamentos/delete/<?= (int) $medicamento['id'] ?>" onsubmit="return confirm('Deseja realmente excluir este medicamento?');">
                                        <button type="submit" class="rounded-lg bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-700">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
