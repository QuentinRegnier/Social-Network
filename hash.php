<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générer un hash de mot de passe</title>
</head>
<body>
    <h2>Générer un hash de mot de passe</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="password">Entrez votre mot de passe :</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Générer le hash</button>
    </form>
    <br>

    <?php
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer le mot de passe depuis le formulaire
        $password = $_POST['password'];

        // Paramètres pour la fonction password_hash
        $options = [
            'cost' => 12, // Le coût de l'algorithme de hachage (plus le nombre est élevé, plus le hachage est sécurisé mais prend plus de temps)
        ];

        // Générer le hash du mot de passe
        $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

        // Afficher le hash généré
        echo "<strong>Hash généré :</strong><br>";
        echo $hashpass;
    }
    ?>
</body>
</html>
