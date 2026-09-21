<?php

require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Models/Perfil.php';

class UsuarioController
{
    public function index(): void
    {
        Auth::exigirPerfil(['Administrador']);

        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->listar();

        require __DIR__ . '/../Views/usuarios/index.php';
    }

    public function create(): void
    {
        Auth::exigirPerfil(['Administrador']);

        $perfilModel = new Perfil();
        $perfis = $perfilModel->listar();

        require __DIR__ . '/../Views/usuarios/create.php';
    }

    public function store(): void
    {
        Auth::exigirPerfil(['Administrador']);

        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';
        $perfilId = (int) ($_POST['perfil_id'] ?? 0);

        if ($nome === '' || $email === '' || $senha === '' || $perfilId <= 0) {
            $erro = 'Preencha todos os campos.';
            $perfilModel = new Perfil();
            $perfis = $perfilModel->listar();
            require __DIR__ . '/../Views/usuarios/create.php';
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro = 'Informe um e-mail válido.';
            $perfilModel = new Perfil();
            $perfis = $perfilModel->listar();
            require __DIR__ . '/../Views/usuarios/create.php';
            return;
        }

        try {
            $usuarioModel = new Usuario();
            $usuarioModel->cadastrar($nome, $email, $senha, $perfilId);

            $_SESSION['sucesso_usuario'] = 'Usuário cadastrado com sucesso.';
            header('Location: /usuarios');
            exit;
        } catch (Throwable $e) {
            $erro = 'Não foi possível cadastrar o usuário.';
            $perfilModel = new Perfil();
            $perfis = $perfilModel->listar();
            require __DIR__ . '/../Views/usuarios/create.php';
        }
    }

    public function edit(int $id): void
    {
        Auth::exigirPerfil(['Administrador']);

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->buscarPorId($id);

        if (!$usuario) {
            http_response_code(404);
            echo 'Usuário não encontrado.';
            return;
        }

        $perfilModel = new Perfil();
        $perfis = $perfilModel->listar();

        require __DIR__ . '/../Views/usuarios/edit.php';
    }

    public function update(int $id): void
    {
        Auth::exigirPerfil(['Administrador']);

        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = trim($_POST['senha'] ?? '');
        $perfilId = (int) ($_POST['perfil_id'] ?? 0);

        $perfilModel = new Perfil();
        $perfis = $perfilModel->listar();

        if ($nome === '' || $email === '' || $perfilId <= 0) {
            $erro = 'Preencha todos os campos obrigatórios.';
            $usuario = (new Usuario())->buscarPorId($id);
            require __DIR__ . '/../Views/usuarios/edit.php';
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro = 'Informe um e-mail válido.';
            $usuario = (new Usuario())->buscarPorId($id);
            require __DIR__ . '/../Views/usuarios/edit.php';
            return;
        }

        try {
            (new Usuario())->atualizar(
                $id,
                $nome,
                $email,
                $perfilId,
                $senha !== '' ? $senha : null
            );

            $_SESSION['sucesso_usuario'] = 'Usuário atualizado com sucesso.';
            header('Location: /usuarios');
            exit;
        } catch (Throwable $e) {
            $erro = 'Não foi possível atualizar o usuário.';
            $usuario = (new Usuario())->buscarPorId($id);
            require __DIR__ . '/../Views/usuarios/edit.php';
        }
    }

    public function toggleStatus(int $id): void
    {
        Auth::exigirPerfil(['Administrador']);

        if ($id === (int) ($_SESSION['usuario_id'] ?? 0)) {
            $_SESSION['erro_usuario'] = 'Não é possível alterar o status do usuário conectado.';
            header('Location: /usuarios');
            exit;
        }

        try {
            (new Usuario())->alterarStatus($id);
            $_SESSION['sucesso_usuario'] = 'Status do usuário alterado com sucesso.';
        } catch (Throwable $e) {
            $_SESSION['erro_usuario'] = 'Não foi possível alterar o status do usuário.';
        }

        header('Location: /usuarios');
        exit;
    }

    public function delete(int $id): void
    {
        Auth::exigirPerfil(['Administrador']);

        if ($id === (int) ($_SESSION['usuario_id'] ?? 0)) {
            $_SESSION['erro_usuario'] = 'Não é possível excluir o usuário conectado.';
            header('Location: /usuarios');
            exit;
        }

        try {
            (new Usuario())->excluir($id);
            $_SESSION['sucesso_usuario'] = 'Usuário excluído com sucesso.';
        } catch (Throwable $e) {
            $_SESSION['erro_usuario'] = 'Não foi possível excluir o usuário.';
        }

        header('Location: /usuarios');
        exit;
    }
}
