<?php

session_start();
require("./etc/info.php");

?>

<html>
<?php

include("./etc/header.html")

?>

<?php
    if(isset($_POST["username"]) && isset($_POST["password"])) {
        $db = mysql_connect("localhost", $user, $pass);
        if(!$db) {
            die("connot connect the database " . mysql_error());
        }

        mysql_select_db("users_info", $db);

        $sql = sprintf("SELECT 1 from users where user='%s' and pass=AES_ENCRYPT('%s', '%s')", 
        mysql_real_escape_string($_POST["username"]), 
        mysql_real_escape_string($_POST["password"]),
        mysql_real_escape_string($_POST["password"]));

        $result = mysql_query($sql);
        
        if(mysql_num_rows($result) === 1 && mysql_result($result, 0) === "1") {
?>
            <header class="jumbotron subhead" id="overview">
            <div class="container">
                <h1>jQuery UI Bootstrap</h1>
                <p class="lead">A Bootstrap-themed kickstart for jQuery UI widgets (v0.5).</p>
            </div>
        </header>
            <h2 style="margin: 100px">Login Successfully</h2>
            
<?php
        }
        else {
?>
            <div style="margin: 100px">
                <h2>Failed</h2>
                <p>Return the <a href="./index.html">login page</a></p>
            </div>
<?php
        }
    }
?>

</html>