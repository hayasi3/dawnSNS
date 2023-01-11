$(function () {
    $('#icon').click(function () { //ハンバーガーボタン(.menu-trigger)をクリック
    $(this).toggleClass('active'); //ハンバーガーボタンに(.active)を追加・削除
    if ($(this).hasClass('active')) { //もしハンバーガーボタンに(.active)があれば
        $('.g-navi').addClass('active'); //(.g-navi)にも(.active)を追加
    } else { //それ以外の場合は、
        $('.g-navi').removeClass('active'); //(.g-navi)にある(.active)を削除
    }
    });
    $('.nav-wrapper ul li a').click(function () { //各メニュー(.nav-wrapper ul li a)をタップする
    $('.menu-trigger').removeClass('active'); //ハンバーガーボタンにある(.active)を削除
    $('.g-navi').removeClass('active'); //(.g-navi)にある(.active)も削除
    });
});

//モーダル動作
$(function () { //①
    $('.modalopen').each(function () {
      $(this).on('click', function () {
        var target = $(this).data('target');
        var modal = document.getElementById(target);
        console.log(modal);
        $(modal).fadeIn();
        return false;
      });
    });
    $('.modalClose').on('click', function () {
      $('.js-modal').fadeOut();
      return false;
    });
  });