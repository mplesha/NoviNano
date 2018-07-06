VisualDeveloper.Utility.SplitInlineSelect = {

  _settings : {
    containerClass         : 'utility-split-inline-select-container',
    itemClass              : 'utility-split-inline-select-item',
    itemActiveClass        : 'utility-split-inline-select-item-active',
    itemValueAttribute     : 'utility-split-inline-select-item-value',
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
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-split-inline-select ') +
        '.' + this.visualDeveloperInstance.namespace + '-split-inline-select ';

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
    splitInlineSelectInstance : {},

    Init : function(splitInlineSelectInstance, selectObject) {
      this.splitInlineSelectInstance = splitInlineSelectInstance;
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

      html += '<ul class="' + this.splitInlineSelectInstance._settings.containerClass + '">';

      this.selectObject.find("> option").each(function(){
        var itemClass     = objectInstance.splitInlineSelectInstance._settings.itemClass,
            itemAttribute = objectInstance.splitInlineSelectInstance._settings.itemValueAttribute + '="' + jQuery(this).val() + '"';

        if(typeof jQuery(this).attr("data-tooltip") !== "undefined" && 1 == 2) {
          itemClass     += " hint--primary hint--top";
          itemAttribute += ' data-hint="' + jQuery(this).attr("data-tooltip") + '" ';
        }

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
          .find("." + this.splitInlineSelectInstance._settings.itemClass)
          .bind(this.splitInlineSelectInstance._settings.itemValueSelectTrigger, function() {
            objectInstance.selectObject.val(
                jQuery(this).attr(
                    objectInstance.splitInlineSelectInstance._settings.itemValueAttribute
                )
            ).trigger("change");
            objectInstance._syncSelectWithItems();
          });
    },

    _syncSelectWithItems : function() {
      this.selectObject
          .next()
          .find("." + this.splitInlineSelectInstance._settings.itemClass)
          .removeClass(this.splitInlineSelectInstance._settings.itemActiveClass);
      this.selectObject
          .next()
          .find('[' + this.splitInlineSelectInstance._settings.itemValueAttribute + '="' + this.selectObject.find("> option:selected").val() + '"]')
          .addClass(this.splitInlineSelectInstance._settings.itemActiveClass);
    }

  }

};