
<?php

include 'include/user.inc.php';

$chart= new Dbh();
$chart->generateHighChart();
$result = json_encode($chart->result);
echo $result;



$errorArray = [];
$requiredError = false;
$lengthError = false;
$formatError = false;

//FUNCTION TO CHECK REGEX
function checkemail($str) {
    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str) && (strlen($str) < 10 OR strlen($str) > 30) ) {
        return false;
    }else {
        return true;
    }
};
function checkPhoneNumber($num) {
    if (!preg_match("/^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$/", $num)) {
        return false;
    }else {
        return true;
    }
}
function checkPassword($pass){
    if(!preg_match("/^[A-Za-z0-9!@#$%^&*()_]{6,16}$/i", $pass)){
        return false;
    }else{
        return true;
    }
}
function checkCnic($cnic){
    if(!preg_match("/^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/", $cnic)){
        return false;
    }else{
        return true;
    }
}
//WHEN FORM IS SUBMITTED
if (isset($_POST['submit'])){

//WHEN FIELD IS EMPTY
    try{
        foreach ($_POST as $key => $value){
            if (empty($value)) {
                $requiredError = true;
                $errorArray[] = "$key Field is required";
            }
        }
        if($requiredError == true){
            throw new Exception("Please fill all required fields");
        }
    }
    catch(Exception $exc){
        echo "REQUIRED ERROR: " , $exc->getMessage() ."<br>";
    }
    if ((!empty($_POST["firstName"])) && strlen($_POST["firstName"]) < 3 OR strlen($_POST["firstName"]) > 10) {
        $errorArray[] = "Length of First Name must be of minimum length 3 and maximum length 10";
        $lengthError = true;
    }
    if ((!empty($_POST["lastName"])) && strlen($_POST["lastName"]) < 3 OR strlen($_POST["lastName"]) > 10) {
        $errorArray[] = "Length of LAST Name must be of minimum length 3 and maximum length 10";
        $lengthError = true;
        
    }
    if ((!empty($_POST["fatherName"])) && strlen($_POST["fatherName"]) < 3 OR strlen($_POST["fatherName"]) > 10) {
        $errorArray[] = "Length of Fathers Name must be of minimum length 3 and maximum length 10";
        $lengthError = true;

        
    }
    if ((!empty($_POST["address"])) && strlen($_POST["address"]) < 10 OR strlen($_POST["address"]) > 30) {
        $errorArray[] = "Length of address field must be of minimum length 10 and maximum length 30";
        $lengthError = true;
        
    }
    if ((!empty($_POST['id'])) && strlen($_POST['id']) != 4) {
        $errorArray[] = "Please enter 4 digit ID in this field";
        $lengthError = true;
        
    }
    if ((!empty($_POST['phoneNumber'])) && !checkPhoneNumber($_POST['phoneNumber'])) {
        $errorArray[] = "Phone number is Invalid"; 
        $formatError = true;
        
    }
    if ((!empty($_POST['grade'])) && strlen($_POST['grade']) > 2) {
        $errorArray[] = "Grade is of more than 2 digits"; 
        $lengthError = true;
        
    }
    if ((!empty($_POST["userName"])) && strlen($_POST["userName"]) < 5 OR strlen($_POST["userName"]) > 10) {
        $errorArray[] = "Length of User Name must be of minimum length 5 and maximum length 10";
        $lengthError = true;
    }
    if ((!empty($_POST["email"])) && !checkemail($_POST['email'])) {
        $errorArray[] = "Invalid email address";
        $formatError = true;
        
    }
    if ((!empty($_POST['cnic'])) &&  !checkCnic($_POST['cnic'])){
        $errorArray[] = "Invalid CNIC";
        $formatError = true;
        
    }
    if ((!empty($_POST["password"])) && !checkPassword($_POST['password']))  {
        $errorArray[] = "Password length must between 6-16 characters";
        $formatError = true;
        
    }
    // EXCEPTION THROW
    try{
        if($lengthError == true){
            throw new Exception("Fulfill the length of characters");
        }

    }
    catch(Exception $exc){
        echo "LENGTH ERROR: " , $exc->getMessage() ."<br>";
    }
    try{

        if($formatError == true){
            throw new Exception("Please Follow Proper Format");
        }
    }
    catch(Exception $exc){
        echo "FORMAT ERROR: " , $exc->getMessage(). "<br>";
    }
    try{
        if (!empty($errorArray)) {
                
            echo '<h2>ERRORS</h2>';
            foreach ($errorArray as $key => $value) {
                echo $value .'<br>';
            }
            throw new Exception ("ERROR: Form is not filled correctly \n ");    
        }else{
            $users = new Dbh();
            $users->insertRecord(
            'student_system',
            ['first_name', 'last_name','father_name','student_id','email','user_name','password','cnic','phone_number','address','grade'],
            ["'".$_POST['firstName']."'","'".$_POST['lastName']."'","'".$_POST['fatherName']."'","'".$_POST['id']."'","'".$_POST["email"]."'", "'".$_POST["userName"]."'","'".$_POST["password"]."'","'".$_POST['cnic']."'","'".$_POST['phoneNumber']."'","'".$_POST['address']."'","'".$_POST['grade']."'"]
        ); 
        ?>

<?php
            echo '<h2>STUDENT INFO</h2>';
            foreach ($_POST as $key => $value) {
                echo $key . ':' . $value . '<br>';
            }
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}    

