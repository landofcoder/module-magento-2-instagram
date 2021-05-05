/**
 * Landofcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.comlicense
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category   Landofcoder
 * @package    Lof_InstagramFeed
 * @copyright  Copyright (c) 2021 Landofcoder (https://landofcoder.com/)
 * @license    https://landofcoder.com/LICENSE-1.0.html
 */
define([
    "jquery",
    "Lof_InstagramFeed/js/lib/shuffle.min",
    "Lof_InstagramFeed/js/lib/imagesloaded.pkgd.min",
    "landofcoder/instagram/jquery/popup"
], function ($, Shuffle) {
    "use strict";
    $.widget("landofcoder.instagram", {
        options: {
            id: "",
            token: "",
            count: "",
            sort: "",
            image_resolution: "",
            layout: "",
            show_like_comment: 0,
            show_popup: 0
        },
        _create: function () {
            this._ajaxSubmit();
        },

        showPopup: function (id) {
            $(id).magnificPopup({
                delegate: ".lofinstagramfeed-photo a",
                type: "image",
                gallery: {enabled: true},
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: "lof-no-margins lof-with-zoom", // class to remove default margin from left and right side
                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true,
                    duration: 300 // don't forget to change the duration also in CSS
                }
            });
        },

        _ajaxSubmit: function () {
            var self = this,
                id = "#lofinstagramfeed-photos-" + this.options.id,
                captionHtml = this.options.show_caption === '1' ? '<div class="lofinstagramfeed-post-caption">{{caption}}</div>' : '',
                photo_Template = '<div class="lofinstagramfeed-photo">' +
                '<a class="lofinstagramfeed-post-url " href="{{link}}" target="_blank">' +
                    captionHtml +
                '<img class="lofinstagramfeed-image" src="{{imgSrc}}" alt="">' +
                '</a></div>';
            $.ajax({
                url: "https://graph.instagram.com/me/media",
                data: {
                    access_token: this.options.token,
                    fields: 'id, caption, media_type, media_url, permalink'
                },
                dataType: "json",
                type: "GET",
                success: function (data) {
                    var Image_url, item_Link,
                        items = data.data,
                        count = 0;
                    $.each(items, function (index, item) {
                        if (count >= parseInt(self.options.count)) {
                            return false;
                        }
                        if (item.media_type === 'VIDEO') {
                            return;
                        }

                        Image_url = item.media_url;
                        if (self.options.show_popup === "1") {
                            item_Link = Image_url;
                        } else {
                            item_Link = item.permalink;
                        }

                        var photo_Temp = photo_Template
                        .replace("{{link}}", item_Link)
                        .replace("{{caption}}", item.caption ? item.caption : '')
                        .replace("{{imgSrc}}", Image_url);

                        $(id).append(photo_Temp);
                        count++;
                    });
                },
                complete: function (data) {
                    // use shuffle after load images
                    if (self.options.layout === "optimized") {
                        self.demo(id);
                    }
                    if (self.options.show_popup === "1") {
                        self.showPopup(id);
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        },

        demo: function (id) {
            var element = document.querySelector(id);
            $(element).imagesLoaded().done(function (instance) {
                this.shuffle = new Shuffle(element, {
                    itemSelector: '.lofinstagramfeed-photo'
                });
            });
        }
    });

    return $.landofcoder.instagram;
});
