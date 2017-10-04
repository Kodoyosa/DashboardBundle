$('.dropdown-list').hide();
$(document).ready(function(){
    $('.dropdown-toggle').click(function(){
        $(this).next().slideToggle();
    });
});