$(() => {
  const urlParams = new URLSearchParams(window.location.search);

  const isMobile = $('#responsive-marker').css('zIndex') == '-1';

  if (!urlParams.has('error') && !urlParams.has('signed') && isMobile) {
    if ($('.data').length > 0)
      $('.data')[0].scrollIntoView({
        block: 'start',
        behavior: 'smooth',
        inline: 'nearest',
      });

    if ($('.columns-md').length > 0)
      $('.columns-md')[0].scrollIntoView({
        block: 'start',
        behavior: 'smooth',
        inline: 'nearest',
      });
  }

  if (urlParams.has('error')) {
    const error = urlParams.get('error');
    let errMsg = 'Veuillez nous excuser, une erreur est survenue';
    if (error == '1') {
    } else if (error == '2') {
      errMsg = 'Cet email est déja utilisé.';
    }
    alert(errMsg);
    urlParams.delete('error');
    const params = urlParams.toString();
    const str = params ? 'signataires.php?' + params : 'signataires.php';

    history.replaceState(null, '', str);
  }

  if (urlParams.has('signed')) {
    urlParams.delete('signed');

    $('.thanks')[0].scrollIntoView({
      behavior: 'auto',
      block: 'center',
      inline: 'center',
    });

    $('.thanks').addClass('visible');
    $('.form').addClass('readonly');

    const params = urlParams.toString();
    const str = params ? 'signataires.php?' + params : 'signataires.php';

    history.replaceState(null, '', str);
  }
  /**** NAV HANDLING ****/

  $('#filter_countries').on('change', function (val) {
    const v = val.currentTarget.value;
    nav('pays', v);
  });

  $('#sort-names').on('change', function (val) {
    const v = val.currentTarget.value;
    nav('tri', v);
  });

  const nav = (key, value) => {
    const urlParams = new URLSearchParams(window.location.search);

    if (value) urlParams.set(key, value);
    else {
      urlParams.delete(key);
    }

    window.location.search = urlParams;
  };

  /**** FORM ****/

  function limitMe(evt, txt) {
    if (evt.which && evt.which == 8) return true;
    else return txt.value.length < txt.getAttribute('max_length');
  }

  $('input').each((i, el) => {
    $(el)[0].setAttribute('onkeypress', 'return limitMe(event, this)');
  });

  $('.form input, .form select').on('change', (e) => {
    if (e.currentTarget.value && e.currentTarget.value != 'null') {
      $(e.currentTarget).addClass('filled');
    } else {
      $(e.currentTarget).removeClass('filled');
    }
  });

  /**** TOGGLES ****/
  $('.menu__bar-apropos').on('click', (e) => {
    $('.menu__text').toggleClass('visible');
    $('.form').toggleClass('hide');
    $('.menu__flags').toggleClass('hide');
  });

  $('.form__apropos__title').on('click', (e) => {
    $('.form__apropos').toggleClass('visible');
  });
});
