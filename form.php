<?php

$data = array_map('trim', $_POST);

$company = htmlentities($data['companyName']);
$firstname = htmlentities($data['firstname']);
$email = htmlentities($data['email']);
$message = htmlentities($data['contactMessage']);


$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // nettoyage et validation des données soumises via le formulaire 
    if (!isset($_POST['user_firstname']) || trim($_POST['user_firstname']) === '')
        $errors[] = "Le prénom est obligatoire";
    if (!isset($_POST['user_name']) || trim($_POST['user_name']) === '')
        $errors[] = "Le nom est obligatoire";
    if (!isset($_POST['user_email']) || trim($_POST['user_email']) === '')
        $errors[] = "L'email est obligatoire";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'l\'adresse email n\'est pas au bon format';
    }
    if (!isset($_POST['mobile']) || trim($_POST['mobile']) === '')
        $errors[] = "Le numéro de téléphone est obligatoire";
    if (!isset($_POST['objet']) || trim($_POST['objet']) === '')
        $errors[] = "L'objet est obligatoire";
    if (!isset($_POST['user_message']) || trim($_POST['user_message']) === '')
        $errors[] = "Le message est obligatoire";

    if (empty($errors)) {
        // traitement du formulaire
        // puis redirection
        header('Location: success.php');
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>

<body>

    <main class="container">
        <h1 class="border rounded text-center p-3 m-5 bg-light">Inscription</h1>

        <?php // Affichage des éventuelles erreurs 
        if (count($errors) > 0) : ?>
            <div class="border border-danger rounded p-3 m-5 bg-danger">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="form.php" method="post">
            <div>
                <label for="user_name">Nom :</label>
                <input type="text" id="user_name" name="user_name">
            </div>
            <div>
                <label for="user_firstname">Prenom :</label>
                <input type="text" id="user_firstname" name="user_firstname">
            </div>
            <div>
                <label for="user_email">Courriel :</label>
                <input type="email" id="user_email" name="user_email">
            </div>
            <div>
                <label for="mobile">Téléphone :</label>
                <input type="text" id="mobile" name="mobile">
            </div>
            <div>
                <label for="objet">Objet :</label>
                <input type="text" id="objet" name="objet">
            </div>
            <div>
                <label for="user_message">Message :</label>
                <textarea id="user_message" name="user_message"></textarea>
            </div>
            <div class="button">
                <button type="submit">Envoyer votre message</button>
            </div>
        </form>
    </main>

</body>

</html>