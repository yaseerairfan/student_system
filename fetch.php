<?php
include_once "include/user.inc.php";

$query = '';
$data = array();
$records_per_page = 10;
$start_from = 0;
$current_page_number = 0;

if(isset($_POST["rowCount"]))
{
 $records_per_page = $_POST["rowCount"];
}
else
{
 $records_per_page = 10;
}
if(isset($_POST["current"]))
{
 $current_page_number = $_POST["current"];
}
else
{
 $current_page_number = 1;
}
$start_from = ($current_page_number - 1) * $records_per_page;
$query .= " SELECT * FROM student_system ";
if(!empty($_POST["searchPhrase"]))
{
 $query .= 'WHERE (id LIKE "%'.$_POST["searchPhrase"].'%" ';
 $query .= 'OR first_name LIKE "%'.$_POST["searchPhrase"].'%" ';
 $query .= 'OR last_name LIKE "%'.$_POST["searchPhrase"].'%" ';
 $query .= 'OR father_name LIKE "%'.$_POST["searchPhrase"].'%" ';
 $query .= 'OR student_id LIKE "%'.$_POST["searchPhrase"].'%" ';
 $query .= 'OR email LIKE "%'.$_POST["searchPhrase"].'%" ';
 $query .= 'OR user_name LIKE "%'.$_POST["searchPhrase"].'%" ';
 $query .= 'OR password LIKE "%'.$_POST["searchPhrase"].'%" ';
 $query .= 'OR cnic LIKE "%'.$_POST["searchPhrase"].'%" ';
 $query .= 'OR phone_number LIKE "%'.$_POST["searchPhrase"].'%" ';
 $query .= 'OR address LIKE "%'.$_POST["searchPhrase"].'%" ';
 $query .= 'OR grade LIKE "%'.$_POST["searchPhrase"].'%" )';
}

if($records_per_page != -1)
{
 $query .= " LIMIT " . $start_from . ", " . $records_per_page;
}


$grid = new Dbh();
$grid->connect();
$result = $grid->connect()->query($query);
while($row = $result->fetch_assoc())
{
 $data[] = $row;
}

$total_records = mysqli_num_rows($result);

$output = array(
 'current'  => $current_page_number,
 'rowCount'  => 10,
 'total'   => intval($total_records),
 'rows'   => $data
);
$output = json_encode($output);
echo $output;


?>