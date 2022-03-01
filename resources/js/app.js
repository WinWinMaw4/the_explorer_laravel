require('./bootstrap');

function logout(event){
    event.preventDefault();
    document.getElementById('logout-form').submit();
}
