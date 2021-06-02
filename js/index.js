$(() => {
  const urlParams = new URLSearchParams(window.location.search);

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
  $('.menu__bar1 .menu__bar__title').on('click', (e) => {
    $('.menu__text').toggleClass('visible');
    $('.form').toggleClass('hide');
    $('.menu__flags').toggleClass('hide');
  });

  $('.form__apropos__title').on('click', (e) => {
    $('.form__apropos').toggleClass('visible');
  });

  /**** FILL ****/
  $('#fill').on('click', (e) => {
    $("input[name='lastName']").val('Djordjevic');
    $("input[name='firstName']").val('Daniel');
    $("input[name='email']").val(makeEmail());
    $("select[name='country'] option:nth(76)").prop('selected', true);
  });

  function makeEmail() {
    return 'daniel.djordjevic@outlook.fr';
    var strValues = 'abcdefg12345';
    var strEmail = '';
    var strTmp;
    for (var i = 0; i < 3; i++) {
      strTmp = strValues.charAt(Math.round(strValues.length * Math.random()));
      strEmail = strEmail + strTmp;
    }
    strTmp = '';
    strEmail = strEmail + '@';
    for (var j = 0; j < 2; j++) {
      strTmp = strValues.charAt(Math.round(strValues.length * Math.random()));
      strEmail = strEmail + strTmp;
    }
    strEmail = strEmail + '.com';
    return strEmail;
  }
});
