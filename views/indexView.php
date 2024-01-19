<?php
$title = 'NWS - EscapeGame';
include 'layout/header.php';
?>

<div class="container mt-5">
    <h1 class="mt-5">Bienvenue à l'escape game NWS</h1>
    <p class="lead">Vous trouverez ici toutes les questions disponibles pour l'escape game.</p>
    <p class="lead">Vous pouvez ajouter une question, ou répondre à une question existante.</p>
    <p class="lead">Vous pouvez également supprimer une question.</p>
    <p class="lead">Bonne chance !</p>

    <h2 class="mt-5">Ajouter une question</h2>
    <div class="container" id="ajouter_question">
        <form action="index.php?action=addQuestion" method="POST">
            <div class="mb-3">
                <label for="question" class="form-label">Question</label>
                <input class="form-control" type="text" name="question" id="question" required>
            </div>
            <div class="mb-3">
                <label for="reponse" class="form-label">Réponse</label>
                <input class="form-control" type="text" name="reponse" id="reponse" required>
            </div>
            <div class="mb-3">
                <label for="success_message" class="form-label">Message de succès</label>
                <input class="form-control" type="text" name="success_message" id="success_message" required>
            </div>
            <div class="mb-3">
                <label for="failure_message" class="form-label">Message de mauvaise réponse</label>
                <input class="form-control" type="text" name="failure_message" id="failure_message" required>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Ajouter</button>
            </div>
        </form>
    </div>

    <h2 class="mt-5">Toutes les questions disponibles</h2>
    <div class="container" id="liste_questions">

        <div class="container mt-2 mb-2">
            <form action="index.php?action=listQuestions" method="POST">
            <div class="form-group">
                <label for="sortOrder">Ordre de tri :</label>
                <select name="sortOrder" id="sortOrder" class="form-control">
                    <option value="asc" <?php echo isset($_POST['sortOrder']) && $_POST['sortOrder'] === 'asc' ? 'selected' : ''; ?>>Croissant</option>
                    <option value="desc" <?php echo isset($_POST['sortOrder']) && $_POST['sortOrder'] === 'desc' ? 'selected' : ''; ?>>Décroissant</option>
                </select>
            </div>
                <button type="submit" class="btn btn-primary">Trier</button>
            </form>
        </div>
        <?php
        foreach ($questions as $question) {
            if ($question == 0){
                echo "<p>Il n'y a pas encore de question</p>";
            }
            else {
                echo "<div class='card mb-3'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Question: {$question['libelle_question']}</h5>";
                echo "<a class='btn btn-primary mr-2' href='index.php?action=answerQuestion&id={$question['id']}'>Répondre</a>";
                echo "<a class='btn btn-danger ms-2' href='index.php?action=deleteQuestion&id={$question['id']}'>Supprimer</a>";
                echo "<p>Taux de réussite : {$question['success_rate']}</p>";
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
    </div>
</div>

<?php
include 'layout/footer.php';
?>
