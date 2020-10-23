$(function() {

  //TO VALIDATE REGEX
  $.validator.addMethod("password",function(value,element)
  {return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{6,16}$/i.test(value);},
  "Passwords are 6-16 characters");

  $.validator.addMethod("phoneNumber",function(value,element)
  {return this.optional(element) || /^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$/i.test(value);},
  "Please Enter a valid Phone Number");

  $.validator.addMethod("cnic",function(value,element)
  {return this.optional(element) || /^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/i.test(value);},
  "Please Enter a valid CNIC Number");

  $("form[name='studentForm']").validate({

    //RULES
    rules: {
      firstName:{required: true,
                  minlength: 3, 
                  maxlength: 10} ,
      lastName: {required: true,
                  minlength: 3,
                  maxlength: 10} ,

      fatherName: {required: true, 
                    minlength: 3,
                    maxlength: 10} ,

      id: {required: true,
            number: true,
            minlength: 4,
            maxlength: 4 },

      phoneNumber: {required: true, 
                    phoneNumber: true},

      grade:  {required: true,
                number: true,
                minlength: 1,
                maxlength: 2,
                integer: true,  // <- here
                range: [1, 10] },
      
      email: {
        required: true,
        email: true,
        minlength: 10,
        maxlength: 30,
      },
      address:{required: true, 
                minlength: 10, 
                maxlength: 30},
                
      password: {required: true, 
                 password: true},

      cnic: {required: true,
             cnic: true},

      userName: {required: true,
                minlength: 5,
                maxlength: 10,}      
    },
    //MESSAGES
    messages: {
      
      firstName: {
          required: "Please enter your firstname",
          minlength: "Your first name must be at least 3 characters long",
          maxlength: "Your first name max length must be 10 characters long"
        },
      lastname:{
          required: "Please enter your last name",
          minlength: "Your last name must be at least 3 characters long",
          maxlength: "Your last name max length must be 10 characters long"
        },
      fatherName: {
          required: "Please enter your father name",
          minlength: "Your father name must be at least 3 characters long",
          maxlength: "Your father name max length must be 10 characters long"
        },  
      id:{required: "Please enter your Student ID", 
          number: "Please enter a valid number",
        minlength: "length of ID must be 4 digits",
        maxlength: "length of ID must be 4 digits"},  

      phoneNumber:{required: "Please enter your Phone Number"},

      grade:{
          required: "Please enter your Grade",
          number: "Please enter a valid number",
          minlength: "Grade must be of minimum 1 digit",
          maxlength: "Grade must be of maximum 2 digits",
          integer: "Please enter valid Grade",
          Range: "Please Enter a valid Grade from 1 to 10"},    
            
      email: {
          required: "Please enter your email",
          email: "Please enter a valid email address",
          minlength: "minimum length of email must be 10 characters long",
          maxlength: "maximum length of email must be 30 characters long"
      },
      address: {
          required: "Please enter your address",
          minlength: "Your address must be at least 10 characters long",
          maxlength: "Your address max length must be 30 characters long"
      },
      password:{ required: "Password field is required"},
      
      cnic: { required: "CNIC Field is required",},

      userName: {
        required: "USER Name Field is required",
        minlength: "User Name must be atleast 5 characters long",
        maxlength: "User Name must be maximum 10 characters long",}
    },
  });
});


//JS SCRIPT
  
$(document).ready(function(){
  
  

  $.ajax({
    
    type: "POST",
    url: 'submission.php',
    dataType: "json",
    success: function(data) {
 
    Highcharts.chart('highChartDiv', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'STUDENT INFO SYSTEM'
            },
            subtitle: {
                text: 'STUDENTS AND GRADES'
            },
            xAxis: {
                categories: data.names
            },
            yAxis: {
                title: {
                    text: 'GRADES'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'students',
                data: data.grades
            }]
        });      
    }
  });

  $('#studentForm').on('submit', function(e){
    e.preventDefault();
    if ($("#studentForm").valid()) {

      var firstName = $('#firstName').val();
      var lastName = $('#lastName').val();
      var fatherName = $('#fatherName').val();
      var id = $('#id').val();
      var email = $('#email').val();
      var phoneNumber = $('#phoneNumber').val();
      var address = $('#address').val();
      var grade = $('#grade').val();
      var userName = $('#userName').val();
      var password = $('#password').val();
      var cnic = $('#cnic').val();
      var submit = $('#submit').val();
      
      
      $.ajax({
        
        type: "POST",
        url: 'submission.php',
        data: { firstName: firstName,
                lastName: lastName,
                fatherName: fatherName,
                id: id,
                email: email,
                phoneNumber: phoneNumber,
                address: address,
                grade: grade,
                userName: userName,
                password: password,
                cnic: cnic,
                submit: submit,

        },
        success: function(data) {

          $('#data').html(data);
          $('#data').css({"background": "#F9F9F9",
                          "padding": "25px",
                          "margin":"100px",
                          "box-shadow": "0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24)",
                          "border-radius": "30px",
                          "width": "50%" }); 
        }
      });
    }else{
       document.write("Please correctly fill the form");
      }

    });
});
 
