VisualDeveloper.Utility.NiceSelect = {

  _settings : {
    selectContainerClass   : 'utility-nice-select-container',
    selectLabelClass       : 'utility-nice-select-container-label',
    valueSelectionTrigger  : 'change keyup'
  },

  visualDeveloperInstance : {},
  instanceList            : [],

  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;

    this._initDependencies();
  },

  _initDependencies : function() {
    this._settings.valueSelectionTrigger  = this._settings.valueSelectionTrigger
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-nice-select ') +
        '.' + this.visualDeveloperInstance.namespace + '-nice-select ';

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

    selectObject          : false,
    selectContainerObject : false,
    selectLabelObject     : false,
    niceSelectInstance    : {},

    Init : function(niceSelectInstance, selectObject) {
      this.niceSelectInstance = niceSelectInstance;
      this.selectObject       = selectObject;

      this._moveSelectObjectIntoContainer();
      this._enableLabelText();
    },

    _moveSelectObjectIntoContainer : function() {
      this.selectObject.after(this._getContainerHTML());

      this.selectContainerObject = this.selectObject.next();
      this.selectLabelObject     = this.selectContainerObject
          .find("." + this.niceSelectInstance._settings.selectLabelClass);

      this.selectObject.appendTo(this.selectContainerObject);
    },

    _getContainerHTML : function() {
      return '<div class="' + this.niceSelectInstance._settings.selectContainerClass + '">' +
                '<span class="' + this.niceSelectInstance._settings.selectLabelClass + '">' +
                  this.selectObject.find(" > option:selected").text() +
                '</span>' +
             '</div>'
    },

    _enableLabelText : function() {
      var objectInstance = this;

      this.selectObject.bind(this.niceSelectInstance._settings.valueSelectionTrigger, function() {
        objectInstance.selectLabelObject.text(jQuery(this).val());
      });
    }

  }

};