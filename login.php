<?php // Do not put any HTML above this line
session_start();

require_once "pdo.php";


if (isset($_POST['cancel'])) {
    // Redirect the browser to game.php
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = hash('md5', 'XyZzy12*_php123');;  // Pw is meow123

$failure = false;  // If we have no POST data

// Check to see if we have some POST data, if we do process it

    

if (isset($_POST['email']) && isset($_POST['pass'])) {
    //unset($_SESSION["email"]);
    unset($_SESSION["email"]);

    if ( isset($_SESSION['error']) ) {
        unset($_SESSION['error']);
    }

    if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['error'] = "User name and password are required";
        error_log('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        header("Location: login.php");
        return;
    } else if (strpos($_POST['email'], "@") === false) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        error_log('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        header("Location: login.php");
        return;
    } else {
        $check = hash('md5', $salt . $_POST['pass']);
        if ($check == $stored_hash) {
            $_SESSION['name'] = $_POST['email'];
            $_SESSION["success"] = "Login success.";
            error_log("Login success ".$_POST['email']);
            echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
            header("Location: view.php?email=".urlencode($_POST['email']));
            return; 
        } else {
            $_SESSION['error'] = "Incorrect password";
            error_log("Login fail ".$_POST['email']." $check");
            echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
            header("Location: login.php");
            return;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once "bootstrap.php"; ?>
    <title>9ecaa54b</title>
</head>
<body>
<div class="container">
    <h1>Please Log In</h1>
    <?php
    // Note triple not equals and think how badly double
    // not equals would work here...
    if ( isset($_SESSION["error"]) ) {
        echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }
        
    if ($failure !== false) {
        // Look closely at the use of single and double quotes
        echo('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
    }
    ?>
    <form method="POST">
        <label for="nam">User Name</label>
        <input type="text" name="email" id="nam"><br/>
        <label for="id_1723">Password</label>
        <input type="text" name="pass" id="id_1723"><br/>
        <input type="submit" value="Log In">
        <input type="submit" name="cancel" value="Cancel">
    </form>
    <p>
        For a password hint, view source and find a password hint
        in the HTML comments.
        <!-- Hint: The password is the four character sound a cat
        makes (all lower case) followed by 123. -->
    </p>
</div>
</body>
