<?php
require_once '../Model/QuestionModel.php';
class QuestionController {
  private $model;
  private $userController;


    public function __construct() {
        $this->model = new QuestionModel();
        $this->userController = new UserController();
    }
public function addQuestion (){
global $action;
$this ->userController->isAdmin();
$error='';

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $question = $_POST['question'];
    $options = [$_POST['option1'], $_POST['option2'], $_POST['option3'], $_POST['option4']];
    $correct_option = $_POST['correct_option'];
    $success = $model->addQuestion($question, $options, $correct_option);
    echo json_encode(['status' => $success ? 'success' : 'error']);
}
    include '../View/question.php'; // Ensure this path is correct


if ($action === 'fetch_questions') {
        $questions = $model->fetchQuestions();
        echo json_encode($questions);
    }

}


}

?>