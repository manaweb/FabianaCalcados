$(".back-topo").click(function(){
  $("html, body").animate({scrollTop: 0}, 200);
  return false;
});

function scrollToID(id, speed){
  var offSet = 50;
  var targetOffset = $(id).offset().top - offSet;
  // var mainNav = $('#main-nav');
   $('html,body').animate({scrollTop:targetOffset}, speed);
  // if (mainNav.hasClass("open")) {
  //   mainNav.css("height", "1px").removeClass("in").addClass("collapse");
  //   mainNav.removeClass("open");
  // }
}
if (typeof console === "undefined") {
    console = {
        log: function() { }
    };
}

$(".goTo").click(function(){
  scrollToID($(this).attr('href'),100);
  return false;
});