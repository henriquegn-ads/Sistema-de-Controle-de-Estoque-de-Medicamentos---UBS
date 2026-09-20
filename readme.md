# 💊 Sistema de Controle de Estoque de Medicamentos - UBS

## Projeto Integrador

Sistema web desenvolvido para gerenciamento do estoque de medicamentos de uma Unidade Básica de Saúde (UBS), permitindo o controle de entradas, saídas, lotes, validade dos medicamentos e gerenciamento de usuários.

---

## 📌 Objetivo

Desenvolver uma aplicação web utilizando PHP e arquitetura MVC para auxiliar no controle do estoque de medicamentos de uma Unidade Básica de Saúde, proporcionando maior organização, segurança e confiabilidade das informações.

---

## 👨‍💻 Autor

- Henrique Gomes do Nascimento

---

## 🛠 Tecnologias Utilizadas

- PHP 8
- Arquitetura MVC
- MySQL
- HTML5
- CSS3
- Bootstrap 5
- JavaScript
- Git
- GitHub
- XAMPP

---

## 📁 Estrutura do Projeto

```

app/
├── controllers/
├── models/
├── views/

config/

database/

public/
├── css/
├── js/
├── images/
├── uploads/

routes/

README.md

````

---

## 🔐 Funcionalidades

### Autenticação

- Login
- Logout
- Controle de sessão
- Controle de acesso por perfil

### Usuários

- Cadastro
- Alteração
- Exclusão
- Consulta

### Perfis

- Administrador
- Farmacêutico
- Almoxarife
- Atendente

### Medicamentos

- Cadastro
- Alteração
- Exclusão
- Consulta

### Categorias

- Cadastro
- Alteração
- Exclusão

### Fornecedores

- Cadastro
- Alteração
- Exclusão

### Estoque

- Entrada de medicamentos
- Saída de medicamentos
- Controle de lotes
- Controle de validade
- Consulta de estoque

### Relatórios

- Estoque atual
- Entradas
- Saídas
- Medicamentos próximos ao vencimento
- Medicamentos vencidos

### Configurações

- Nome da Unidade
- CNES
- Endereço
- Bairro
- Cidade
- Estado

---

## 🗄 Banco de Dados

O banco de dados é composto pelas seguintes tabelas:

- perfis
- usuarios
- fornecedores
- categorias
- medicamentos
- lotes
- entradas
- saidas
- movimentacoes
- log_acessos
- configuracoes
- arquivos

---

## 📋 Requisitos do Sistema

- PHP 8 ou superior
- MySQL 8 ou superior
- Apache
- XAMPP ou WAMP

---

## 📷 Telas do Sistema

* Login
* Dashboard
* Medicamentos
* Fornecedores
* Entradas
* Saídas
* Estoque
* Usuários
* Perfis
* Configurações
* Relatórios

---

## 📂 Arquitetura

O projeto segue o padrão MVC.

```
Controller
     ↓
Model
     ↓
Banco de Dados
     ↑
View
```

---

## 🔒 Segurança

* Senhas criptografadas com `password_hash()`
* Controle de sessões
* Controle de acesso por perfil
* Validação de formulários
* Tratamento de erros
* Upload seguro de arquivos

---

## 📈 Melhorias Futuras

* Dashboard com gráficos
* Alertas automáticos de vencimento
* Código de barras
* Leitura por QR Code
* Backup automático
* Exportação para PDF
* Exportação para Excel
* Histórico de auditoria
* Notificações por e-mail

---

## 📄 Licença

Projeto desenvolvido exclusivamente para fins acadêmicos na disciplina de Projeto Integrador.

---

### Desenvolvido por

Henrique Gomes do Nascimento

Aluno do Curso Tecnólogo em Análise e Desenvolvimento de Sistemas pela UNIVASF

```
```
