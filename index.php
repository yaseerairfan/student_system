<!DOCTYPE html>
<html>
<head>
    //student info sys
    <title>Student Information System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- BOOT GRID -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.bootgrid.min.css" />
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.bootgrid.min.js"></script>  
    <script src="js/jquery.bootgrid.fa.min.js"></script>

    <script src="js/jquery.validate.min.js"></script>
    <script src="js/additional-methods.min.js"></script>
    <script src="form.js"></script>
    <link rel="stylesheet" href="css/style.css">

    
    <!-- HIGH CHART -->
    <script src="code/highcharts.js"></script>
    <script src="code/modules/exporting.js"></script>
    <script src="code/modules/export-data.js"></script>
    <script src="code/modules/accessibility.js"></script>

</head>

    
<body>

<div class="container">
    <!-- FORM -->
    <form method="POST" id="studentForm" name="studentForm" class='studentForm' >
        <div>
            <div class="page-header">
            <h1> STUDENT INFORMATION SYSTEM </h1>

            </div>
        </div>

        <!--  FORM-ROW-1   -->

        <div class="row form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>First Name</label><br>
                    <input type="text" name="firstName" id="firstName" class="form-control">
                </div>
            </div>
            

            <div class="col-md-6">
                <div class="form-group">
                    <label>Last Name</label><br>
                    <input type="text" name="lastName" id="lastName" class="form-control">
                </div>
            </div>
        </div> 

        <!--  FORM-ROW-2   -->

        <div class="row form-row" >
            <div class="col-md-6">
                <div class="form-group">
                    <label>Father Name</label><br>
                    <input type="text" name="fatherName" id="fatherName" class="form-control">
                </div>
            </div>
            

            <div class="col-md-6">
                <div class="form-group">
                    <label>Student ID</label><br>
                    <input type="number" name="id" id="id" class="form-control">
                </div>
            </div>
        </div>

        <!--  FORM-ROW-3   -->
        <div class="row form-row" >
            <div class="col-md-12">
                <div class="form-group">
                    <label>Email</label><br>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
            </div>
        </div>

        <!--  FORM-ROW-4  -->

        <div class="row form-row" >
            <div class="col-md-6">
                <div class="form-group">
                    <label>User Name</label><br>
                    <input type="text" name="userName" id="userName" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Password</label><br>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
        </div>

        <!--  FORM-ROW-5 -->

        <div class="row form-row" >
            <div class="col-md-6">
                <div class="form-group">
                    <label>CNIC Number</label><br>
                    <input type="text" name="cnic" id="cnic" class="form-control">
                </div>
            </div>
            

            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone Number</label><br>
                    <input type="text" name="phoneNumber" id="phoneNumber" class="form-control">
                </div>
            </div>
        </div>

        <!--  FORM-ROW-6 -->

        <div class="row form-row" >
            <div class="col-md-6">
                <div class="form-group">
                    <label>Address</label><br>
                    <input type="text" name="address" id="address" class="form-control">
                </div>
            </div>
            

            <div class="col-md-6">
                <div class="form-group">
                    <label>Grade</label><br>
                    <input type="number" name="grade" id="grade" class="form-control">
                </div>
            </div>
        </div>

        <!--  FORM-ROW-7 -->

        <div class="row submit-btn" >
            <div class="col-md-6">
                <div>
                    <input type="submit" value="Submit" name='submit' id='submit' class="btn-primary form-control">  
                </div>
            </div>
        </div>

    </form>   

</div>   
<!-- DATA BOX -->
<div id='data'></div> 

<!--= HIGH CHART BOX -->
<h2>STUDENT INFORMATION CHART</h2>
<div id='highChartDiv'></div>

<!-- BOOT GRID -->
<h2>STUDENT INFORMATION GRID</h2>
<div class="table-responsive">
<table id="student_table" class="table table-bordered table-striped">
 <thead>
  <tr>
   <th data-column-id="id" data-type="numeric">ID</th>
   <th data-column-id="first_name">First Name</th>
   <th data-column-id="last_name">Last Name</th>
   <th data-column-id="father_name">Father Name</th>
   <th data-column-id="student_id">Student ID</th>
   <th data-column-id="user_name">User Name</th>
   <th data-column-id="password">Password</th>
   <th data-column-id="cnic">cnic</th>
   <th data-column-id="phone_number">Phone Number</th>
   <th data-column-id="address">Address</th>
   <th data-column-id="grade">Grade</th>
  </tr>
 </thead>
</table>
</div>
<script type="text/javascript">
$('#student_table').bootgrid({
  ajax: true,
  rowSelect: true,
  post: function()
  {
   return{
    id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
   };
  },
  url: "fetch.php",
 });

</script>
</body>
</html>
