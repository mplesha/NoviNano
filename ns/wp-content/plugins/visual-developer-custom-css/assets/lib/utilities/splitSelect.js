VisualDeveloper.Utility.SplitSelect = {

  _settings : {
    containerClass         : 'utility-split-select-container',
    itemClass              : 'utility-split-select-item',
    itemActiveClass        : 'utility-split-select-item-active',
    itemValueAttribute     : 'utility-split-select-item-value',
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
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-split-select ') +
        '.' + this.visualDeveloperInstance.namespace + '-split-select ';

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
    splitSelectInstance : {},

    Init : function(splitSelectInstance, selectObject) {
      this.splitSelectInstance = splitSelectInstance;
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

      html += '<ul class="' + this.splitSelectInstance._settings.containerClass + '">';

      this.selectObject.find("> option").each(function(){
        var itemClass     = objectInstance.splitSelectInstance._settings.itemClass,
            itemAttribute = objectInstance.splitSelectInstance._settings.itemValueAttribute + '="' + jQuery(this).val() + '"';

        if(typeof jQuery(this).attr("data-tooltip") !== "undefined" && 1 == 2) {
          itemClass     += " hint--primary hint--top";
          itemAttribute += ' data-hint="' + jQuery(this).attr("data-tooltip") + '" ';
        }

        html += '<li ' + itemAttribute +
                     'class="' + itemClass + '" >' +
                    jQuery(this).val() +
                '</li>';
      });

      html += '</ul>';

      return html;
    },

    bindContentEvents : function() {
      var objectInstance = this;

      this.selectObject
          .next()
          .find("." + this.splitSelectInstance._settings.itemClass)
          .bind(this.splitSelectInstance._settings.itemValueSelectTrigger, function() {
            objectInstance.selectObject.val(
                jQuery(this).attr(
                    objectInstance.splitSelectInstance._settings.itemValueAttribute
                )
            ).trigger("change");
            objectInstance._syncSelectWithItems();
          });
    },

    _syncSelectWithItems : function() {
      this.selectObject
          .next()
          .find("." + this.splitSelectInstance._settings.itemClass)
          .removeClass(this.splitSelectInstance._settings.itemActiveClass);
      this.selectObject
          .next()
          .find('[' + this.splitSelectInstance._settings.itemValueAttribute + '="' + this.selectObject.find("> option:selected").val() + '"]')
          .addClass(this.splitSelectInstance._settings.itemActiveClass);
    }

  }

};