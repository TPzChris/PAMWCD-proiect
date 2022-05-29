let resp = (el) => {
    let prods = [];
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.status == 200) {
            prods = JSON.parse(this.responseText);
            if(prods)
            $("#tags").autocomplete({
                source: prods,
                select: (event, ui) => window.location.href = "./../pages/prod.php?prod=" + ui.item.value
            });
        }
    }
    xmlhttp.open("GET", "./../php/prodsSearchPHP.php?prods=display", true);
    xmlhttp.send();
};