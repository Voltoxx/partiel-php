<?php
$title = 'NWS - Enigme';
include 'layout/header.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">Répondre à la question</h1>

    <div class="card p-4">
        <p>Question : <?php echo $question['libelle_question']; ?></p>
        <?php
        $successRate = $questionModel->calculateSuccessRate($question['id']);
        if ($successRate > 50){
            echo "<p class='text-success'>Taux de réussite : " . number_format($successRate, 2) . "%</p>";
        }
        else if ($successRate == 50){
            echo "<p class='text-warning'>Taux de réussite : " . number_format($successRate, 2) . "%</p>";
        }
        else {
            echo "<p class='text-danger'>Taux de réussite : " . number_format($successRate, 2) . "%</p>";
        }
        ?>
        <form action="index.php?action=answerQuestion&id=<?php echo $question['id']; ?>" method="POST">
            <div class="mb-3">
                <label for="user_answer" class="form-label">Votre réponse :</label>
                <input type="text" name="user_answer" id="user_answer" class="form-control" required
                       <?php echo isset($isCorrect) && $isCorrect ? 'disabled' : ''; ?>>
            </div>
            <button type="submit" class="btn btn-primary" <?php echo isset($isCorrect) && $isCorrect ? 'disabled' : ''; ?>>
                Valider
            </button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Retour</button>
        </form>

        <?php
        if (isset($isCorrect)) {
            echo "<div class='mt-3'>";
            if ($isCorrect) {
                echo "<p class='text-success'>{$question['bonne_reponse']}</p>";
            } else {
                echo "<p class='text-danger'>{$question['mauvaise_reponse']}</p>";
            }
            echo "</div>";
        }
        ?>
    </div>
</div>

<?php
include 'layout/footer.php';
?>
