<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'UBS Estoque') ?></title>
    <style>
        :root {
            --verde-escuro: #004c4c;
            --verde: #0b9689;
            --verde-hover: #087d72;
            --fundo: #f8fafc;
            --borda: #cbd5e1;
            --texto: #334155;
            --texto-leve: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            font-size: 14px;
            background: var(--fundo);
            color: var(--texto);
        }

        .app-shell {
            min-height: 100vh;
            display: flex;
        }

        /* SIDEBAR COMPACTA */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: var(--verde-escuro);
            flex-shrink: 0;
            overflow: hidden;
            transition: width 0.2s ease;
        }

        .sidebar.collapsed {
            width: 0;
        }

        .sidebar-logo {
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-logo img {
            max-width: 140px;
            max-height: 55px;
            object-fit: contain;
        }

        .menu {
            padding: 12px 10px;
            min-width: 240px;
        }

        .menu a {
            display: flex;
            align-items: center;
            min-height: 38px;
            padding: 0 16px !important;
            color: #e2e8f0 !important;
            font-size: 14px !important;
            font-weight: 500;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 4px;
            transition: background 0.15s ease, padding-left 0.15s ease;
        }

        .menu a:hover {
            background: rgba(255, 255, 255, 0.08) !important;
            color: #ffffff !important;
            padding-left: 18px !important;
        }

        .menu a.active {
            background: var(--verde) !important;
            color: #ffffff !important;
            font-weight: 600;
        }

        /* TOPBAR & CONTEÚDO */
        .content-area {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            height: 56px;
            background: #ffffff;
            border-bottom: 1px solid var(--borda);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
        }

        .hamburger {
            border: 0;
            background: transparent;
            color: var(--texto);
            cursor: pointer;
            padding: 6px;
            display: flex;
            align-items: center;
            border-radius: 4px;
        }

        .hamburger:hover {
            background: #f1f5f9;
        }

        .hamburger svg {
            width: 22px;
            height: 22px;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13.5px;
            font-weight: 500;
            color: var(--texto);
        }

        .user-area svg {
            width: 20px;
            height: 20px;
            color: var(--verde-escuro);
        }

        .main-content {
            padding: 24px 28px;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 4px;
            color: var(--verde-escuro);
        }

        .page-subtitle {
            font-size: 13px;
            margin: 0;
            color: var(--texto-leve);
        }

        /* COMPONENTES GERAIS (BOTÕES, FILTRO, TABELA) */
        .btn-primary, .new-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 38px;
            padding: 0 16px;
            border-radius: 6px;
            background: var(--verde);
            color: #fff;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            border: 0;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .btn-primary:hover, .new-button:hover {
            background: var(--verde-hover);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 38px;
            padding: 0 16px;
            border-radius: 6px;
            background: #fff;
            border: 1px solid var(--borda);
            color: var(--texto);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background: #f1f5f9;
        }

        .filter-box {
            width: 100%;
            margin-bottom: 16px;
        }

        .filter-input {
            width: 100%;
            height: 38px;
            border: 1px solid var(--borda);
            border-radius: 6px;
            background: #fff;
            padding: 0 12px;
            font-size: 13.5px;
            color: var(--texto);
        }

        .filter-input:focus {
            outline: none;
            border-color: var(--verde);
            box-shadow: 0 0 0 2px rgba(11, 150, 137, 0.15);
        }

        .alert {
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 16px;
            font-size: 13px;
        }

        .alert-success { background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; }
        .alert-error { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }

        .table-card {
            background: #fff;
            border: 1px solid var(--borda);
            border-radius: 8px;
            overflow: hidden;
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
        }

        thead { background: #f8fafc; }

        th {
            color: var(--verde-escuro);
            font-size: 12.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            text-align: left;
            padding: 10px 14px;
            border-bottom: 1px solid var(--borda);
            white-space: nowrap;
        }

        td {
            color: var(--texto);
            font-size: 13px;
            padding: 10px 14px;
            border-bottom: 1px solid #f1f5f9;
            white-space: nowrap;
        }

        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #f8fafc; }

        .empty {
            text-align: center;
            color: var(--texto-leve);
            font-size: 13.5px;
            padding: 24px;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .edit-button, .delete-button {
            height: 30px;
            padding: 0 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .edit-button {
            border: 1px solid var(--borda);
            color: var(--verde-escuro);
            background: #fff;
        }

        .edit-button:hover { background: #f1f5f9; }

        .delete-button {
            border: 0;
            color: #fff;
            background: #ef4444;
        }

        .delete-button:hover { background: #dc2626; }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11.5px;
            font-weight: 600;
        }
        .badge-ativo { background: #dcfce7; color: #15803d; }
        .badge-inativo { background: #fee2e2; color: #b91c1c; }

        /* FORMULÁRIOS COMPACTOS (CREATE / EDIT) */
        .form-card {
            background: #fff;
            border: 1px solid var(--borda);
            border-radius: 8px;
            padding: 20px 24px;
            max-width: 800px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--verde-escuro);
        }

        .form-control {
            width: 100%;
            height: 38px;
            border: 1px solid var(--borda);
            border-radius: 6px;
            padding: 0 12px;
            font-size: 13.5px;
            color: var(--texto);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--verde);
            box-shadow: 0 0 0 2px rgba(11, 150, 137, 0.15);
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .sidebar { position: fixed; z-index: 100; left: 0; top: 0; }
            .topbar { padding: 0 16px; }
            .main-content { padding: 16px; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .new-button { width: 100%; }
        }
    </style>
</head>
<body>