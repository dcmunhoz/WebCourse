var nameEl          = document.querySelector("#exampleInputName");
var genderEl        = document.querySelectorAll("#form-user-create [name=gender]:checked");
var birthdayEl      = document.querySelector("#exampleInputBirth");
var countryEl       = document.querySelector("#exampleInputCountry");
var emailEl         = document.querySelector("#exampleInputEmail");
var passEl          = document.querySelector("#exampleInputPassword");
var photoEl         = document.querySelector("#exampleInputFile");
var adminEl         = document.querySelector("#exampleInputAdmin");




var fields          = document.querySelectorAll("#form-user-create [name]");
fields.forEach((field, index)=>{
    console.log(field.id, field.name, field.checked, index);
});