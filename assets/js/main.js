jQuery(document).ready(function($) {
  $('.navbar-toggler').on('click',function(e){
    e.preventDefault();
    $('#top-menu').stop().slideToggle(600);
  });
  $('li.fullscreen-toggler a').click(function(e) {
    e.preventDefault();
    //$('header .navbar-brand, .fullscreen-toggler').animate({'opacity':0},100);
    $('.fullscreen-toggler').animate({'opacity':0},100);
    $('.fullscreen-nav').fadeIn(200);
  });
  $('.fullscreen-nav a.close').click(function(e) {
    e.preventDefault();
    //$('header .navbar-brand, li.fullscreen-toggler').animate({'opacity':1},100);
    $('li.fullscreen-toggler').animate({'opacity':1},100);
    $('.fullscreen-nav').fadeOut(200);
  });
  
  $('#go-to-top').click(function(e)
  {
    e.preventDefault();
    $('html,body').stop().animate({scrollTop:0}, 500);
    return false;
  });
  $('.smooth-scroll').click(function(e)
  {
    e.preventDefault();
    var $href=$(this).attr('href');
    $('html,body').stop().animate({scrollTop:$($href).offset().top}, 500);
    return false;
  });

  $('.accordion-item .accordion-item-title').click(function(e) {
    e.preventDefault();
    var $this=$(this);
    var $parent=$this.parent();

    if( !$parent.hasClass('accordion-active') ){
      $('.accordion-item').removeClass('accordion-active');
      $('.accordion-item .accordion-item-content').stop().slideUp(200);

      $parent.addClass('accordion-active');
      $this.next('.accordion-item-content').stop().slideDown(200);
    }
    else{
      $parent.removeClass('accordion-active');
      $this.next('.accordion-item-content').stop().slideUp(200);
    }
  });
  if($('.accordion-item').length!==0)$('.accordion-item').eq(0).find('.accordion-item-title').trigger('click');

  $('.masonry').masonry({
      itemSelector: '.vc-eletrico_mosaic-item',
      columnWidth: '.vc-eletrico_mosaic-item--2',
      percentPosition: true
  });
  $('.carousel').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    centerMode: false,
    variableWidth: false,
    autoplay: false,
    arrows: true,
    dots: true,
    prevArrow: '<div class="arrow-wrapper arrow-wrapper--left"><i class="fa fa-angle-left"></i></div>',
    nextArrow: '<div class="arrow-wrapper arrow-wrapper--right"><i class="fa fa-angle-right"></i></div>',
    customPaging: function(slider, i) {
      return '<div class="dot"></div>';
    },
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          dots: true
        }
      }
    ]
  });
  $('.slick-small').slick({
    dots: false,
    arrows: true,
    prevArrow:
      '<div class="arrow-wrapper--small arrow-wrapper--left"><i class="fa fa-angle-left"></i></div>',
    nextArrow:
      '<div class="arrow-wrapper--small arrow-wrapper--right"><i class="fa fa-angle-right"></i></div>',
    customPaging: function(slider, i) {
      return '<div class="dot-small"></div>';
    },
    infinite: true,
    speed: 300,
    slidesToShow: 6,
    slidesToScroll: 6,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
});
