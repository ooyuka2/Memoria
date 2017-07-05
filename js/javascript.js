$(document).ready(function(){
  //textareaフォーカス時に文字数の高さ見てリサイズ
  $('textarea').keyup(function(e) {
    //文字数から高さ取得
    var height=this.scrollHeight + 'px';
    $(this).css("height", height);
    })
    .blur(function(e) {
    //$(this).css("height", "auto");
  });
});