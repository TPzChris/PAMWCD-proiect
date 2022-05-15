let formNotFilledOrInvalid = (form) => {
    
    if (form["username"].value == "") {
        alert(`Username must be filled out`);
        return false;
    }

    if (form["pass1"].value == "" || form["pass2"].value == "") {
        alert(`Password must be filled out`);
        return false;
    }

    if (form["pass1"].value !== form["pass2"].value) {
        alert(`The passwords don't coincide`);
        return false;
    }

    var emailPattern = "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$";
    
    
    if (!String(form["email"].value).match(emailPattern)){
        alert(`The email is invalid`);
        return false;
    }

}

