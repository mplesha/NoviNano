VisualDeveloper.Utility.InputMAP = {

  _lang : {
    toggleFeature     : "&frac14;",
    inputPlaceholders : ['top', 'right', 'bottom', 'left']
  },

  _settings : {
    toggleFeatureClass       : "toggle-input-map",
    toggleFeatureActiveClass : 'active-input-map',
    toggleFeatureTrigger     : "click"
  },

  visualDeveloperInstance : {},
  instanceList            : [],

  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;
    this._initDependencies();
  },

  _initDependencies : function() {
    this._settings.toggleFeatureTrigger  = this._settings.toggleFeatureTrigger
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-input-map ') +
        '.' + this.visualDeveloperInstance.namespace + '-input-map ';

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

    listObject       : false,
    inputMAPInstance : {},

    Init : function(inputMAPInstance, listObject) {
      this.inputMAPInstance = inputMAPInstance;
      this.listObject       = listObject;

      if(!(this.displayContent())) {
        var objectInstance = this,
            prevObject     = this.listObject.prev();

        prevObject.html(prevObject.html() +
            '<span class="' + this.inputMAPInstance._settings.toggleFeatureClass + '">' +
              this.inputMAPInstance._lang.toggleFeature +
            '</span>'
        );

        prevObject
            .find("." + this.inputMAPInstance._settings.toggleFeatureClass)
            .bind(this.inputMAPInstance._settings.toggleFeatureTrigger, function(event) {
          event.preventDefault();
          event.stopImmediatePropagation();

          if(jQuery(this).hasClass(objectInstance.inputMAPInstance._settings.toggleFeatureActiveClass)) {
            jQuery(this).removeClass(objectInstance.inputMAPInstance._settings.toggleFeatureActiveClass);
            objectInstance.hideContent();
          } else {
            jQuery(this).addClass(objectInstance.inputMAPInstance._settings.toggleFeatureActiveClass);
            objectInstance.displayContent(true);
          }
        });
      }
    },

    displayContent : function(force) {
      var objectInstance = this,
          initialLength  = this.listObject.find("> li").length,
          inputValues    = {},
          topValueLength = 0;

      force = typeof force === "undefined" ? false : force;

      this.listObject.find("select, input").each(function(i){
        inputValues[jQuery(this).attr("name") + "[]"] = (
            typeof jQuery(this).attr("data-clean-value") !== "undefined" ?
                jQuery(this).attr("data-clean-value") :
                jQuery(this).val()
        ).split(",");

        topValueLength = topValueLength > inputValues[jQuery(this).attr("name") + "[]"] ?
            topValueLength : inputValues[jQuery(this).attr("name") + "[]"].length;
      });

      if(topValueLength == 1 && force == false)
        return false;

      this.listObject.find("select, input").each(function(i){
        jQuery(this).attr("name", jQuery(this).attr("name") + "[]");
      });

      for(var i = 1; i <= 3; i++) {
        this.listObject.find("> li").slice(0,initialLength).each(function(){
          jQuery(this).clone(true).appendTo(objectInstance.listObject);
        });
      }

      objectInstance.listObject.find("input").each(function(i){
        jQuery(this).attr("placeholder", objectInstance.inputMAPInstance._lang.inputPlaceholders[i]);
      });


      this.listObject.find("select, input").each(function(){
        if(inputValues[jQuery(this).attr("name")].length != 0) {
          jQuery(this).val(
              inputValues[jQuery(this).attr("name")][0]
          );

          inputValues[jQuery(this).attr("name")].splice(0,1);
        }
      });

      return true;
    },

    hideContent : function() {
      this.listObject.find("> li").slice(2).remove();

      this.listObject.find("select, input").each(function(i){
        jQuery(this).attr("name", jQuery(this).attr("name").replace("[]", ""));


        if(jQuery(this).is("input"))
          jQuery(this).val("").trigger("change").attr("placeholder", "Value");
      });
    }

  }

};