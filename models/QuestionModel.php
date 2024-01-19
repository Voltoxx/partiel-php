<?php
require_once 'models/DatabaseModel.php';

class Question {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listQuestions() {
        $sql = "SELECT * FROM questions";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $questions;
    }

    public function listQuestionsWithSuccessRate($sortOrder = 'asc') {
        $sql = "SELECT *, (CASE WHEN nbr_tentatives > 0 THEN (nbr_succes / nbr_tentatives) * 100 ELSE 0 END) as success_rate FROM questions ORDER BY success_rate $sortOrder";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $questions;
    }

    public function addQuestion($question, $reponse, $bonne_reponse, $mauvaise_reponse) {
        $sql = "INSERT INTO questions (libelle_question, reponse, bonne_reponse, mauvaise_reponse, nbr_tentatives, nbr_succes) VALUES (:question, :reponse, :bonne_reponse, :mauvaise_reponse, 0, 0)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':question', $question);
        $stmt->bindValue(':reponse', $reponse);
        $stmt->bindValue(':bonne_reponse', $bonne_reponse);
        $stmt->bindValue(':mauvaise_reponse', $mauvaise_reponse);
        $stmt->execute();
    }

    public function deleteQuestion($id) {
        $sql = "DELETE FROM questions WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function getQuestionById($id) {
        $sql = "SELECT * FROM questions WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $question = $stmt->fetch(PDO::FETCH_ASSOC);
        return $question;
    }

    public function calculateSuccessRate($id) {
        $sql = "SELECT nbr_tentatives, nbr_succes FROM questions WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $question = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Vérifier si le nombre de tentatives est différent de zéro avant de calculer le taux de réussite
        if ($question['nbr_tentatives'] > 0 && $question['nbr_succes'] > 0) {
            $tauxReussite = $question['nbr_succes'] / $question['nbr_tentatives'] * 100;
            return $tauxReussite;
        } else {
            // Si le nombre de tentatives est zéro, retourner zéro pour éviter la division par zéro
            return 0;
        }
    }
    
    public function updateStats($id, $isCorrect)
    {
        if ($isCorrect) {
            $sql = "UPDATE questions SET nbr_succes = nbr_succes + 1, nbr_tentatives = nbr_tentatives + 1 WHERE id = :id";
        } else {
            $sql = "UPDATE questions SET nbr_tentatives = nbr_tentatives + 1 WHERE id = :id";
        }
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }    

    public function checkAnswer($id, $userAnswer) {
        $sql = "SELECT reponse FROM questions WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $question = $stmt->fetch(PDO::FETCH_ASSOC);
        $isCorrect = $question['reponse'] === $userAnswer;
        return $isCorrect;
    }
    
}
?>
