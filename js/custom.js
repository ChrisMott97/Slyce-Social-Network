$(document).ready(function(){
    $("h1").hide().fadeIn(3000);
    $("h2").hide().delay(1500).fadeIn(3000);
    $(".mastfoot").hide().delay(1500).fadeIn(3000);
    $(".allbtns").click(function(){
        $("#login").fadeIn(3000);
    });
});