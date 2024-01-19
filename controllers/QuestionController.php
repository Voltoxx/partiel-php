<?php
require_once './models/QuestionModel.php';
require_once './models/DatabaseModel.php';

$databaseModel = new Database();
$conn = $databaseModel->getConnection(); 
$questionModel = new Question($conn);

class QuestionController {
    // Méthode pour afficher toutes les questions
    public function listQuestions() {
        global $questionModel;
        $questions = $questionModel->listQuestions();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sortOrder = $_POST['sortOrder'];
            $questions = $questionModel->listQuestionsWithSuccessRate($sortOrder);
        } else {
            $questions = $questionModel->listQuestionsWithSuccessRate();
        }
    
        foreach ($questions as $key => $question) {
            $successRate = $questionModel->calculateSuccessRate($question['id']);
            $questions[$key]['success_rate'] = number_format($successRate, 2) . '%';
        }
    
        require_once 'views/indexView.php';
    }

    // Méthode pour créer une nouvelle question
    public function addQuestion() {
        global $questionModel;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $question = $_POST['question'];
            $reponse = $_POST['reponse'];
            $success_message = $_POST['success_message'];
            $failure_message = $_POST['failure_message'];

            $questionModel->addQuestion($question, $reponse, $success_message, $failure_message);
        }

        $questions = $questionModel->listQuestions();
        header('Location: index.php?action=listQuestions');
    }

    // Méthode pour supprimer une question
    public function deleteQuestion($id) {
        global $questionModel;
        $questionModel->deleteQuestion($id);
        header('Location: index.php?action=listQuestions');
    }

    // Méthode pour répondre à une question
    public function answerQuestion($id)
    {
        global $questionModel;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userAnswer = $_POST['user_answer'];
            $isCorrect = $questionModel->checkAnswer($id, $userAnswer);

            // Mise à jour des statistiques
            $questionModel->updateStats($id, $isCorrect);
        }

        $question = $questionModel->getQuestionById($id);
        require_once 'views/answerQuestionView.php';
    }
}
?>
