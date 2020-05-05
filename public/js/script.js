$(window).scroll(function() {
    let scroll = $(window).scrollTop();
    if (scroll > 0) {
        $('.site-header').css('background-color', '#fff');
        $('.site-header').addClass('scroll')
    }else{
        $('.site-header').css('background-color', '#101215b8');
        $('.site-header').removeClass('scroll')
    }

});
let scroll = $(window).scrollTop();
if (scroll > 0) {
    $('.site-header').css('background-color', '#fff');
    $('.site-header').addClass('scroll')
}else{
    $('.site-header').css('background-color', '#101215b8');
    $('.site-header').removeClass('scroll')
}


$(document).ready(function() {
    //responsive menu toggle
    $("#menutoggle").click(function() {
        $('.xs-menu').toggleClass('displaynone');

    });
    //add active class on menu
    $('ul li').click(function(e) {
        e.preventDefault();
        $('li').removeClass('active');
        $(this).addClass('active');
    });
    //drop down menu
    $(".drop-down").hover(function() {
        $('.mega-menu').addClass('display-on');
    });
    $(".drop-down").mouseleave(function() {
        $('.mega-menu').removeClass('display-on');
    });

    $(".drop-down-2").hover(function() {
        $('.mega-menu-2').addClass('display-on');
    });
    $(".drop-down-2").mouseleave(function() {
        $('.mega-menu-2').removeClass('display-on');
    });
});


window.addEventListener('load', function() {
    setTimeout(lazyLoad, 1000);
});


function lazyLoad() {
    var card_images = document.querySelectorAll('.card-image');

    // loop over each card image
    card_images.forEach(function(card_image) {
        var image_url = card_image.getAttribute('data-image-full');
        var content_image = card_image.querySelector('img');

        // change the src of the content image to load the new high res photo
        content_image.src = image_url;

        // listen for load event when the new photo is finished loading
        content_image.addEventListener('load', function() {
            // swap out the visible background image with the new fully downloaded photo
            card_image.style.backgroundImage = 'url(' + image_url + ')';
            // add a class to remove the blur filter to smoothly transition the image change
            card_image.className = card_image.className + ' is-loaded';
        });
    });
}

$(document).ready(function() {
    jQuery.fn.carousel.Constructor.TRANSITION_DURATION = 2000  // 2 seconds
});

$(document).ready(function(){
    var zindex = 10;
    $(".content-wrapper div.card").click(function(e){
        e.preventDefault();
        var isShowing = false;
        if ($(this).hasClass("show")) {
            isShowing = true
        }
        if ($("div.cards").hasClass("showing")) {
            $("div.card.show")
                .removeClass("show");
            if (isShowing) {
                $("div.cards")
                    .removeClass("showing");
            } else {
                $(this)
                    .css({zIndex: zindex})
                    .addClass("show");
            }
            zindex++;
        } else {
            $("div.cards")
                .addClass("showing");
            $(this)
                .css({zIndex:zindex})
                .addClass("show");
            zindex++;
        }
    });
});

$(document).ready( function() {
    $categories = $('.category-click-service');
    $categories.click(function(e) {
        let name_super = $(this).attr('data-name');
        let id = $(this).attr('id');
        window.location.href = "/services?"+ name_super +'/' + id;
    });

    $cards = $('.content-wrapper .card-service');
    $reset_button = $('.btn-all-services');
    $reset_button.click(function(e){
        e.preventDefault();
        $cards.show();
    });

    $supercategories = $('.card-supercategory');
    $supercategories.click(function(e){
       let id = $(this).attr('data-category');
       var name_super = $(this).attr('data-name');
       window.location.href = "/services?"+ name_super +'/' + id;
    });

    if(window.location.href.split('?').pop() !== '' && window.location.href.indexOf("?") > -1) {
        let index = window.location.href.split('/').pop();
        $cards.hide();
        $('.card[data-category="' + index + '"]').show();
    }

    $('.btn-all-services').click(function(){
        window.location.href = "/services";
    });
    $('.home-link').click(function(){
        window.location.href = "/";
    });
    $('.products-link').click(function(){
        window.location.href = "/produse";
    });
    $('.services-link').click(function(){
        window.location.href = "/services";
    });


    $cards_products = $('.content-wrapper .card-product');
    $supercat_products = $('.category-click-prod');
    $supercat_products.click(function(){
       let subcategories = [];
       let $next_cat = $(this).parent().next('div');
       var $subcat  = $next_cat.find('button');
       $subcat.each(function(){
          subcategories.push($(this).attr('data-target'));
       });
        // let name_super = $(this).attr('data-name');
        // let id = $(this).attr('id');
        // window.location.href = "/produse?"+ name_super +'/' + id;
        $cards_products.hide();
        subcategories.forEach(function(i){
            $('.card-product[data-category="' + i + '"]').show();
        });
        console.log(subcategories);
    });

    $('.btn-all-products').click(function() {
        window.location.href = "/produse";
    });
    $('.btn-products').click(function() {
        window.location.href = "/produse";
    });

    var $subcat = $('.subcat');
    $subcat.click(function(){
        var subcat_cat = [];
        subcat_cat.push($(this).attr('data-target'));

        var $nexts = $(this).next('ul').find('button');
        console.log($nexts.attr('id'));
        $nexts.each(function () {
            subcat_cat.push($(this).attr('data-target'))
        });
        $cards_products.hide();
        subcat_cat.forEach(function(i){
            $('.card-product[data-category="' + i + '"]').show();
        });
    });

    var $subcat2 = $('.subcat2');
    $subcat2.click(function(){
        var subcat_cat2 = [];
        subcat_cat2.push($(this).attr('data-target'));
        $cards_products.hide();
        subcat_cat2.forEach(function(i){
            $('.card-product[data-category="' + i + '"]').show();
        });
    });

    $('.portofolio-link').click(function(e){
        // e.preventDefault();
        // $(".sec-portofolio").animate({scrollTop: $(document).height() + $(window).height()});
        // return false;
        window.location.href = "/#portofoliu";
    });
});

// Portofoliu
$(function() {
    $(".img-w").each(function() {
        $(this).wrap("<div class='img-c'></div>");
        let imgSrc = $(this).find("img").attr("src");
        $(this).css('background-image', 'url(' + imgSrc + ')');
    });
    $img_portofolio = $('.img-w .img-c');
    $img_portofolio.hover(function(){
        $(this).css('-webkit-filter: brightness(0.2);filter: brightness(0.3);');
    });
});
