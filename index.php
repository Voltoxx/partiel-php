<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'controllers/QuestionController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'listQuestions';

$questionController = new QuestionController();

switch ($action) {
    case 'addQuestion':
        $questionController->addQuestion();
        break;
    case 'answerQuestion':
        $questionId = isset($_GET['id']) ? $_GET['id'] : null;
        $questionController->answerQuestion($questionId);
        break;
    case 'listQuestions':
        $questionController->listQuestions();
        break;
    case 'deleteQuestion':
        $questionId = isset($_GET['id']) ? $_GET['id'] : null;
        $questionController->deleteQuestion($questionId);
        break;
    default:
        $questionController->listQuestions();
        break;
}