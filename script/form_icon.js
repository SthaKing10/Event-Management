// var password_hide_icon = document.getElementById('hide_icon');
//     var password_input = document.getElementById('password_input');
//     password_hide_icon.addEventListener('click', function (){
//         if(password_input.type == 'password'){
//             password_input.type = 'text';
//             password_hide_icon.src = '../uploads/login_icon/visible.png';
//         }
//         else{
//             password_input.type = 'password';
//             password_hide_icon.src = '../uploads/login_icon/hide.png';
//         }

//     });


var password_hide_icons = document.getElementsByClassName('hide_icon');
var password_inputs = document.getElementsByClassName('password_input');

for (let i = 0; i < password_hide_icons.length; i++) {
    password_hide_icons[i].addEventListener('click', function () {

        if (password_inputs[i].type === 'password') {
            password_inputs[i].type = 'text';
            password_hide_icons[i].src = '../uploads/login_icon/visible.png';
        } else {
            password_inputs[i].type = 'password';
            password_hide_icons[i].src = '../uploads/login_icon/hide.png';
        }

    });
}
