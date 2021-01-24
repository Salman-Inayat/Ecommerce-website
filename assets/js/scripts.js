(function ($) {
  "use strict";

  $(document).ready(function () {
    var dragging = true;
    var owlElementID = "#owl-main";

    $(owlElementID).owlCarousel({
      autoPlay: 5000,
      stopOnHover: true,
      navigation: true,
      pagination: true,
      singleItem: true,
      addClassActive: true,
      transitionStyle: "fade",
      navigationText: [
        "<i class='icon fa fa-angle-left'></i>",
        "<i class='icon fa fa-angle-right'></i>",
      ],
    });

    if ($(owlElementID).hasClass("owl-one-item")) {
      $(owlElementID + ".owl-one-item")
        .data("owlCarousel")
        .destroy();
    }

    $(owlElementID + ".owl-one-item").owlCarousel({
      singleItem: true,
      navigation: false,
      pagination: false,
    });

    $("#transitionType li a").click(function () {
      $("#transitionType li a").removeClass("active");
      $(this).addClass("active");
      var newValue = $(this).attr("data-transition-type");

      $(owlElementID).data("owlCarousel").transitionTypes(newValue);
      $(owlElementID).trigger("owl.next");

      return false;
    });

    $(".home-owl-carousel").each(function () {
      var owl = $(this);
      var itemPerLine = owl.data("item");
      if (!itemPerLine) {
        itemPerLine = 4;
      }
      owl.owlCarousel({
        items: itemPerLine,
        itemsTablet: [768, 2],
        navigation: true,
        pagination: false,
        navigationText: ["", ""],
      });
    });

    $(".homepage-owl-carousel").each(function () {
      var owl = $(this);
      var itemPerLine = owl.data("item");
      if (!itemPerLine) {
        itemPerLine = 4;
      }
      owl.owlCarousel({
        items: itemPerLine,
        itemsTablet: [768, 2],
        itemsDesktop: [1199, 2],
        navigation: true,
        pagination: false,

        navigationText: ["", ""],
      });
    });

    

    $(".best-seller").owlCarousel({
      items: 3,
      navigation: true,
      itemsDesktopSmall: [979, 2],
      itemsDesktop: [1199, 2],
      slideSpeed: 300,
      pagination: false,
      paginationSpeed: 400,
      navigationText: ["", ""],
    });

    $(".sidebar-carousel").owlCarousel({
      items: 1,
      itemsTablet: [768, 2],
      itemsDesktopSmall: [979, 2],
      itemsDesktop: [1199, 1],
      navigation: true,
      slideSpeed: 300,
      pagination: false,
      paginationSpeed: 400,
      navigationText: ["", ""],
    });

    $(".owl-prev", $owl_controls_custom).click(function (event) {
      var selector = $(this).data("owl-selector");
      var owl = $(selector).data("owlCarousel");
      owl.prev();
      return false;
    });

    $(".owl-next").click(function () {
      $($(this).data("target")).trigger("owl.next");
      return false;
    });

    $(".owl-prev").click(function () {
      $($(this).data("target")).trigger("owl.prev");
      return false;
    });
  });

  $(document).ready(function () {
    $("#owl-single-product").owlCarousel({
      items: 1,
      itemsTablet: [768, 2],
      itemsDesktop: [1199, 1],
    });

    $(".single-product-gallery .horizontal-thumb").click(function () {
      var $this = $(this),
        owl = $($this.data("target")),
        slideTo = $this.data("slide");
      owl.trigger("owl.goTo", slideTo);
      $this
        .addClass("active")
        .parent()
        .siblings()
        .find(".active")
        .removeClass("active");
      return false;
    });
  });
})(jQuery);
