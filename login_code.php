
<?php
 session_start();
 $_SESSION['username']=$_POST['username'];
 $_SESSION['password']=$_POST['password'];

    $loginCode = file_get_contents('login_code.json');
    $code = json_decode($loginCode, true);

    $generatedCode = $code['loginCode'];
    
    $file = fopen('login_controller.php', 'w');
    fwrite($file, $generatedCode);
    fclose($file); 
    
    header('Location: login_controller.php');

?>
