$(() => {
  const urlParams = new URLSearchParams(window.location.search);

  if (urlParams.has('signed')) {
    urlParams.delete('signed');

    $('.thanks')[0].scrollIntoView({
      behavior: 'auto',
      block: 'center',
      inline: 'center',
    });

    $('.thanks').addClass('visible');

    $('#sign-form').addClass('readonly');

    const params = urlParams.toString();
    const str = params ? 'index.php?' + params : 'index.php';

    history.pushState(null, '', str);

    $('#destination').val(str);
  }

  $('.form input, .form select').on('change', (e) => {
    if (e.currentTarget.value && e.currentTarget.value != 'null') {
      $(e.currentTarget).addClass('filled');
    } else {
      $(e.currentTarget).removeClass('filled');
    }
  });

  $('.menu__bar__title').on('click', (e) => {
    $('.menu__text').toggleClass('visible');
    $('.chevron1').toggleClass('turn');
  });

  $('.form__apropos__title').on('click', (e) => {
    $('.form__apropos').toggleClass('visible');
    $('.chevron2').toggleClass('turn');
  });

  $('#fill').on('click', (e) => {
    $("input[name='lastName']").val('Djordjevic');
    $("input[name='firstName']").val('Daniel');
    $("input[name='email']").val(makeEmail());
    $("select[name='country'] option:nth(76)").prop('selected', true);
  });

  function makeEmail() {
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
