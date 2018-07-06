VisualDeveloper.Utility.ImageSelect = {

  _settings : {
    containerClass         : 'utility-image-select-container',
    itemClass              : 'utility-image-select-item',
    itemActiveClass        : 'utility-image-select-item-active',
    itemValueAttribute     : 'utility-image-select-item-value',
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
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-image-select ') +
        '.' + this.visualDeveloperInstance.namespace + '-image-select ';

    this._prefixCSSSettings();
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  InitInstance : function(selectObject, selectFirstByDefault) {
    selectFirstByDefault = typeof selectFirstByDefault == "undefined" ? false : selectFirstByDefault;
    var objectInstance = this;

    selectObject.each(function(){
      objectInstance.instanceList[objectInstance.instanceList.length] = jQuery.extend(1, {}, objectInstance.InstanceObject);
      objectInstance.instanceList[objectInstance.instanceList.length - 1].Init(objectInstance, jQuery(this), selectFirstByDefault);
    });
  },

  InstanceObject : {

    selectFirstByDefault: false,
    selectObject        : false,
    imageSelectInstance : {},

    Init : function(imageSelectInstance, selectObject, selectFirstByDefault) {
      this.imageSelectInstance = imageSelectInstance;
      this.selectObject        = selectObject;
      this.selectFirstByDefault= selectFirstByDefault;

      this.displayContent();
      this.bindContentEvents();
      this._checkSelectDisplay();
    },

    displayContent : function() {
      this.selectObject.after(this.getHTMLContent());
      this.selectObject.hide();
      this._syncSelectWithItems();
    },

    getHTMLContent : function() {
      var objectInstance = this,
          html           = '';

      html += '<ul class="' + this.imageSelectInstance._settings.containerClass + '">';

      this.selectObject.find("> option").each(function(){
        var itemClass     = objectInstance.imageSelectInstance._settings.itemClass,
            itemAttribute = objectInstance.imageSelectInstance._settings.itemValueAttribute + '="' + jQuery(this).val() + '"';

        if(typeof jQuery(this).attr("data-tooltip") !== "undefined" && 1 == 2) {
          itemClass     += " hint--primary hint--top";
          itemAttribute += ' data-hint="' + jQuery(this).attr("data-tooltip") + '" ';
        }

        html += '<li ' + itemAttribute +
                     'class="' + itemClass + '" >' +
                     '<img src="' + jQuery(this).text() + '"/>'    +
                '</li>';
      });

      html += '</ul>';

      return html;
    },

    bindContentEvents : function() {
      var objectInstance = this;

      this.selectObject
          .next()
          .find("." + this.imageSelectInstance._settings.itemClass)
          .bind(this.imageSelectInstance._settings.itemValueSelectTrigger, function() {
            objectInstance._selectObjectSelectionEventHandler(jQuery(this));
          });
    },

    _syncSelectWithItems : function() {
      this.selectObject
          .next()
          .find("." + this.imageSelectInstance._settings.itemClass)
          .removeClass(this.imageSelectInstance._settings.itemActiveClass);
      this.selectObject
          .next()
          .find('[' + this.imageSelectInstance._settings.itemValueAttribute + '="' + this.selectObject.find("> option:selected").val() + '"]')
          .addClass(this.imageSelectInstance._settings.itemActiveClass);

      this._checkSelectDisplay();
    },

    _checkSelectDisplay : function() {
      if(this.selectFirstByDefault
          && this.selectObject.next().find("." + this.imageSelectInstance._settings.itemActiveClass).length <= 0
          && this.selectObject.attr("data-clean-value") == '') {
        this._selectObjectSelectionEventHandler(
          this.selectObject.next().find("." + this.imageSelectInstance._settings.itemClass + ":first")
        );
      }
    },

    _selectObjectSelectionEventHandler : function(selectionObject) {
      this.selectObject.val(
          selectionObject.attr(
              this.imageSelectInstance._settings.itemValueAttribute
          )
      ).trigger("change");
      this._syncSelectWithItems();
    }

  }

};