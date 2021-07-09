function validateForm() {
	
  var name = document.getElementById("fname").value;
  if(name == ""){
	  alert("Name Should Be Filled");
	  return false;
  }
  var age = document.getElementById("fage").value;
  if(age == ""){
	  alert("Age Must Be Filled Out");
	  return false;
  }
  if(age < 18){
		  alert("Age ShoulD Be Above 18");
	  }
  var email = document.getElementById("femail").value;
  if(email == ""){
	  alert("Email Must Be Filled Out");
	  return false;
  }
  var password = document.getElementById("fpassword").value;
  if(password == ""){
	  alert("Password Must Be Filled Out");
	  return false;
  }
}