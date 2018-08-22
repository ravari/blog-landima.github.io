moment.loadPersian({
  dialect: "persian-modern"
})
jQuery(document).ready(function($) {
  $("#userModal")
    .on("show.bs.modal", function(event) {
      if (event.relatedTarget) {
        var landibel = $(event.relatedTarget),
          modal = $(this),
          uid = landibel.data("uid") || false
        id = landibel.data("id")
        $(".modal-title", modal).text(
          uid ? "کاربر" : "#" + id + "تحویل به کاربر"
        )
        if (!uid) {
          $.post({
            url: global.ajax_url,
            data: {
              action: "assign_user_form"
            },
            success: function(data) {
              if (data.message) {
                $(".modal-body", modal).html(
                  $("<div>")
                    .addClass("text-center text-muted")
                    .text(data.message)
                )
              } else {
                var data = $(data)
                data
                  .find("#range")
                  .eq(0)
                  .daterangepicker({
                    autoApply: true,
                    locale: {
                      direction: "rtl",
                      format: "jYYYY/jMM/jDD",
                      separator: " تا ",
                      firstDay: 6
                    }
                  })
                $(".modal-body", modal).html(data)
                var btn = $("<button>")
                  .addClass("btn btn-primary")
                  .text("ثبت")
                  .on("click", function() {
                    var me = $(this),
                      uid = $("#user", data).val(),
                      range = $("#range", data).val()
                    if (uid === "") alert("لطفاً یک کاربر را انتخاب نمایید")
                    else {
                      $.post({
                        url: global.ajax_url,
                        data: {
                          action: "assign_user",
                          uid: uid,
                          id: id,
                          range: range
                        },
                        success: function() {
                          window.location.reload()
                        },
                        error: function(xhr) {
                          alert(xhr.statusText + ":" + xhr.responseText)
                          me.prop("disabled", false)
                        },
                        beforeSend: function() {
                          me.prop("disabled", true)
                        }
                      })
                    }
                  })
                $(".modal-footer", modal).prepend(btn)
              }
            },
            error: function(xhr) {
              console.error(xhr.message)
            },
            beforeSend: function() {
              $(".modal-body", modal).html(
                '<div class="loading text-center">درحال بارگزاری</div>'
              )
            }
          })
        } else {
          $.post({
            url: global.ajax_url,
            data: {
              action: "get_user_info",
              uid: uid
            },
            success: function(data) {
              $(".modal-body", modal).html(data)
              var btn = $("<button>")
                .addClass("btn btn-warning")
                .text("جدا کردن")
                .on("click", function() {
                  var me = $(this),
                    uid = $("#uid", data).val(),
                    range = $("#range", data).val()
                  if (
                    confirm("سیستم این کاربر را از این جایگاه جدا خواهد کرد")
                  ) {
                    $.post({
                      url: global.ajax_url,
                      data: {
                        action: "dettach_user",
                        uid: uid,
                        id: id
                      },
                      success: function() {
                        window.location.reload()
                      },
                      error: function(xhr) {
                        alert(xhr.statusText + ":" + xhr.responseText)
                        me.prop("disabled", false)
                      },
                      beforeSend: function() {
                        me.prop("disabled", true)
                      }
                    })
                  }
                })
              $(".modal-footer", modal).prepend(btn)
            },
            error: function(xhr) {
              console.error(xhr.message)
            },
            beforeSend: function() {
              $(".modal-body", modal).html(
                '<div class="loading text-center">درحال بارگزاری</div>'
              )
            }
          })
        }
      }
    })
    .on("hide.bs.modal", function() {
      $('button:not([data-dismiss="modal"])').remove()
    })
})
