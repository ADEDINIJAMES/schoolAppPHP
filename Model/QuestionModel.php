
<?php
require_once '../config/Database.php';

class QuestionModel {
    private $db;

  public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function addQuestion($question, $options, $correct_option) {
        $query = "INSERT INTO questions (question, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssss", $question, $options[0], $options[1], $options[2], $options[3], $correct_option);
        return $stmt->execute();
    }

    public function fetchQuestions() {
        $query = "SELECT * FROM questions";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
