require('./bootstrap');
import ScrollReveal from 'scrollreveal'

function logout(event){
    event.preventDefault();
    document.getElementById('logout-form').submit();
}

ScrollReveal().reveal('.post',{
    origin:'top',
    distance: '30px',
    duration:1000,
    interval:500
});

new VenoBox({
    selector: '.venobox',
    numeration: true,
    infinigall: true,
    share: true,
    spinner: 'rotating-plane',
    titleattr: 'data-title',
});

// Swal.fire({
//     title: 'Error!',
//     text: 'Do you want to continue',
//     icon: 'error',
//     confirmButtonText: 'Cool'
// });

