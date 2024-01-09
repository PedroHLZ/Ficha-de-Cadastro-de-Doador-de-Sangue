<!DOCTYPE html>
<html lang="Pt-Br">
 
<head>
    <meta charset="UTF-8">
    <title>Ficha de Doador de Sangue</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        bod
 
      
 
        body {
            background-color: #f8f9fa;
        }
 
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
 
        .table {
            margin-top: 20px;
        }
 
        .btn-success,
        .btn-danger {
            width: 100%;
        }
    </style>
</head>
 
<body>
    <!-- Criar um formulario para inserir as informações -->
    <div class="container mt-4">
        <h1 class="mb-4">Ficha de Doador de Sangue</h1>
        <!-- Parte 1: escrever o formulario -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
 
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
 
                <div class="form-group col-md-6">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
 
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="tipo_sanguineo">Tipo Sanguíneo:</label>
                    <select class="form-control" id="tipo_sanguineo" name="tipo_sanguineo" required>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
 
                <div class="form-group col-md-3">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                </div>
 
                <div class="form-group col-md-3">
                    <label for="peso">Peso (kg):</label>
                    <input type="number" class="form-control" id="peso" name="peso" required>
                </div>
            </div>
 
            <button type="submit" class="btn btn-primary">Cadastrar Doador</button>
        </form>
        <!-- Parte 2: escrever o php de processar as informaçoes -->
        <?php
 
            // Array para armazenar as informções do formulario
            $doadores = [];
 
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nome = $_POST["nome"];
                    $email = $_POST["email"];
                    $tipo_sanguineo = $_POST["tipo_sanguineo"];
                    $data_nascimento = $_POST["data_nascimento"];
                    $peso = $_POST["peso"];
 
                // Calcular idade com base na data de nascimento
                $data_nascimento_obj = new DateTime($data_nascimento);
                $data_atual_obj = new DateTime();
                $idade_intervalo = $data_nascimento_obj->diff($data_atual_obj);
            
                // Obtemos apenas os anos
                $idade = $idade_intervalo->y; 
 
                $elegibilidade = ($idade >= 16 && $idade <= 69 && $peso >= 50) ? 'Atende aos Requisitos' : 'Não Atende aos Requisitos';
 
                // classe de estilo condicional, para mudar o tipo da class da tabela do resultado.
                $elegibilidadeClass = ($elegibilidade == 'Atende aos Requisitos') ? 'btn-success' : 'btn-danger';
 
                // armazenar os novos dados do doador em um array
                $doador = [
                    'nome' => $nome,
                    'email' => $email,
                    'tipo_sanguineo' => $tipo_sanguineo,
                    'data_nascimento' => $data_nascimento,
                    'peso' => $peso,
                    'idade' => $idade,
                    'elegibilidade' => $elegibilidade,
                    'elegibilidade_class' => $elegibilidadeClass,
                ];
 
                // Adicionar doador ao array de doadores
                $doadores[] = $doador;
            }
        ?>
        <!-- Parte 3: criar uma tabela para exibir os novos dados do array doadores -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Tipo Sanguíneo</th>
                    <th>Data de Nascimento</th>
                    <th>Peso (kg)</th>
                    <th>Elegibilidade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doadores as $doador) : ?>
                <tr>
                    <td><?php echo $doador['nome']; ?></td>
                    <td><?php echo $doador['email']; ?></td>
                    <td><?php echo $doador['tipo_sanguineo']; ?></td>
                    <td><?php echo $doador['data_nascimento']; ?></td>
                    <td><?php echo $doador['peso']; ?></td>
                    <td><button class="btn <?php echo $doador['elegibilidade_class']; ?>">
                            <?php echo $doador['elegibilidade']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS and Popper.js (Optional) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
 
</html>
