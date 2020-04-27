<?php 
require('includes/form_validator.php');
 
if(isset($_POST['submit'])){
    $validation = new FormValidator($_POST);
    $msgs = $validation->validateForm(); // returns msgs array
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>PHP Contact Form</title>
</head>
<body>

    <div class="form-container">
    <h2>Contact Us</h2>
    <div class="success"> <?php echo $msgs['success'] ?? ''; ?></div>
    <div class="error"> <?php echo $msgs['error'] ?? ''; ?></div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label >Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username']  ?? ''); ?>">
        <div class="error">
        <?php echo $msgs['username'] ?? ''; ?>
        </div>
        
        <label >Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email']  ?? ''); ?>">
        <div class="error">
        <?php echo $msgs['email'] ?? ''; ?>
        </div>

        <label >Subject:</label>
        <input type="text" name="subject" value="<?php echo htmlspecialchars($_POST['subject']  ?? ''); ?>">
        <div class="error">
        <?php echo $msgs['subject'] ?? ''; ?>
        </div>

        <label >Message:</label>
        <textarea name="message" rows="10"><?php echo htmlspecialchars($_POST['message']  ?? ''); ?></textarea>
        <div class="error">
        <?php echo $msgs['message'] ?? ''; ?>
        </div>

        <input type="submit" name="submit" value="Submit"> 
    </form>
    
    </div>

</body>
</html>