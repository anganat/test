<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include_once('Register.php');

session_start();
if (! isset($_SESSION['email'])) {
    header('Location: index.php');
}

$obj = new Register();
$userName = $obj->getUserName($_SESSION['email']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style>
    .modal-header {
    padding-bottom: 50px ;
    padding-top: 15px;
    }
    </style>

</head>
<body>


<div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="col-md-8">
                <h4 class="modal-title" id="myModalLabel">Welcome <?php echo $userName; ?></h4>
            </div>
            <div class="col-md-4">
                <a href="logout.php" class="btn btn-primary btn-block">Log Out</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
</body>
</html>
