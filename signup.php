<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include_once('Register.php');

$error = $emailError = $passwordError = '';
$obj = new Register();

if (isset($_POST['signup'])) {

    if ( $obj->checkEmailAvailibility($_POST['email']) ) {
        $emailError = 'Email Already exists';

    } else {
        if ( $_POST['password'] != $_POST['password_confirm'] ) {
            $passwordError = 'Your passwords do not match. Please type carefully.';
        } else {
            $user = $obj->userRegister();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SignUp Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js"></script>
</head>
<body>
<form class="form-horizontal" action='' method="post">
    <fieldset>
        <div id="legend" style="padding-left:4%">
            <legend class="">Register | <a href="index.php">Sign Up</a></legend>
        </div>
        <!--Error Message-->
        <?php if($error) { ?><div class="errorWrap">
            <strong>Error </strong> : <?php echo htmlentities($error);?></div>
        <?php } ?>

        <div class="control-group">
            <!-- Full name -->
            <label class="control-label"  for="first_name">First Name</label>
            <div class="controls">
                <input type="text" id="first_name" name="first_name" maxlength="50" value="<?php echo isset($_POST["first_name"]) ? $_POST["first_name"] : ''; ?>"  pattern="[a-zA-Z\s]+" title="First name must contain letters only" class="input-xlarge" required>
            </div>
        </div>

        <div class="control-group">
            <!-- Full name -->
            <label class="control-label"  for="last_name">Last Name</label>
            <div class="controls">
                <input type="text" id="last_name" name="last_name" maxlength="50" value="<?php echo isset($_POST["last_name"]) ? $_POST["last_name"] : ''; ?>"  pattern="[a-zA-Z\s]+" title="Last name must contain letters only" class="input-xlarge" required>
            </div>
        </div>


        <div class="control-group">
            <!-- E-mail -->
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
                <input type="email" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" placeholder="" class="input-xlarge" required>
                <span id="email-availability-status" style="font-size:12px;"><?php echo $emailError;  ?></span>
            </div>
        </div>

        <div class="control-group">
            <!-- E-mail -->
            <label class="control-label" for="dob">Date Of Birth</label>
            <div class="controls">
                <input type="text" class="input-xlarge" required name="dob" id="date-picker" value="<?php echo isset($_POST["dob"]) ? $_POST["dob"] : ''; ?>"  autocomplete="off" data-change='calendar' placeholder="">
                <span id="email-availability-status" style="font-size:12px;"></span>
            </div>
        </div>

        <div class="control-group">
            <!-- Password-->
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input type="password" id="password" name="password" pattern="^\S{4,}$"   required class="input-xlarge">
                <p class="help-block"><?php echo $passwordError;  ?></p>
            </div>
        </div>

        <div class="control-group">
            <!-- Confirm Password -->
            <label class="control-label"  for="password_confirm">Password (Confirm)</label>
            <div class="controls">
                <input type="password" id="password_confirm" required name="password_confirm" pattern="^\S{4,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '')""  class="input-xlarge">
                <p class="help-block"></p>
            </div>
        </div>

        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                <button class="btn btn-success" type="submit" name="signup">Signup </button>
            </div>
        </div>
    </fieldset>
</form>

<script type="text/javascript">
    $('#date-picker').datepicker({
        format: "dd-mm-yyyy",
        endDate: new Date(),
    });
</script>

</body>
</html>