if (typeof jQuery === "undefined") {
  throw new Error("CRUD requires jQuery");
}

+function ($) {
  'use strict';

  // CRUD CLASS DEFINITION
  // =========================

  // Constructor
  var Crud = function (element, options, selected) {
    this.$element     = $(element);
    this.$container   = this.$element.find('.crud-container');
    this.$modal       = this.$element.find('.crud-modal');
    this.$modalInfo   = this.$element.find('.crud-modalInfo');
    this.current      = selected;
    this.options      = options;
  };

  // Default options
  Crud.DEFAULTS = {
    // wrap: true
  };

  Crud.prototype.loading = function () {
    this.$container.html('');
    this.$container.addClass('loading');
  };

  Crud.prototype.error = function (msg, code) {
    this.$container.html('ERROR (' + code + '): ' + msg);
    this.$container.removeClass('loading');
  };

  Crud.prototype.output = function (html) {
    this.$container.html(html);
    this.$container.removeClass('loading');
  };

  Crud.prototype.buttonsHide = function (type) {
    if (type === 'edit') {
      this.$element.find('.crud-btn-edit').addClass('hide');
    } else {
      this.$element.find('.crud-btn-create').addClass('hide');
    }
  };

  Crud.prototype.buttonsShow = function (type) {
    if (type === 'edit') {
      this.$element.find('.crud-btn-edit').removeClass('hide');
    } else {
      this.$element.find('.crud-btn-create').removeClass('hide');
    }
  };

  Crud.prototype.allButtonsEnable = function () {
    this.$element.find('.crud-btn').each(function (){
      var $this     = $(this);
      var container = $this.attr('data-container');
      if (!container) {
        container = 'li';
      }
      $this.closest(container).removeClass('btn-selected');
      $this.removeAttr('disabled');
    });
  };

  Crud.prototype.buttonDisable = function (button) {
    var $button   = $(button);
    var container = $button.attr('data-container');
    if (!container) {
      container = 'li';
    }
    $button.closest(container).addClass('btn-selected');
    $button.attr('disabled', 'disabled');
  };

  Crud.prototype.processResponse = function (data, processor) {
    var $data = $(data);
    var html = 'Unknown';
    if ($data.is('.redirect')) {
      window.location.assign($data.find('.url').text());
      html = $data.find('.label').text();
    } else if ($data.is('.html')) {
      html = $data.html();
    } else {
      html = $data.text();
    }
    this[processor](html);
/*    switch(processor) {
      case 'view': this.processView(html); break;
      case 'new': this.processNew(html); break;
      case 'confirm': this.processConfirm(html); break;
    }
*/
  };

  Crud.prototype.processError = function (data) {
    var $data = $(data.responseText);
    this.buttonsHide('edit');
    this.allButtonsEnable();
    if ($data.is('.redirect')) {
      window.location.assign($data.text());
    } else {
      this.error($data.text(), data.status);
    }
  };

  Crud.prototype.actionNew = function (target, button) {
    var element = this;
    element.loading();
    element.buttonDisable(button);
    $.get(target, null).done(function (data) {
        element.processResponse(data, 'processNew');
      }).fail(function (data) {
        element.processError(data);
    });
  };

  Crud.prototype.actionCreate = function (target, form) {
    var element = this;
    element.loading();
    form.ajaxSubmit({
      url : target,
      success : function (data, status, xhr, form) {
        element.processResponse(data, 'processNew');
      },
      error : function (xhr, status, error, form) {
        element.processError(xhr);
      }
    });
  };

  Crud.prototype.processNew = function (html) {
    this.buttonsHide('edit');
    this.output(html);
    this.current = null;
  };

  Crud.prototype.actionView = function (target, button) {
    var element = this;
    element.loading();
    if (button !== undefined) {
      element.buttonDisable(button);
    } else {
      element.allButtonsEnable();
    }
    $.get(target, null).done(function (data) {
        element.processResponse(data, 'processView');
      }).fail(function (data) {
        element.processError(data);
    });
  };

  Crud.prototype.actionUpdate = function (target, form) {
    var element = this;
    element.loading();
    form.ajaxSubmit({
      url : target,
      success : function (data, status, xhr, form) {
        element.processResponse(data, 'processView');
      },
      error : function (xhr, status, error, form) {
        element.processError(xhr);
      }
    });
  };

  Crud.prototype.processView = function (html) {
    this.buttonsShow('edit');
    this.output(html);
  };

  Crud.prototype.actionConfirm = function (target, heading, title, confirmaction, confirmtarget) {
    var element = this;
    element.$modal.find('.message-title').html(heading);
    element.$modal.find('.modal-title').html(title);
    element.$modal.find('.modal-btn-yes').attr('data-action', confirmaction);
    element.$modal.find('.modal-btn-yes').attr('data-target', confirmtarget);
    element.$modalInfo.html('');
    element.$modalInfo.addClass('loading');
    element.$modal.modal('show');
    $.get(target, null).done(function (data) {
        element.processResponse(data, 'processConfirm');
      }).fail(function (data) {
        element.processError(data);
    });
  };

  Crud.prototype.processConfirm = function (html) {
    this.$modalInfo.html(html);
    this.$modalInfo.removeClass('loading');
  };

  function crudClick(event) {
    var $this   = $(this), href;
    var $scope  = $this.closest('.crud');
    var element = $scope.data('jquery.crud');
    var options = $.extend({}, $scope.data(), $this.data());
    var action  = $this.attr('data-action');
    var target  = $this.attr('data-target');
    var container = $this.attr('data-container');
    var id      = $this.attr('data-id');
    var $form   = $this.closest('form');

    event.preventDefault();

    if (!container) {
      container = 'li';
    }

    if ($this.is('.crud-item')) {
      $scope.find('.crud-item').each(function(){
        $(this).closest(container).removeClass('item-selected');
      });
      $this.closest(container).addClass('item-selected');
    }

    // Actions with no id
    if (action === 'new') {
      element.actionNew(target, this);
      $scope.find('.crud-item').each(function(){
        $(this).closest(container).removeClass('item-selected');
      });
    }
    if (action === 'create') {
      element.actionCreate(target, $form);
    }
    if (action === 'clear') {
      element.buttonsHide('edit');
      element.buttonsShow('new');
      element.allButtonsEnable();
      element.output('');
    }

    // Actions with id
    if (id || element.current) {
      if (id) {
        element.current = id;
      }
      target = target + '/id/' + element.current;
      if (action === 'view') {
        element.buttonsShow('new');
        element.actionView(target);
      }
      if (action === 'edit') {
        element.buttonsHide('new');
        element.actionView(target, this);
      }
      if (action === 'update') {
        element.actionUpdate(target, $form);
      }
      if (action === 'confirm') {
        var confirmaction  = $this.attr('data-confirm-action');
        var confirmtarget  = $this.attr('data-confirm-target');
        var title          = $this.attr('data-confirm-title');
        var heading        = $this.attr('data-confirm-heading');
        element.actionConfirm(target, heading, title, confirmaction, confirmtarget);
      }
      if (action === 'delete') {
        element.$modal.modal('hide');
        element.actionUpdate(target, $form);
      }
    }

    // Save element
    $scope.data('jquery.crud', element);
  }

  // CRUD PLUGIN DEFINITION
  // ==========================

  var old = $.fn.crud;

  $.fn.crud = function(option) {
    return this.each(function () {
      var $this    = $(this);
      var data     = $this.data('jquery.crud');
      var options  = $.extend({}, Crud.DEFAULTS, $this.data(), typeof option === 'object' && option);
      var selected = typeof option === 'string' ? option : options.current;

      if (!data) {
        $this.data('jquery.crud', (data = new Crud(this, options, selected)));
      }
    });
  };

  $.fn.crud.Constructor = Crud;

  // CRUD NO CONFLICT
  // ====================

  $.fn.crud.noConflict = function () {
    $.fn.crud = old;
    return this;
  };

  // CRUD DATA-API
  // =================

  $(document).on('click.jquery.crud.data-api', '.crud [data-action]', crudClick);

  $(window).on('load', function () {
    $('.crud').each(function () {
      var $crud = $(this);
      $crud.crud($crud.data());
    });
  });

}(jQuery);