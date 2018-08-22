;(function() {
  tinymce.create("tinymce.plugins.latest_post", {
    init: function(ed, url) {
      ed.addButton("latest_post", {
        title: "افزودن بلاک آخرین مطلب",
        cmd: "latest_post_command",
        image: "https://png.icons8.com/ios/24/000000/web.png"
      })
      ed.addButton("reg_form", {
        title: "افزودن فرم ثبت نام",
        cmd: "reg_form_command",
        image: "https://png.icons8.com/windows/24/000000/add-user-male.png"
      })

      ed.addCommand("latest_post_command", function() {
        ed.windowManager.open({
          title: "افزودن بلاک آخرین مطلب",
          url: ajaxurl + "?action=shortcode_latest_post_form",
          width: 500,
          height: "auto"
        })
      })

      ed.addCommand("reg_form_command", function() {
        ed.execCommand("mceInsertContent", false, "[register_form]")
      })
    },

    createControl: function(n, cm) {
      return null
    },

    getInfo: function() {
      return {
        longname: "Landima Theme",
        author: "Mohsen Akbari",
        version: "1"
      }
    }
  })

  tinymce.PluginManager.add("latest_post", tinymce.plugins.latest_post)
})()
