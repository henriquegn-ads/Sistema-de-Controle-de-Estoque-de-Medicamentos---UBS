<?php

require_once __DIR__ . '/../Models/Perfil.php';

class PerfilController
{
    public function index(): void
    {
        Auth::exigirPerfil(['Administrador']);

        $busca = trim($_GET['busca'] ?? '');

        $perfilModel = new Perfil();
        $perfis = $perfilModel->listar($busca);

        require __DIR__ . '/../Views/perfis/index.php';
    }

    public function create(): void
    {
        Auth::exigirPerfil(['Administrador']);

        require __DIR__ . '/../Views/perfis/create.php';
    }

    public function store(): void
    {
        Auth::exigirPerfil(['Administrador']);

        $nome = trim($_POST['nome'] ?? '');

        if ($nome === '') {
            $erro = 'Informe o nome do perfil.';
            require __DIR__ . '/../Views/perfis/create.php';
            return;
        }

        $perfilModel = new Perfil();

        if ($perfilModel->existeNome($nome)) {
            $erro = 'Já existe um perfil com esse nome.';
            require __DIR__ . '/../Views/perfis/create.php';
            return;
        }

        try {
            $perfilModel->cadastrar($nome);

            $_SESSION['sucesso_perfil'] = 'Perfil cadastrado com sucesso.';

            header('Location: /perfis');
            exit;
        } catch (Throwable $e) {
            $erro = 'Não foi possível cadastrar o perfil.';
            require __DIR__ . '/../Views/perfis/create.php';
        }
    }

    public function edit(int $id): void
    {
        Auth::exigirPerfil(['Administrador']);

        $perfilModel = new Perfil();
        $perfil = $perfilModel->buscarPorId($id);

        if (!$perfil) {
            http_response_code(404);
            echo 'Perfil não encontrado.';
            return;
        }

        require __DIR__ . '/../Views/perfis/edit.php';
    }

    public function update(int $id): void
    {
        Auth::exigirPerfil(['Administrador']);

        $nome = trim($_POST['nome'] ?? '');

        $perfilModel = new Perfil();
        $perfil = $perfilModel->buscarPorId($id);

        if (!$perfil) {
            http_response_code(404);
            echo 'Perfil não encontrado.';
            return;
        }

        if ($nome === '') {
            $erro = 'Informe o nome do perfil.';
            require __DIR__ . '/../Views/perfis/edit.php';
            return;
        }

        if ($perfilModel->existeNome($nome, $id)) {
            $erro = 'Já existe outro perfil com esse nome.';
            require __DIR__ . '/../Views/perfis/edit.php';
            return;
        }

        try {
            $perfilModel->atualizar($id, $nome);

            $_SESSION['sucesso_perfil'] = 'Perfil atualizado com sucesso.';

            header('Location: /perfis');
            exit;
        } catch (Throwable $e) {
            $erro = 'Não foi possível atualizar o perfil.';
            require __DIR__ . '/../Views/perfis/edit.php';
        }
    }

    public function delete(int $id): void
    {
        Auth::exigirPerfil(['Administrador']);

        if ($id === 1) {
            $_SESSION['erro_perfil'] = 'O perfil Administrador não pode ser excluído.';
            header('Location: /perfis');
            exit;
        }

        $perfilModel = new Perfil();
        $perfil = $perfilModel->buscarPorId($id);

        if (!$perfil) {
            $_SESSION['erro_perfil'] = 'Perfil não encontrado.';
            header('Location: /perfis');
            exit;
        }

        if ((int) $perfil['total_usuarios'] > 0) {
            $_SESSION['erro_perfil'] = 'Não é possível excluir um perfil que possui usuários vinculados.';
            header('Location: /perfis');
            exit;
        }

        try {
            $perfilModel->excluir($id);

            $_SESSION['sucesso_perfil'] = 'Perfil excluído com sucesso.';
        } catch (Throwable $e) {
            $_SESSION['erro_perfil'] = 'Não foi possível excluir o perfil.';
        }

        header('Location: /perfis');
        exit;
    }
}