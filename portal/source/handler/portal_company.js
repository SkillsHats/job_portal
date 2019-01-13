function allowed(){
    var flag = 0;
    var selected = document.getElementsByName('permissions[]');

    for(var i = 0; i < selected.length; i++){
        if(selected[i].checked === true){
            flag++;
        }
    }
    let total = 0;

    if(flag > total){
        alert("You can select only <?php echo $left; ?>.");
        return false;
    }
}