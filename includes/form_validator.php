<?php 
require 'send_email.php' ;

class FormValidator {
  private $data;
  private $msg_array = [];
  private static $fields = ['username', 'email', 'subject', 'message']; //required fields

  public function __construct($post_data){
    $this->data = $post_data;
  }


  public function validateForm(){
    foreach(self::$fields as $field){
      if(!array_key_exists($field, $this->data)){
        trigger_error("'$field' is not present in the data");
        return;
      }
    }
    $this->validateUsername();
    $this->validateEmail();
    $this->validateSubject();
    $this->validateMessage();

    if(count($this->msg_array) > 0){
      return $this->msg_array;
    }else {   
      // get response message from send email and display in the form
      $sendEmail = new SendEmail();
      return $sendEmail->email();
    }
    
  }

  private function validateUsername(){
    $val = trim($this->data['username']);

    if(empty($val)){
      $this->addMessage('username', 'Username is required');
    } else {
      if(!preg_match('/^[a-zA-Z0-9 ]{1,30}$/', $val)){
        $this->addMessage('username','Username can be max 30 chars long & alphanumeric');
      }
    }
  }
  private function validateSubject(){
    $val = trim($this->data['subject']);

    if(empty($val)){
      $this->addMessage('subject', 'Subject is required');
    } else {
      if(!preg_match('/^[a-zA-Z0-9 ]{1,30}$/', $val)){
        $this->addMessage('subject','Subject can be max 30 chars long & alphanumeric');
      }
    }
  }

  private function validateEmail(){
    $val = trim($this->data['email']);

    if(empty($val)){
      $this->addMessage('email', 'Email is required');
    } else {
      if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
        $this->addMessage('email', 'Invalid email address');
      }
    }
  }
  private function validateMessage(){
    $val = trim($this->data['message']);

    if(empty($val)){
      $this->addMessage('message', 'Message is required');
    } else {
      if(!preg_match('/^[a-zA-Z0-9 ]{1,300}$/', $val)){
        $this->addMessage('message','Message can be max 300 chars long & alphanumeric');
      }
    }
  }


   private function addMessage($key, $val){
    $this->msg_array[$key] = $val;
  }

}

?>