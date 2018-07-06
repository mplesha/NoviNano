VisualDeveloper.Utility.ColorSelect = {

  _settings : {
    containerClass         : 'utility-color-select-container',
    itemClass              : 'utility-color-select-item',
    itemActiveClass        : 'utility-color-select-item-active',
    itemValueAttribute     : 'utility-color-select-item-value',
    itemValueSelectTrigger : 'click'
  },

  visualDeveloperInstance : {},
  instanceList            : [],

  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;

    this._initDependencies();
  },

  _initDependencies : function() {
    this._settings.itemValueSelectTrigger  = this._settings.itemValueSelectTrigger
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-color-select ') +
        '.' + this.visualDeveloperInstance.namespace + '-color-select ';

    this._prefixCSSSettings();
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  InitInstance : function(selectObject) {
    var objectInstance = this;

    selectObject.each(function(){
      objectInstance.instanceList[objectInstance.instanceList.length] = jQuery.extend(1, {}, objectInstance.InstanceObject);
      objectInstance.instanceList[objectInstance.instanceList.length - 1].Init(objectInstance, jQuery(this));
    });
  },

  InstanceObject : {

    selectObject        : false,
    colorSelectInstance : {},

    Init : function(colorSelectInstance, selectObject) {
      this.colorSelectInstance = colorSelectInstance;
      this.selectObject        = selectObject;

      this.displayContent();
      this.bindContentEvents();
    },

    displayContent : function() {
      this.selectObject.after(this.getHTMLContent());
      this.selectObject.hide();
      this._syncSelectWithItems();
    },

    getHTMLContent : function() {
      var objectInstance = this,
          html           = '';

      html += '<ul class="' + this.colorSelectInstance._settings.containerClass + '">';

      this.selectObject.find("> option").each(function(){
        var itemClass     = objectInstance.colorSelectInstance._settings.itemClass,
            itemAttribute = objectInstance.colorSelectInstance._settings.itemValueAttribute + '="' + jQuery(this).val() + '"';

        if(typeof jQuery(this).attr("data-tooltip") !== "undefined" && 1 == 2) {
          itemClass     += " hint--primary hint--top";
          itemAttribute += ' data-hint="' + jQuery(this).attr("data-tooltip") + '" ';
        }

        if(jQuery(this).val() != '')
          itemAttribute += ' style="color:' + jQuery(this).val() + '" ';

        html += '<li ' + itemAttribute +
                     'class="' + itemClass + '" >' +
                    jQuery.trim(jQuery(this).text()) +
                '</li>';
      });

      html += '</ul>';

      return html;
    },

    bindContentEvents : function() {
      var objectInstance = this;

      this.selectObject
          .next()
          .find("." + this.colorSelectInstance._settings.itemClass)
          .bind(this.colorSelectInstance._settings.itemValueSelectTrigger, function() {
            objectInstance.selectObject.val(
                jQuery(this).attr(
                    objectInstance.colorSelectInstance._settings.itemValueAttribute
                )
            ).trigger("change");
            objectInstance._syncSelectWithItems();
          });
    },

    _syncSelectWithItems : function() {
      this.selectObject
          .next()
          .find("." + this.colorSelectInstance._settings.itemClass)
          .removeClass(this.colorSelectInstance._settings.itemActiveClass);
      this.selectObject
          .next()
          .find('[' + this.colorSelectInstance._settings.itemValueAttribute + '="' + this.selectObject.find("> option:selected").val() + '"]')
          .addClass(this.colorSelectInstance._settings.itemActiveClass);
    }

  }

};