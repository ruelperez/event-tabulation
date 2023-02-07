function printTable(id){
    let prnt = document.getElementById('table'+id).innerHTML;
    let original = document.body.innerHTML;
    document.body.innerHTML= prnt;
    window.print();
    document.body.innerHTML = original;

}

function saveImage(id){
    html2canvas(document.querySelector("#save-image"+id)).then(function (canvas) {
        var link = document.querySelector("#save-image"+id);
        link.setAttribute("download", "123456.png");
        link.setAttribute(
            "href",
            canvas.toDataURL("image/png").replace("image/png", "image/octet-stream")
        );
        link.click();
    });
}
