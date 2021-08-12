
<?php

function confirm_query($result)
{
    global $conn;
    if (!$result) {
        die("Query is not executed" . mysqli_error($conn));
    } else {
        return true;
    }
}

function is_admin($username = '')
{
    global $conn;
    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    confirm_query($result);
    $row = mysqli_fetch_array($result);

    if ($row["user_role"] == 'admin') {
        return true;
    } else {
        return false;
    }
}


function username_exists($username)
{
    global $conn;
    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    confirm_query($result);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function email_exists($email)
{
    global $conn;
    $query = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    confirm_query($result);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function redirect_page($location)
{
    return header("Location: " . $location);
}

function register_user($username, $email, $password)
{

    global $conn;

    if (!empty($username) && !empty($email) && !empty($password)) {

        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $simplePassword = mysqli_real_escape_string($conn, $password);

        $password = password_hash($simplePassword, PASSWORD_BCRYPT, array('cose' => 12));

        $query = "INSERT INTO users (username,user_email,user_password,user_role) ";
        $query .= "VALUES('$username','$email','$password','subscriber')";
        $register_user = mysqli_query($conn, $query);

        confirm_query($register_user);
    }
}

function login_user($username, $password)
{
    global $conn;

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM users WHERE username = '$username'";
    $select_user_query = mysqli_query($conn, $query);
    if (!$select_user_query) {
        die("Query Failed" . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($select_user_query)) {
        $db_user_id = $row["user_id"];
        $db_username = $row["username"];
        $db_userfirstname = $row['user_firstname'];
        $db_userlastname = $row["user_lastname"];
        $db_user_password = $row["user_password"];
        $db_user_role = $row["user_role"];
    }



    if (password_verify($password, $db_user_password)) {
        // session_start();
        $_SESSION["username"] = $db_username;
        $_SESSION["firstname"] = $db_userfirstname;
        $_SESSION["lastname"] = $db_userlastname;
        $_SESSION["user_role"] = $db_user_role;
        
        redirect_page("/php_cms_edwin/admin");
    } else {
        
        redirect_page("/php_cms_edwin/index.php");
    }
}

?>