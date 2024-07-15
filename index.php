<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Consulta de Atores - Star Wars</h1>
    <form action="index.php" method="GET">
        <label for="actor_name">Nome do Ator:</label>
        <input type="text" id="actor_name" name="actor_name">
        <button type="submit">Buscar</button>
    </form>

    <?php
    // Verificar se foi feita uma busca
    if (isset($_GET['actor_name'])) {
        $actor_name = urlencode($_GET['actor_name']);
        $url = "https://swapi.dev/api/people/?search=$actor_name";

 
        $resultado = file_get_contents($url);

        if ($resultado) {
            $data = json_decode($resultado, true);
            
            // Verificar se há resultados encontrados
            if ($data['count'] > 0) {
                $actor = $data['results'][0];
                echo "<h2>Informações do Ator</h2>";
                echo "<p><strong>Nome:</strong> {$actor['name']}</p>";
                echo "<p><strong>Altura:</strong> {$actor['height']} cm</p>";
                echo "<p><strong>Peso:</strong> {$actor['mass']} kg</p>";
                echo "<p><strong>Cor do Cabelo:</strong> {$actor['hair_color']}</p>";
                echo "<p><strong>Cor da Pele:</strong> {$actor['skin_color']}</p>";
                echo "<p><strong>Cor dos Olhos:</strong> {$actor['eye_color']}</p>";
                echo "<p><strong>Ano de Nascimento:</strong> {$actor['birth_year']}</p>";
                echo "<p><strong>Gênero:</strong> {$actor['gender']}</p>";
            } else {
                echo "<p>Nenhum ator encontrado com o nome '$actor_name'.</p>";
            }
        } else {
            echo "<p>Ocorreu um erro ao buscar as informações do ator.</p>";
        }
    }
    ?>
</body>
</html>