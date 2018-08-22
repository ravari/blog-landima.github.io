jQuery(document).ready(function($) {
  for (var key in pc) {
    if (pc.hasOwnProperty(key)) {
      $("#reg_province").append(
        $("<option>")
          .val(key)
          .text(key)
      );
    }
  }
  $("#reg_province").on("change", function() {
    var key = $(this).val();
    $("#reg_city")
      .html("")
      .val("");
    for (var city in pc[key]) {
      if (pc[key].hasOwnProperty(city)) {
        $("#reg_city").append(
          $("<option>")
            .val(pc[key][city])
            .text(pc[key][city])
        );
      }
    }
  });
  $(".repeater").each(function() {
    var repeat = $(".repeat", this),
      add = $("<div>")
        .addClass("px-1 add")
        .html(
          $("<span>")
            .addClass("btn btn-block btn-outline-success")
            .html('<i class="fa fa-plus" aria-hidden="true"></i>')
        ),
      del = $("<div>")
        .addClass("px-1 del d-none")
        .html(
          $("<span>")
            .addClass("btn btn-block btn-outline-danger")
            .html('<i class="fa fa-minus" aria-hidden="true"></i>')
        );

    repeat.addClass("col");
    $(this)
      .addClass("w-100 row pr-3")
      .append(add, del);
  });
  function checkButtons(rep) {
    var items = $(".repeat", rep),
      max = parseInt(rep.data("max"));
    if (items.length > 1 && items.length < max) {
      $(".del", rep).removeClass("d-none");
      $(".add", rep).removeClass("d-none");
    } else {
      if (items.length >= max) $(".add", rep).addClass("d-none");
      else $(".del", rep).addClass("d-none");
    }
  }
  $(".repeater .add").on("click", function() {
    var repeater = $(this)
        .parents(".repeater")
        .eq(0),
      repeat = $(".repeat", repeater).eq(0),
      repeat_clone = repeat.clone();
    repeat_clone.removeClass("col").addClass("col-12 pl-0");
    $("input", repeat_clone).val("");
    repeater.append(repeat_clone);
    checkButtons(repeater);
  });
  $(".repeater .del").on("click", function() {
    var repeater = $(this)
        .parents(".repeater")
        .eq(0),
      repeat = $(".repeat:last-child", repeater).eq(0);
    repeat.remove();
    checkButtons(repeater);
  });
  $(function() {
    $(".cond-choises input[type=radio]:checked").trigger("change");
  });
  $(".cond-choises input[type=radio]").on("change", function() {
    var conds = $(".cond"),
      choise = $(this).val();
    conds.hide().each(function() {
      var choises = $(this)
        .data("cond")
        .split(",");
      if ($.inArray(choise, choises) >= 0) {
        if ($(this).hasClass("repeater")) $(this).css({ display: "flex" });
        else $(this).css({ display: "block" });
      }
    });
  });
  $("#idcard").on("change", function() {
    var idcard = $(this)
      .val()
      .split("\\");
    if (idcard.length > 0 && idcard[0] !== "") {
      $('label[for="idcard"]').html(
        '<div>فایل کارت ملی: <span dir="ltr">' +
          idcard[idcard.length - 1] +
          "</span></div>"
      );
      $(this).validate();
    } else {
      $('label[for="idcard"]').html("بارگزاری اسکن کارت ملی");
      $(this).validate();
    }
  });
  $("#logo_file").on("change", function() {
    var logo = $(this)
      .val()
      .split("\\");
    if (logo.length > 0 && logo[0] !== "") {
      $('label[for="logo_file"]').html(
        '<div>فایل لوگوی طرح: <span dir="ltr">' +
          logo[logo.length - 1] +
          "</span></div>"
      );
      $(this).validate();
    } else {
      $('label[for="logo_file"]').html("بارگزاری لوگوی طرح");
      $(this).validate();
    }
  });

  jQuery.formUtils.addValidator({
    name: "code_meli",
    validatorFunction: function(value, $el, config, language, $form) {
      var L = value.length;
      if (/^(.)\1+$/.test(value)) return false;
      if (L < 8 || parseInt(value, 10) == 0) return false;
      value = ("0000" + value).substr(L + 4 - 10);
      if (parseInt(value.substr(3, 6), 10) == 0) return false;
      var c = parseInt(value.substr(9, 1), 10);
      var s = 0;
      for (var i = 0; i < 9; i++)
        s += parseInt(value.substr(i, 1), 10) * (10 - i);
      s = s % 11;
      return (s < 2 && c == s) || (s >= 2 && c == 11 - s);
      return true;
    },
    errorMessage: "کدملی معتبر نمی باشد",
    errorMessageKey: "InvalidCodeMeli"
  });
  jQuery.formUtils.addValidator({
    name: "mobile_num",
    validatorFunction: function(value, $el, config, language, $form) {
      if (!/09\d{9}/.test(value)) return false;
      return true;
    },
    errorMessage: "شماره همراه معتبر نمی باشد",
    errorMessageKey: "InvalidMobileNum"
  });
  jQuery.validate({
    form: "#registration-form",
    modules: "security, file",
    lang: "fa"
  });
});
function sendform(e) {
  var $form = jQuery("#registration-form");
  if ($form.isValid({}, {}, true)) {
    var fd = new FormData($form[0]);
    fd.append("action", "register_user");
    jQuery.post({
      url: global.ajax_url,
      processData: false,
      contentType: false,
      data: fd,
      success: function(xhr, status) {
        window.location.href = global.login_url;
      },
      error: function(xhr, status) {
        $form.find('[type="submit"]').show();
        jQuery("#message")
          .text(xhr.message)
          .addClass("alert-danger show");
      },
      beforeSend: function() {
        $form.find('[type="submit"]').hide();
      }
    });
  }
  return false;
}
