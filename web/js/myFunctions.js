var api;

function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

$(document).ready(function(){
    VK.init({apiId: 5884271, onlyWidgets: true});
    VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
    api = $("#gallery").unitegallery();
});

$(".pricesearch").click(function() {
    var price =  $("#slider-result" ).html();
    location.href = "http://gameshop.kl.com.ua/advancedsearch.html?game=&publisher=&genre=&platform=&price_from=&price_to=" + price +"&order=";
});

$(function() {
    $(".rslides").responsiveSlides({
        speed: 500,
        timeout: 5000,
        pause: true,
        random: true
    });
});

var validateAlgoritm = {
   email: {
      rule: function (email) {
      
        return /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(email);
     }
   }  
},
$email = $('#buy-email');

function validateForm2() {
    var result = {
       status: true,
    };

   if(!validateAlgoritm.email.rule($email.val()) || !$('#buy-accept').is(':checked')) {
     result.status = false;
   }
   
   return result;
};

function submitForm() {
    var valid = validateForm2();
    if(valid.status) {
      document.payment.submit();
    }
     
}