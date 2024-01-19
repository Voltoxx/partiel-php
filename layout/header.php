<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="assets/images/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="assets/styles/style.css">
</head>

<body>
    <header>
        <nav class="flex">
            <a class="logo" href="index.php"><img src="assets/images/logo.jpg" alt="logo"></a>
            <ul class="flex">
                <li><a href="index.php?action=add_question">Ajouter une question</a></li>
                <li><a href="index.php?action=list_questions">Liste des questions</a></li>
            </ul>
        </nav>
    </header>
