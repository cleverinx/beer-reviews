(function ($) {
  'use strict';

  /**
   * Prints Hello world! to the console
   */
  var helloWorld = function () {
    // console.log('Hello world!');
  };

  $(document).ready(function () {

    // when tag has a data-attr, create a tool tip for it
 $(".tooltip").hover(

    function () {
      $(this).find(".tooltip-text").addClass("active");
    },
    function () {
      // On hover out, remove the 'active' class to hide the tooltip
      $(this).find(".tooltip-text").removeClass("active");
    }
  );


    lucide.createIcons();

  });

})(jQuery);
