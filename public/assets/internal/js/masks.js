var MASK = {
  Masks: function () {
    $(".data").mask("00/00/0000");
    $(".rg").mask("00.000.000-0");
    $(".cpf").mask("000.000.000-00");
    $(".numeros").mask("#000000", { reverse: true, maxlength: false });
  },
};