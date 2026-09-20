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

        require_once __DIR__ . '/../Views/medicamentos/index.php';
    }

    public function create(): void
    {
        require_once __DIR__ . '/../Views/medicamentos/create.php';
    }

    public function store(): void
    {
        $dados = [
            'nome' => $_POST['nome'] ?? '',
            'principio_ativo' => $_POST['principio_ativo'] ?? '',
            'fabricante' => $_POST['fabricante'] ?? '',
            'unidade_medida' => $_POST['unidade_medida'] ?? ''
        ];

        $this->medicamento->cadastrar($dados);

        header('Location: /ubs-estoque/public/medicamentos');
        exit;
    }
}