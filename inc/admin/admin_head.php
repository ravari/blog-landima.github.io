<?php if (is_admin()):?>
<link rel="stylesheet" href="<?=THEME_DIR?>/css/bootstrap-rtl.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/fontiran.css">
<?php endif?>
<style type="text/css">
    html {
        font-size: 13px !important;
    }

    body.rtl,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    #wpadminbar a,
    #wpcontent #wp-toolbar .menupop a,
    #wpcontent #wp-toolbar .menupop a .ab-label,
    #wpcontent #wp-toolbar .menupop a .display-name {
        font-family: 'IRANSans', sans-serif !important;
    }

    #titlediv #title-prompt-text {
        font-size: 1.1em !important;
        padding: 8px 10px !important;
    }

    #titlediv #title {
        font-size: 1.3em !important;
        height: 1.9em !important;
    }

    .cap {
        line-height: 30px;
    }

    td.media-icon img[src$=".svg"],
    img[src$=".svg"].attachment-post-thumbnail {
        width: 100% !important;
        height: auto !important;
    }

    @media screen and (max-width: 782px) {
        #wpadminbar #wp-admin-bar-my-account.with-avatar>.ab-empty-item img {
            position: absolute;
            left: -1px;
            height: 48px;
        }
    }

    input,
    select,
    textarea,
    option {
        font-size: 12px !important;
    }

    .team-filter {
        min-width: 100px;
    }

    .powered {
        float: right;
        font-size: 10px;
    }

    #wpfooter {
        background: rgba(0, 0, 0, .02);
    }

    #wpfooter p#footer-upgrade {
        font-size: 10px;
        line-height: 30px;
    }

    #adminmenu .wp-menu-image img {
        padding: 5px 0 0 !important;
        opacity: .6;
        filter: alpha(opacity=60);
        width: 20px !important;
    }

    .landibel {
        cursor: pointer;
    }

    .landibel:hover img {
        transform: scale(.9)
    }

    .landibel.free {
        filter: grayscale(100%);
        -webkit-filter: grayscale(100%);
    }

    .landibel.taked {
        overflow: hidden;
        position: relative;
    }

    .landibel.taked::before {
        content: attr(data-displayName);
        position: absolute;
        margin: auto;
        left: 0;
        right: 0;
        display: inline-block;
        text-align: center;
        bottom: -50px;
        transition: all 320ms;
        color: #fff;
        z-index: 200;
    }

    .landibel.taked:hover::before {
        bottom: 20px;
        transition: all 320ms;
    }

    .modal-header .close {
        padding: 1rem;
        margin: -1rem auto -1rem -1rem;
    }

    .modal-footer> :not(:last-child) {
        margin-left: .25rem;
    }

    .chip {
        background: #f0f0f0;
        padding: 4px 10px 2px;
        border-radius: 3px;
        margin: 0;
        line-height: 36px;
    }
</style>