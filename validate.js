function validate(){

    var msg = "";
    
    // Mobile No 1

    var mobile_no1 = document.forms["form1"]["mob1"].value;            
    phoneNoValidate (mobile_no1,"Mobile No 1");

    // Mobile No 2

    var mobile_no2 = document.forms["form1"]["mob2"].value;
    if (mobile_no2.length >0)phoneNoValidate (mobile_no2,"Mobile No 2");
    

    // Land No 

    var land_no = document.forms["form1"]["land"].value;
    if (land_no.length >0)phoneNoValidate (land_no,"Land No");

    // Common function to validate phone numbers

    function phoneNoValidate(field_value, field_name){

        // to get First Character
        var firstChar = field_value.charAt(0);
    
        if (firstChar !== "0" && firstChar !== "+")
            msg += field_name+" is Invalid - Begin with '0' or '+'<br>";
        else if (firstChar == "0" && field_value.length != 10)
            msg += field_name+" is Invalid - 10 Numbers Required<br>";
        else if (firstChar =="+" && field_value.length != 12)
            msg += field_name+" is Invalid - 12 Numbers Required<br>";
        
    }

    // Email Validation

    var email = document.forms["form1"]["email"].value;

    var at_symbol = email.indexOf("@");
    var last_dot = email.lastIndexOf(".");

    if (last_dot<at_symbol) msg += "Email is Invalid<br>";

    // User Name

    var user_name = document.forms["form1"]["uname"].value;

    if (user_name.trim() == "") msg += "Name is invalid <br>";

    // Display Messages

    if (msg !== ""){
        document.getElementById("msg").style.display="block";
        document.getElementById("msg").innerHTML=msg;

        return false;
    }
}