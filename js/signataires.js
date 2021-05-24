$(() => {
  $('#filter_countries').on('change', function (val) {
    const s = document.location.search;
    const v = val.currentTarget.value;
    nav('pays', v);
  });

  $('#sort-names').on('change', function (val) {
    const s = document.location.search;
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
});
