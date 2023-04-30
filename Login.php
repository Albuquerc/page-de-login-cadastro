<?php
session_start(); // inicia a sessão

if($_SERVER["REQUEST_METHOD"] == "POST") {
  // pega os valores enviados pelo formulário
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  // conecta ao banco de dados
  $conexao = mysqli_connect("localhost", "seu_usuario", "sua_senha", "seu_banco_de_dados");

  // verifica se a conexão foi bem sucedida
  if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
  }

  // protege contra SQL injection
  $email = mysqli_real_escape_string($conexao, $email);
  $senha = mysqli_real_escape_string($conexao, $senha);

  // busca o usuário no banco de dados
  $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
  $result = mysqli_query($conexao, $sql);

  // verifica se o usuário foi encontrado
  if (mysqli_num_rows($result) == 1) {
    // inicia a sessão e armazena os dados do usuário
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $row['id'];
    $_SESSION['nome'] = $row['nome'];

    // redireciona para a página de perfil
    header("location: perfil.php");
  } else {
    // exibe mensagem de erro
    echo "Email ou senha incorretos.";
  }

  // fecha a conexão com o banco de dados
  mysqli_close($conexao);
}
?>
