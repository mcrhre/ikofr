function password_toggle(par){
    var password = $(par).attr('type');
    if(password === 'password'){
        $(par).attr('type','text');
    } else {
        $(par).attr('type','password');
    }
}