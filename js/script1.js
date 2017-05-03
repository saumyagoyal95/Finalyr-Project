$(function() {
    $('#rank-div1').stop(true, true).fadeIn({ duration: 2000, queue: false }).css('display', 'none').slideDown(1000);  
}, function() {
    $('#rank-div1').stop(true, true).fadeOut({ duration: 2000, queue: false }).slideUp(1000);
});
