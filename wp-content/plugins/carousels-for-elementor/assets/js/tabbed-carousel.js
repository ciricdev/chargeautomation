jQuery( document ).ready(function( $ ) {
    $('.tabbed-carousel-slide').slick({
        centerMode:false,     
        draggable:false,    
        arrows:true,         
        slidesToShow:1,     
        slidesToScroll:1,   
        dots:false,
    });

    $('.carousel-tab-nav-button').click(function(e){
        e.preventDefault();
        var index = $(this).data('slide-index');
        $('.tabbed-carousel-slide').slick('slickGoTo', index);
    });

    $('.tabbed-carousel-section').removeClass('hide');

    $('.carousel-tab-nav-button').click(function(e){
        e.preventDefault();
        $('.carousel-tab-nav-button').removeClass('active-slide-button');
        $(this).addClass('active-slide-button');
    });

    $('.tabbed-carousel-slide').on('beforeChange', function(event, slick, currentSlide, nextSlide){
        $('.carousel-tab-nav-button').removeClass('active-slide-button');
        $('#tab-button-' + nextSlide).addClass('active-slide-button');
        //document.getElementById('tab-button-' + nextSlide).scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    });
});