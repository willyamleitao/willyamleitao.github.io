
$(document).ready(function() {

    $("a.botao_responsivo").click(function() {
        $(".menu-off-canvas").toggleClass('ativo');
        $("a.botao_responsivo").toggleClass('ativo');
        $(".overlay").toggleClass('ativo');
        $(".wrap_page").toggleClass('ativo');
    });

    $("a.fechar").click(function() {
        $(".menu-off-canvas").toggleClass('ativo');
        $("a.botao_responsivo").toggleClass('ativo');
        $(".overlay").toggleClass('ativo');
        $(".wrap_page").toggleClass('ativo');
    });
    $("a.menu-off").click(function() {
        $(".menu-off-canvas").toggleClass('ativo');
        $("a.botao_responsivo").toggleClass('ativo');
        $(".overlay").toggleClass('ativo');
        $(".wrap_page").toggleClass('ativo');
    });
    $(".overlay").click(function() {
        $(".menu-off-canvas").removeClass('ativo');
        $("a.botao_responsivo").removeClass('ativo');
        $(".overlay").removeClass('ativo');
        $(".wrap_page").removeClass('ativo');
    });

    $("a.compartilhe").click(function() {
        $('.redes-sociais').toggleClass('ativo');
    });


});
$(document).ready(function() {
    $('a').click(function(){
        if($.attr(this, 'href') != "#"){
            $('html, body').animate({
                scrollTop: eval($( $.attr(this, 'href') ).offset().top - 77)
            }, 500);
        }
        return false;
    });
});
$(document).ready(function() {
    $(".owl-carousel").owlCarousel({
        autoplay: true, //Set AutoPlay to 3 seconds     
            pagination: true,
        nav: true,
        items: 1,  
    });
});


$(document).ready(function() {

    var owl = $('.owl-carousel');
    owl.owlCarousel();
    // Go to the next item
    $('.next').click(function() {
        owl.trigger('next.owl.carousel');
    })
        // Go to the previous item
        $('.prev').click(function() {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        owl.trigger('prev.owl.carousel');
    })

    });
