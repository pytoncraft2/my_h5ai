$(".arbre").hide();
$(document).ready(function() {
  if (location.pathname !== "/") {
    var url = location.pathname.split('/')[1];
    $("ul li:contains(" + url + ")>ul.el>li").css('display', 'flex');
  }

  var w = 0;
  var l = $(".liste-gauche");
  var param = Cookies.get('favoris');

  $("#ap").click(function() {
    window.history.forward();
  });

  $("#av").click(function(e) {
    e.preventDefault();
    window.history.back();
  });

  $('.bloc').mousedown(function(event) {
    if (event.which == 3) {
      if (Cookies.get('favoris') !== 'undefined') {
        var result = Cookies.get('favoris').replace(event.target.text, '');
        var final = result.replaceAll(",,", ",");
        Cookies.set('favoris', final);

        setTimeout(() => ($(this).remove()), 0);
      } else {
        Cookies.remove('favoris');
      }
    }

    if (event.which == 2) {
      l.css('visibility', 'visible');
      if (event.target.pathname.match(/.(jpg|jpeg|png|gif)$/i)) {
        l.css("background", "url(" + event.target.pathname + ") center /cover");
        l.html("Nom: " + event.target.pathname.split(/(\\|\/)/g).pop());
      } else {
        setTimeout(() => (l.load(event.target.pathname)), 1);
      }
      l.on('mouseleave', () => {
        l.css('visibility', 'hidden');
      });
    }
  });

  $(".fav").on('dragenter', function() {
    $(".bloc").on('dragend', function() {
      $(this).clone().end().clone().appendTo('.fav').end().find(".byte , .date, .dossier, .fichier").remove();
      nouveauParam = param + "," + this.pathname.substring(1);
      Cookies.set('favoris', nouveauParam);
    });
    $(this).css("border", "1px solid #fafafabd");
  });

  $(".fav").on('dragleave', function() {
    $(this).css("border", "1px solid #684d82bd");
  });

  $("button").click(function() {
    var cl = $(".arbre").css("width");
    w = cl == '0px' ? '28em' : '0px';
    $(".arbre").css("width", w);
  });

  $(".i").click(function(event) {
    $(this).closest("li").children().children().toggle();
    event.stopPropagation();
  });
});
