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
            console.log(this.responseText)
            prods = JSON.parse(this.responseText);
            console.log(el.value)
            if(prods)
            $("#tags").autocomplete({
                source: prods,
                select: (event, ui) => window.location.href = "./../pages/prod.php?prod=" + ui.item.value
            });
        }
    }
    xmlhttp.open("GET", "./../php/productsPHP.php?prods=display", true);
    xmlhttp.send();
};