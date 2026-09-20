<?php

$titulo = 'Medicamentos';

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<main class="ml-64 p-8">

    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Medicamentos
            </h1>

            <p class="text-slate-500 mt-2">
                Medicamentos cadastrados no sistema.
            </p>

        </div>

        <a
            href="/ubs-estoque/public/medicamentos/create"
            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700"
        >
            Novo medicamento
        </a>

    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="text-left px-6 py-4">
                        ID
                    </th>

                    <th class="text-left px-6 py-4">
                        Medicamento
                    </th>

                    <th class="text-left px-6 py-4">
                        Princípio ativo
                    </th>

                    <th class="text-left px-6 py-4">
                        Fabricante
                    </th>

                    <th class="text-left px-6 py-4">
                        Unidade
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (empty($medicamentos)): ?>

                    <tr>

                        <td
                            colspan="5"
                            class="px-6 py-8 text-center text-slate-500"
                        >
                            Nenhum medicamento cadastrado.
                        </td>

                    </tr>

                <?php else: ?>

                    <?php foreach ($medicamentos as $medicamento): ?>

                        <tr class="border-t border-slate-200">

                            <td class="px-6 py-4">
                                <?= $medicamento['id'] ?>
                            </td>

                            <td class="px-6 py-4 font-medium">
                                <?= htmlspecialchars($medicamento['nome']) ?>
                            </td>

                            <td class="px-6 py-4">
                                <?= htmlspecialchars($medicamento['principio_ativo'] ?? '') ?>
                            </td>

                            <td class="px-6 py-4">
                                <?= htmlspecialchars($medicamento['fabricante'] ?? '') ?>
                            </td>

                            <td class="px-6 py-4">
                                <?= htmlspecialchars($medicamento['unidade_medida'] ?? '') ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>