if (typeof jQuery === "undefined") {
  throw new Error("Select Change requires jQuery");
}

+function ($) {
  'use strict';

  // SELECT CHANGE CLASS DEFINITION
  // =========================

  var SelectChange = function (element, options) {
    this.$element     = $(element);
    this.options      = options;
  };

  SelectChange.DEFAULTS = {
    // wrap: true
  };

  function selectChangeEvent(event) {
    var $this     = $(this);
    var $scope    = $this.closest('.selectChange');
    var element   = $scope.data('jquery.selectchange');
    var $select   = $scope.find('.select');
    var $change   = $scope.find('.change');
    var options   = $.extend({}, $scope.data(), $this.data());
    var target    = $scope.attr('data-target');

    event.preventDefault();

    target = target + '/id/' + $select.val();
    $.get(target, null, function(data) {
      var $data = $(data);
      if ($data.is('.html')) {
        $change.html($data.html());
      }
    });

    // Save element
    $scope.data('jquery.selectchange', element);
  }

  // SELECT CHANGE PLUGIN DEFINITION
  // ==========================

  var old = $.fn.selectChange;

  $.fn.selectChange = function(option) {
    return this.each(function () {
      var $this    = $(this);
      var data     = $this.data('jquery.selectchange');
      var options  = $.extend({}, SelectChange.DEFAULTS, $this.data(), typeof option === 'object' && option);

      if (!data) {
        $this.data('jquery.selectchange', (data = new SelectChange(this, options)));
      }
    });
  };

  $.fn.selectChange.Constructor = SelectChange;

  // SELECT CHANGE NO CONFLICT
  // ====================

  $.fn.selectChange.noConflict = function () {
    $.fn.selectChange = old;
    return this;
  };

  // SELECT CHANGE DATA-API
  // =================

  $(document).on('change.jquery.selectchange.data-api', '.selectChange .select', selectChangeEvent);

  $(window).on('load', function () {
    $('.selectChange').each(function () {
      var $selectChange = $(this);
      $selectChange.selectChange($selectChange.data());
    });
  });

}(jQuery);
