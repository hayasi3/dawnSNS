$(function () {
    $('.g-navi').css("display", "none");
    $('#username').on('click', function () {
      $(this).next().slideToggle();
    })
  });

$(function () {
    $('#username').on('click', function () {
        $('.arrow').toggleClass('active');
    })
});

//モーダル動作
$(function () { //①
    $('.modalopen').each(function () {
      $(this).on('click', function () {
        var target = $(this).data('target');
        var modal = document.getElementById(target);
        // console.log(modal);
        $(modal).fadeIn();
        // return false;
      });
    });
    $('.modal-inner').on('click', function () {
        var target = $('.modalopen').data('target');
        var modal = document.getElementById(target);
        console.log(modal);
      $(modal).fadeOut();
      //return false;
    });
     // がしかし、画像をクリックでキャンセルさせる
  $( '.modal-white' ).on( 'click', function( e ){
    e.stopPropagation();
  } );
  });