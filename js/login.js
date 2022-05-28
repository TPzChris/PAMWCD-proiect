let formNotFilled = (form) => {
    
    if (form["username"].value == "") {
        alert(`Username must be filled out`);
        return false;
    }

    if (form["password"].value == "") {
        alert(`Password must be filled out`);
        return false;
    }
}

