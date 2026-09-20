<?php

require_once __DIR__ . '/../Models/Medicamento.php';

class MedicamentoController
{
    private Medicamento $medicamento;

    public function __construct()
    {
        $this->medicamento = new Medicamento();
    }

    public function index(): void
    {
        $medicamentos = $this->medicamento->listar();

        $sucesso = $_SESSION['sucesso'] ?? null;
        $erro = $_SESSION['erro'] ?? null;

        unset($_SESSION['sucesso'], $_SESSION['erro']);

        require_once __DIR__ . '/../Views/medicamentos/index.php';
    }

    public function create(): void
    {
        require_once __DIR__ . '/../Views/medicamentos/create.php';
    }

    public function store(): void
    {
        $dados = [
            'nome' => trim($_POST['nome'] ?? ''),
            'principio_ativo' => trim($_POST['principio_ativo'] ?? ''),
            'fabricante' => trim($_POST['fabricante'] ?? ''),
            'unidade_medida' => trim($_POST['unidade_medida'] ?? '')
        ];

        $erro = $this->validar($dados);

        if ($erro !== null) {
            $_SESSION['erro'] = $erro;
            $_SESSION['dados'] = $dados;

            header('Location: /ubs-estoque/public/medicamentos/create');
            exit;
        }

        try {
            if ($this->medicamento->cadastrar($dados)) {
                $_SESSION['sucesso'] = 'Medicamento cadastrado com sucesso.';
            } else {
                $_SESSION['erro'] = 'Não foi possível cadastrar o medicamento.';
            }
        } catch (PDOException $e) {
            $_SESSION['erro'] = 'Não foi possível cadastrar o medicamento.';
        }

        header('Location: /ubs-estoque/public/medicamentos');
        exit;
    }

    public function edit(int $id): void
    {
        $medicamento = $this->medicamento->buscarPorId($id);

        if ($medicamento === null) {
            $_SESSION['erro'] = 'Medicamento não encontrado.';
            header('Location: /ubs-estoque/public/medicamentos');
            exit;
        }

        require_once __DIR__ . '/../Views/medicamentos/edit.php';
    }

    public function update(int $id): void
    {
        $dados = [
            'nome' => trim($_POST['nome'] ?? ''),
            'principio_ativo' => trim($_POST['principio_ativo'] ?? ''),
            'fabricante' => trim($_POST['fabricante'] ?? ''),
            'unidade_medida' => trim($_POST['unidade_medida'] ?? '')
        ];

        $erro = $this->validar($dados);

        if ($erro !== null) {
            $_SESSION['erro'] = $erro;
            header('Location: /ubs-estoque/public/medicamentos/edit/' . $id);
            exit;
        }

        if ($this->medicamento->buscarPorId($id) === null) {
            $_SESSION['erro'] = 'Medicamento não encontrado.';
            header('Location: /ubs-estoque/public/medicamentos');
            exit;
        }

        try {
            if ($this->medicamento->atualizar($id, $dados)) {
                $_SESSION['sucesso'] = 'Medicamento atualizado com sucesso.';
            } else {
                $_SESSION['erro'] = 'Não foi possível atualizar o medicamento.';
            }
        } catch (PDOException $e) {
            $_SESSION['erro'] = 'Não foi possível atualizar o medicamento.';
        }

        header('Location: /ubs-estoque/public/medicamentos');
        exit;
    }

    public function delete(int $id): void
    {
        if ($this->medicamento->buscarPorId($id) === null) {
            $_SESSION['erro'] = 'Medicamento não encontrado.';
            header('Location: /ubs-estoque/public/medicamentos');
            exit;
        }

        try {
            if ($this->medicamento->excluir($id)) {
                $_SESSION['sucesso'] = 'Medicamento excluído com sucesso.';
            } else {
                $_SESSION['erro'] = 'Não foi possível excluir o medicamento.';
            }
        } catch (PDOException $e) {
            $_SESSION['erro'] = 'Não foi possível excluir o medicamento.';
        }

        header('Location: /ubs-estoque/public/medicamentos');
        exit;
    }

    private function validar(array $dados): ?string
    {
        if ($dados['nome'] === '') {
            return 'Informe o nome do medicamento.';
        }

        if ($dados['principio_ativo'] === '') {
            return 'Informe o princípio ativo.';
        }

        if ($dados['unidade_medida'] === '') {
            return 'Informe a unidade de medida.';
        }

        return null;
    }
}
