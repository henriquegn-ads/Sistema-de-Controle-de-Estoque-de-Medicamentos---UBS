<?php
$uriAtual = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
?>
<aside id="sidebar" class="sidebar">
    <div class="sidebar-logo">
        <img src="/images/logo-ubs-white.png" alt="UBS Estoque">
    </div>

    <nav class="menu">
        <a href="/" class="<?= $uriAtual === '/' ? 'active' : '' ?>">Dashboard</a>
        <a href="/medicamentos" class="<?= str_starts_with($uriAtual, '/medicamentos') ? 'active' : '' ?>">Medicamentos</a>
        <a href="#">Entradas</a>
        <a href="#">Saídas</a>
        <a href="#">Estoque</a>
        <a href="#">Fornecedores</a>
        <a href="#">Relatórios</a>

        <?php if (($_SESSION['perfil_nome'] ?? '') === 'Administrador'): ?>
            <a href="/usuarios" class="<?= str_starts_with($uriAtual, '/usuarios') ? 'active' : '' ?>">Usuários</a>
            <a href="/perfis" class="<?= str_starts_with($uriAtual, '/perfis') ? 'active' : '' ?>">Perfis de Acesso</a>
            <a href="#">Configurações</a>
        <?php endif; ?>

        <a href="/logout">Sair</a>
    </nav>
</aside>