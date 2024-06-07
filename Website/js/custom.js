$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    autoplay: true,
    autoplayTimeout: 4000,
    responsive: {
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        },
        1200:{
            items:4
        },
        1400:{
            items:4
        },
        1600:{
            items:5
        },
        1800:{
            items:5
        }
    }
})

// function send_message(){
//     var name=jQuery("#name").val();
//     var email=jQuery("#email").val();
//     var mobile=jQuery("#mobile").val();
//     var message=jQuery("#message").val();

//     if(name==""){
//         alert('Please Enter Name');
//     }
//     else if(email==""){
//         alert('Please Enter Email');
//     }
//     else if(mobile==""){
//         alert('Please Enter Mobile');
//     }
//     else if(message==""){
//         alert('Please Enter Message');
//     }
//     else{
//         jQuery.ajax({
//             url:'send_message.php',
//             type:'post',
//             data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
//             success:function(result){
//                 alert(result);
//             }
//         })
//     }
// }


jQuery('#contactform').on('submit',function(e){
    jQuery.ajax({
        url:'send_message.php',
        type:'post',
        data:jQuery('#contactform').serialize(),
        success:function(result){
            alert(result);
        }
    })
});

let btnLogin = document.getElementById("login");
let btnSignUp = document.getElementById("signup");

let signIn = document.querySelector(".signin");
let signUp = document.querySelector(".signup");

btnLogin.onclick = function(){
    signIn.classList.add("active");
    signUp.classList.add("inActive");
}

btnSignUp.onclick = function(){
    signIn.classList.remove("active");
    signUp.classList.remove("inActive");
}

function user_register(){
    jQuery('.field_error').html('');
    var name=jQuery("#name").val();
    var email=jQuery("#email").val();
    var mobile=jQuery("#mobile").val();
    var password=jQuery("#password").val();
    var is_error='';
    
    if(name==""){
        jQuery('#name_error').html('Please Enter Name');
        is_error='yes';
    }if(email==""){
        jQuery('#email_error').html('Please Enter Email');
        is_error='yes';
    }if(mobile==""){
        jQuery('#mobile_error').html('Please Enter Mobile');
        is_error='yes';
    }if (mobile.length < 10 || mobile.length > 10) {
        jQuery('#mobile_error').html('Please enter 10 digit mobile number.');
        is_error='yes';
    }if (isNaN(mobile)) {
        jQuery('#mobile_error').html('Please enter valid mobile number.');
        is_error='yes';
    }if(password==""){
        jQuery('#password_error').html('Please Enter Password');
        is_error='yes';
    }
    if(is_error==''){
        jQuery.ajax({
            url:'register_submit.php',
            type:'post',
            data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
            success:function(result){
                if(result=='present'){
                    jQuery('.register_msg').html('Email Already Exists');
                }if(result=='insert'){
                    jQuery('.register_msg').html('Successfully Register');
                }
            }
        })
    }
}

function user_login(){
    jQuery('.field_error').html('');
    var email=jQuery("#login_email").val();
    var password=jQuery("#login_password").val();
    var is_error='';
    if(email==""){
        jQuery('#login_email_error').html('Please Enter Email');
        is_error='yes';
    }if(password==""){
        jQuery('#login_password_error').html('Please Enter Password');
        is_error='yes';
    }
    if(is_error==''){
        jQuery.ajax({
            url:'login_submit.php',
            type:'post',
            data:'email='+email+'&password='+password,
            success:function(result){
                if(result=='wrong'){
                    jQuery('.login_msg').html('Please Enter Vaild Login Details');
                }
                if(result=='valid'){
                    window.location.href='index.php';
                }
            }
        })
    }
}

function manage_cart(pid,type){
    if(type=='update'){
        var qty=jQuery("#"+pid+"qty").val();
    }else{
        var qty=jQuery("#qty").val();
    }
    jQuery.ajax({
        url:'manage_cart.php',
        type:'post',
        data:'pid='+pid+'&qty='+qty+'&type='+type,
        success:function(result){
            if(type=='update' || type=='remove'){
                window.location.href='cart.php';
            }
            else{
                window.location.href='';
            }
            jQuery('.htc_qua').html(result);
        }
    });
}