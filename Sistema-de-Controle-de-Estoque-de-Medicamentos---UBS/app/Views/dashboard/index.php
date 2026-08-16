<?php

$titulo = 'Dashboard';

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';

?>

<main>

    <h1>Dashboard</h1>

    <p>
        Sistema de Controle de Estoque de Medicamentos em Unidade Básica de Saúde.
    </p>

    <section>

        <div>
            <h3>Medicamentos</h3>
            <p>Gerenciamento de medicamentos.</p>
        </div>

        <div>
            <h3>Entradas</h3>
            <p>Controle de entradas.</p>
        </div>

        <div>
            <h3>Saídas</h3>
            <p>Controle de saídas.</p>
        </div>

        <div>
            <h3>Relatórios</h3>
            <p>Consulta de informações do sistema.</p>
        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>