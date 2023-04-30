<?php
  // Definir as credenciais do banco de dados
  $servidor = "localhost";
  $usuario = "nome_do_usuario";
  $senha = "senha_do_usuario";
  $banco = "nome_do_banco";

  // Conectar ao banco de dados
  $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

  // Verificar se a conexão foi estabelecida com sucesso
  if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
  }

  // Processar os dados do formulário
  $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
  $email = mysqli_real_escape_string($conexao, $_POST['email']);
  $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
  $confirma_senha = mysqli_real_escape_string($conexao, $_POST['confirma_senha']);

  // Verificar se as senhas coincidem
  if ($senha != $confirma_senha) {
    die("As senhas não coincidem");
  }

  // Verificar se o e-mail já está em uso
  $consulta_email = "SELECT * FROM usuarios WHERE email='$email'";
  $resultado
