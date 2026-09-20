<?php

$titulo = 'Cadastrar Medicamento';

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<main class="ml-64 p-8">

    <div class="max-w-3xl mx-auto">

        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-800">
                Cadastrar Medicamento
            </h1>

            <p class="text-slate-500 mt-2">
                Cadastre um medicamento no sistema.
            </p>

        </div>

        <div class="bg-white rounded-lg shadow p-6">

            <form
                method="POST"
                action="/ubs-estoque/public/medicamentos/store"
            >

                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Nome do medicamento
                    </label>

                    <input
                        type="text"
                        name="nome"
                        class="w-full border border-slate-300 rounded-lg px-4 py-2"
                    >

                </div>

                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Princípio ativo
                    </label>

                    <input
                        type="text"
                        name="principio_ativo"
                        class="w-full border border-slate-300 rounded-lg px-4 py-2"
                    >

                </div>

                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Fabricante
                    </label>

                    <input
                        type="text"
                        name="fabricante"
                        class="w-full border border-slate-300 rounded-lg px-4 py-2"
                    >

                </div>

                <div class="mb-6">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Unidade de medida
                    </label>

                    <input
                        type="text"
                        name="unidade_medida"
                        placeholder="Ex.: comprimido, frasco, ampola"
                        class="w-full border border-slate-300 rounded-lg px-4 py-2"
                    >

                </div>

                <div class="flex gap-3">

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700"
                    >
                        Cadastrar
                    </button>

                    <a
                        href="/ubs-estoque/public/medicamentos"
                        class="bg-slate-200 text-slate-700 px-5 py-2 rounded-lg"
                    >
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>