<?php  
require_once SITE_ROOT.'/smt-mail/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; 
 
CLASS Connection {
    protected $servername = "localhost";
    protected $username = DATABASE_USERNAME;
    protected $password = DATABASE_PASSWORD;
    protected $database = DATABASE_NAME;
    public $mail;  
    
    function mail_configuration(){  
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail->isSMTP();              
        //$this->mail->Host       = 'smtp.gmail.com'; 
        $this->mail->Host       = 'localhost'; 
        $this->mail->SMTPAuth   = false;
        //$this->mail->Username   = MAIL_USERNAME; 
        //$this->mail->Password   = MAIL_PASSWORD;
       //$this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port       = 25; 
        $this->mail->setFrom(MAIL_SET_FROM);
        $this->mail->addBCC(MAIL_BCC);
        $this->mail->isHTML(true); 

        return $this->mail;
    }

    public function create_connection(){  
      $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      } 
      return $conn;
    } 
}
?>