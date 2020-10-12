Rot13 = {
  map: null,
  init: function() {
    if (Rot13.map != null) {
        return;
    }

    var e = new Array;
    var t = "abcdefghijklmnopqrstuvwxyz";
    for (i = 0; i < t.length; i++) {
        e[t.charAt(i)] = t.charAt((i + 13) % 26);
    }
    for (i = 0; i < t.length; i++) {
        e[t.charAt(i).toUpperCase()] = t.charAt((i + 13) % 26).toUpperCase();
    };

    Rot13.map = e;
  },
  convert: function(e) {
    Rot13.init();

    var t = "";
    for (i = 0; i < e.length; i++) {
      var n = e.charAt(i);
      t += n >= "A" && n <= "Z" || n >= "a" && n <= "z" ? Rot13.map[n] : n;
    }

    return t;
  },
  write: function(e) {
    document.write(Rot13.convert(e));
  }
}
