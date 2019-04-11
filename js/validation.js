function contactValidation(){
    var name = document.contactUsForm.name;
    var subject = document.contactUsForm.subject;
    var email = document.contactUsForm.email;
    var address = document.contactUsForm.address;
    var message = document.contactUsForm.message;
    
    nonempty(name);
	ValidateEmail(email);
	nonempty(address);
	nonempty(subject);
    nonempty(message);
    
    if(nonempty(name))
    {
        if(ValidateEmail(email))
        {
            if(nonempty(address))
            {
                if(nonempty(subject))
                {    
                    if(nonempty(message))
                    {
                       return true;
                    } 
                }
            }
        }
    }
    return false;
} 

function validateRegistration(){
    var name = document.regForm.name;
    var email = document.regForm.email;
    var phone = document.regForm.phoneNumber;
	var profession = document.regForm.profession;
    var pass = document.regForm.pass;
    
   //alert(pass.length); 
    
    if(nonempty(name) && allLetter(name))
    {
       
            if(ValidateEmail(email))
            {
                if(allnumericPhone(phone,11))
                {    
                    if(pass_validation(profession))
                    {
                        if(nonempty(pass) )
                        {
                           
                         return true;
                                
                        }
                    } 
                }
            }
        
    }
    return false;
	  
	  
} 
// Function to check letters and numbers  
function alphanumeric(inputtxt)  
{  
//var k=inputtxt;
// alert(k.length); 
 var letterNumber = "/^[0-9a-zA-Z]+$/";  
 if((inputtxt.value.match(letterNumber)) && inputtxt.length>=8)   
  {  
   return true;  
  }  
else  
  {   
        
        inputtxt.focus();
        inputtxt.value="";
        inputtxt.placeholder="Password length should be greater than 8 and mix of characters and numbers";
        inputtxt.style.borderColor = "red";  
        return false;   
  }  
  }  
function userLogin(){
    var uname = document.loginForm.username;
    var pass = document.loginForm.password;
     
    if(nonempty(uname))
    {
            if(ValidateEmail(uname))
            {
                        if(nonempty(pass))
                        {
                           
                         return true;
                                
                        }

            }
        
    }
    return false;
 
}

function validateTeam(){
    var name = document.createTeam.name;
    var category = document.createTeam.category;
    var message = document.createTeam.message;
	
    if(nonempty(name))
    {
        if(nonempty(category))
        {
            if(nonempty(message))
            {     
		     return true;        
            }
        }
    }
    return false;
}

function validateEditTeam(){
    var category = document.editTeam.category;
    var message = document.editTeam.description;
	
        if(nonempty(category))
        {
            if(nonempty(message))
            {     
		     return true;        
            }
        }
    return false;
}
function validateTask(){
    var title = document.createTask.title;
    var description = document.createTask.description;
        if(nonempty(title))
        {
            if(nonempty(description))
            {     
		     return true;        
            }
        }
    return false;
}

function agentResponseValidation(){
    var price = document.agentResponseForm.price;
    var detail = document.agentResponseForm.detail;
    var term = document.agentResponseForm.term;
    var pincode = document.agentResponseForm.pincode;
    
    allnumeric(price);
    nonempty(detail);
    allnumericTerm(term);
    allnumericPincode(pincode,6);
    
    if(allnumeric(price))
    {
        if(nonempty(detail))
        {
            if(allnumericTerm(term))
            {    
                if(allnumericPincode(pincode,6))
                {
                    return true;        
                } 
            }
        }
    }
    return false;
}

function tenancyRequestValidation(){
    var name = document.tenancyRequestForm.name;
    var race = document.tenancyRequestForm.race;
    var pax = document.tenancyRequestForm.pax;
    var occupation = document.tenancyRequestForm.occupation;
    var type = document.tenancyRequestForm.type;
    var budget = document.tenancyRequestForm.budget;
    var relation = document.tenancyRequestForm.relation;
    var immigration = document.tenancyRequestForm.immigration;
    var location = document.tenancyRequestForm.location;
    var furnishing = document.tenancyRequestForm.furnishing;
    
    
    if(nonempty(name))
        allLetter(name);
    if(nonempty(race))    
        allLetter(race);
    
    ValidateDropDown(pax);
    
    if(nonempty(occupation))
        allLetter(occupation);
    
    ValidateDropDown(type);
    ValidateDropDown(budget);
    
    if(nonempty(relation))
        allLetter(relation);
    
    if(nonempty(immigration))
        allLetter(immigration);
    
    ValidateLocation(location);
    ValidateFurnish(furnishing);
    
    if(nonempty(name) && allLetter(name))
    {
        if(nonempty(race) && allLetter(race))
        {
            if(ValidateDropDown(pax))
            {
                if(nonempty(occupation) && allLetter(occupation))
                {    
                    if(ValidateDropDown(type))
                    {
                        if(ValidateDropDown(budget))
                        {
                            if(nonempty(relation) && allLetter(relation))
                            {
                                if(nonempty(immigration) && allLetter(immigration))
                                {
                                    if(ValidateLocation(location))
                                    {
                                        if(ValidateFurnish(furnishing))
                                        {
                                            return true;
                                        }
                                    }
                                }
                            }
                        }
                    } 
                }
            }
        }
    }
    return false;
}

function addAgentValidation(){
    var name = document.addAgentForm.name;
    var surname = document.addAgentForm.surname;
    var email = document.addAgentForm.email;
    var phone = document.addAgentForm.phone;
    var pass = document.addAgentForm.pass;
    var regNo = document.addAgentForm.regNo;
    var agency = document.addAgentForm.agency;
    
    if(nonempty(name))
        allLetter(name);
	if(nonempty(surname))
        allLetter(surname);
    ValidateEmail(email);
    allnumericPhone(phone,8);
    pass_validation(pass);
    nonempty(regNo);
    nonempty(agency);
    
    if(nonempty(name) && allLetter(name))
    {
        if(nonempty(surname) && allLetter(surname))
        {
            if(ValidateEmail(email))
            {
                if(allnumericPhone(phone,8))
                {    
                    if(pass_validation(pass))
                    {
                        if(nonempty(regNo))
                        {
                            if(nonempty(agency))
                            {
                                return true;
                            } 
                        }
                    } 
                }
            }
        }
    }
    return false;
}

function editAgentValidation(){
    var name = document.editAgentForm.name;
    var surname = document.editAgentForm.surname;
    var email = document.editAgentForm.email;
    var phone = document.editAgentForm.phone;
    //var pass = document.editAgentForm.pass;
    var regNo = document.editAgentForm.regNo;
    var agency = document.editAgentForm.agency;
    if(nonempty(name))
        allLetter(name);
	if(nonempty(surname))
        allLetter(surname);
    ValidateEmail(email);
    allnumericPhone(phone,8);
    //pass_validation(pass);
    nonempty(regNo);
    nonempty(agency);
    
    if(nonempty(name) && allLetter(name))
    {
        if(nonempty(surname) && allLetter(surname))
        {
            if(ValidateEmail(email))
            {
                if(allnumericPhone(phone,8))
                {    
                    //if(pass_validation(pass))
                   // {
                        if(nonempty(regNo))
                        {
                            if(nonempty(agency))
                            {
                                return true;
                            } 
                        }
                    //} 
                }
            }
        }
    }
    return false;
}

function addTenantValidation(){
    var name = document.addTenantForm.name;
    var email = document.addTenantForm.email;
    var phone = document.addTenantForm.phone;
    var pass = document.addTenantForm.pass;
    
    if(nonempty(name))
        allLetter(name);
    ValidateEmail(email);
    allnumericPhoneTenant(phone,8);
    pass_validation(pass);
    
    if(nonempty(name) && allLetter(name))
    {
        if(ValidateEmail(email))
        {
            if(allnumericPhoneTenant(phone,8))
            {    
                if(pass_validation(pass))
                {
                    return true;
                } 
            }
        }
    }
    return false;
}

function editTenantValidation(){
    var name = document.editTenantForm.name;
    var email = document.editTenantForm.email;
    var phone = document.editTenantForm.phone;
    //var pass = document.addTenantForm.pass;
    
    if(nonempty(name))
        allLetter(name);
    ValidateEmail(email);
    allnumericPhoneTenant(phone,8);
    //pass_validation(pass);
    
    if(nonempty(name) && allLetter(name))
    {
        if(ValidateEmail(email))
        {
            if(allnumericPhoneTenant(phone,8))
            {    
                //if(pass_validation(pass))
                //{
                    return true;
                //} 
            }
        }
    }
    return false;
}

function indexValidation(){
    var type = document.indexForm.type;
    var budget = document.indexForm.budget;
    var location = document.indexForm.locationIn;
    ValidateDropDown(type);
    ValidateDropDown(budget);
    ValidateLocationIn(location);
    if(ValidateDropDown(type))
    {
        if(ValidateDropDown(budget))
        {
            if(ValidateLocationIn(location))
            {
                return true;
            }
        }
    }
    return false;
}


// Empty Field Validation Function
function nonempty(vari){
    var vari_len = vari.value.length;
    if (vari_len == 0)
    {
        vari.focus();
        vari.value="";
        vari.placeholder="This field should not be Empty";
        vari.style.borderColor = "red";
        return false;
    }
    vari.style.borderColor = "green";
    return true;
}

// All Alphabet Characters Validation
function allLetter(vari){ 
    var letters = /^[a-zA-Z\s]*$/;
    if(vari.value.match(letters))
    {
        vari.style.borderColor = "green";
        return true;
    }
    else
    {
        vari.focus();
        vari.style.borderColor = "red";
        vari.value=""
        vari.placeholder = "Alphabet characters only";
        return false;
    }
}

// Email Field Validations Functions
function ValidateEmail(uemail){
    var emaill = uemail.value.length;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(uemail.value.match(mailformat) && emaill != 0)
    {
        uemail.style.borderColor = "green";
        return true;
    }
    else
    {
        uemail.focus();
        uemail.style.borderColor = "red";
        uemail.value="";
        uemail.placeholder="You have entered an invalid email address!";
        return false;
    }
} 

// Phone Number Field Validations Functions
function allnumericPhone(phone,max){ 
    var numbers = /^[0-9]+$/;
    var phone_len = phone.value.length;
    if(phone.value.match(numbers) && phone_len == max)
    {
        phone.style.borderColor = "green";
        return true;
    }
    else    
    {
        phone.focus();
        phone.style.borderColor = "red";
        phone.value="";
        phone.placeholder="11 digits and numeric characters only";
        return false;
    }
}

// Phone Number Field Validations Functions
function allnumericPhoneTenant(phone,max){ 
    var numbers = /^[0-9]+$/;
    var phone_len = phone.value.length;
    if(phone.value.match(numbers) && phone_len == max)
    {
        phone.style.borderColor = "green";
        return true;
    }
    else    
    {
        phone.focus();
        phone.style.borderColor = "red";
        phone.value="";
        phone.placeholder="11 digits and numeric characters only";
        return false;
    }
}

// Price Field Validations Functions
function allnumeric(price){ 
    var numbers = /^[0-9]+$/;
    var price_len = price.value.length;
    if(price.value.match(numbers) && price_len != 0)
    {
        price.style.borderColor = "green";
        return true;
    }
    else    
    {
        price.focus();
        price.style.borderColor = "red";
        price.value="";
        price.placeholder="Empty Not allowed and Numeric only";
        return false;
    }
}

// Price Field Validations Functions
function allnumericTerm(term){ 
    var numbers = /^[0-9]+$/;
    var term_len = term.value.length;
    if(term.value.match(numbers) && term_len != 0)
    {
        term.style.borderColor = "green";
        return true;
    }
    else    
    {
        term.focus();
        term.style.borderColor = "red";
        term.value="";
        term.placeholder="Empty Not allowed and Numeric only";
        return false;
    }
}
// Price Field Validations Functions
function allnumericPincode(pincode,max){ 
    var numbers = /^[0-9]+$/;
    var pincode_len = pincode.value.length;
    if(pincode.value.match(numbers) && pincode_len == max)
    {
        pincode.style.borderColor = "green";
        return true;
    }
    else    
    {
        pincode.focus();
        pincode.style.borderColor = "red";
        pincode.value="";
        pincode.placeholder=" It must be 6 digits only";
        return false;
    }
}

// Password Field Validations Functions
function pass_validation(passid){
    var passid_len = passid.value.length;
    if (passid_len == 0)
    {
        passid.focus();
        passid.style.borderColor = "red";
        passid.value="";
        passid.placeholder="Password should not be empty";
        return false;
    }
    passid.style.borderColor = "green";
    return true;
}

// Captcha Field Validations Functions
function captchaVal(captcha,recaptcha){
    var recaptcha_len = recaptcha.value.length;
    if(recaptcha_len == 0 || captcha.placeholder != recaptcha.value)
    {
        recaptcha.focus();
        recaptcha.style.borderColor = "red";
        recaptcha.value="";
        recaptcha.placeholder="Recaptcha field value is invalid";
        return false;
    }
    recaptcha.style.borderColor = "green";
    return true;
}

// Validate DropDown 
function ValidateDropDown(vari){
    var selectedValue = vari.options[vari.selectedIndex].value;
   // alert(vari.options[vari.selectedIndex].value);
    if (selectedValue == "0" || selectedValue == "")
    {
        vari.focus();
        vari.style.borderColor = "red";
        return false;
    }
    vari.style.borderColor = "green";
    return true;
}

// Validate Location
function ValidateLocation(vari){
    var vari = document.tenancyRequestForm.elements["location[]"];
    var lbl = document.getElementById("locationLBL");
    if (document.tenancyRequestForm.elements["location[]"].selectedIndex == -1)
    {
        vari.focus();
        lbl.style.color = "red";
        lbl.innerHTML = " Select Atleast One Location.";
        return false;
    }
    lbl.style.color = "green";
    lbl.innerHTML = "Done";
    return true;
}

// Validate Location Index
function ValidateLocationIn(vari){
    var vari = document.indexForm.elements["locationIn[]"];
    var lbl = document.getElementById("locationInLBL");
    if (document.indexForm.elements["locationIn[]"].selectedIndex == -1)
    {
        
        vari.focus();
        lbl.style.color = "red";
        lbl.innerHTML = "Select Atleast One Location.";
        return false;
    }
    lbl.style.color = "green";
    lbl.innerHTML = "Done";
    return true;
}


// Validate Furnishing
function ValidateFurnish(vari){
    var vari = document.tenancyRequestForm.elements["furnishing[]"];
    var lbl = document.getElementById("furnishingLBL");
    if (document.tenancyRequestForm.elements["furnishing[]"].selectedIndex == -1)
    {
        vari.focus();
        lbl.style.color = "red";
        lbl.innerHTML = "  Select Atleast One Option.";
        return false;
    }
    vari.style.borderColor = "green";
    return true;
}
 
