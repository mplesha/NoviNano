VisualDeveloper.Utility.DomRuleBuilder = {

  _lang : {
    title  : 'Advanced CSS Rule Builder',
    finish : "Start Customizing",
    cancel : 'Cancel'
  },

  _settings : {
    bodyClass                   : 'utility-dom-rule-builder-body',
    overlayID                   : 'utility-dom-rule-builder-overlay',
    containerID                 : 'utility-dom-rule-builder-container',
    ruleControllerInputID       : 'utility-dom-rule-builder-rule-preview',
    nodeItemContainerClass      : 'utility-dom-rule-builder-node-item-container',
    nodeItemClass               : 'utility-dom-rule-builder-node-item',
    nodeItemTargetChildrenClass : 'utility-dom-rule-builder-node-item-target-children',
    nodeItemFirstClass          : 'utility-dom-rule-builder-node-item-first',
    finishCreationClass         : 'utility-dom-rule-builder-finish-creation',
    cancelCreationClass         : 'utility-dom-rule-builder-cancel-creation',
    trigger                     : 'click',
    inputRuleRefreshEvent       : 'keyup',
    arrangeEvents               : 'resize'
  },

  visualDeveloperInstance : {},
  instanceList            : [],

  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;

    this._initDependencies();
  },

  _initDependencies : function() {
    this._settings.trigger  = this._settings.trigger
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-dom-rule-builder ') +
        '.' + this.visualDeveloperInstance.namespace + '-dom-rule-builder ';
    this._settings.arrangeEvents  = this._settings.arrangeEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-dom-rule-builder ') +
        '.' + this.visualDeveloperInstance.namespace + '-dom-rule-builder ';
    this._settings.inputRuleRefreshEvent  = this._settings.inputRuleRefreshEvent
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-dom-rule-builder ') +
        '.' + this.visualDeveloperInstance.namespace + '-dom-rule-builder ';

    this._prefixCSSSettings();
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  InitInstance : function(cssRule, responseObject, responseAction) {
    this.instanceList[this.instanceList.length] = jQuery.extend(1, {}, this.InstanceObject);
    this.instanceList[this.instanceList.length - 1].Init(this, cssRule, responseObject, responseAction);
  },

  InstanceObject : {

    builderInstance  : {},

    responseObject : {},
    responseAction : {},

    cssRule             : {},
    cssRuleLevelTokens  : {},

    builderOverlayObject  : {},
    builderObject         : {},

    ruleControllerInput   : {},
    nodeItemContainer     : {},
    ruleSubmissionButton  : {},
    ruleCancelButton      : {},

    Init : function(builderInstance, cssRule, responseObject, responseAction) {
      this.builderInstance = builderInstance;

      this.responseObject  = responseObject;
      this.responseAction  = responseAction;

      this.displayBuilder();
      this._interactionUpdateCSSRule(cssRule);

      var objectInstance = this;

      jQuery(window)
          .unbind(this.builderInstance._settings.arrangeEvents)
          .bind(this.builderInstance._settings.arrangeEvents, function(){
            objectInstance.arrangeBuilder();
          });
    },

    displayBuilder : function() {
      jQuery('body')
          .addClass(this.builderInstance._settings.bodyClass)
          .append(this.getBuilderContent());

      this.builderOverlayObject = jQuery("#" + this.builderInstance._settings.overlayID);
      this.builderObject        = jQuery("#" + this.builderInstance._settings.containerID);
      this.ruleControllerInput  = jQuery("#" + this.builderInstance._settings.ruleControllerInputID);
      this.nodeItemContainer    = this.builderObject.find(" > ." + this.builderInstance._settings.nodeItemContainerClass);
      this.ruleSubmissionButton = this.builderObject.find(" > ." + this.builderInstance._settings.finishCreationClass);
      this.ruleCancelButton     = this.builderObject.find(" > ." + this.builderInstance._settings.cancelCreationClass);

      this.builderOverlayObject.hide().fadeIn("slow");
      this.builderObject.hide().fadeIn("slow");

      this.setBuilderInteraction();
      this.arrangeBuilder();
    },

    getBuilderContent : function() {
      var builderContent   = '';

      builderContent += '<div id="' + this.builderInstance._settings.overlayID + '">';
      builderContent +=   '<div id="' + this.builderInstance._settings.containerID + '">';
      builderContent +=     '<span class="' + this.builderInstance._settings.cancelCreationClass + '">';
      builderContent +=       this.builderInstance._lang.cancel;
      builderContent +=     '</span>';
      builderContent +=     '<h2>' + this.builderInstance._lang.title + '</h2>';
      builderContent +=     '<input type="text" ';
      builderContent +=            'id="' + this.builderInstance._settings.ruleControllerInputID + '" ';
      builderContent +=            'value="' + this.cssRule + '" ';
      builderContent +=     '/>';
      builderContent +=     '<div class="' + this.builderInstance._settings.nodeItemContainerClass + '">';
      builderContent +=     '</div>';
      builderContent +=     '<span class="' + this.builderInstance.visualDeveloperInstance._settings.clearClass + '"></span>';
      builderContent +=     '<span class="' + this.builderInstance._settings.finishCreationClass + '">';
      builderContent +=       this.builderInstance._lang.finish;
      builderContent +=     '</span>';
      builderContent +=   '</div>';
      builderContent += '</div>';

      return builderContent;
    },

    _getBuilderVisualSyntax : function() {
      var objectInstance = this,
          content        = '';

      content += this._getBuilderVisualSyntaxItem(this.cssRuleLevelTokens, 0);
      content += '<span class="' + this.builderInstance.visualDeveloperInstance._settings.clearClass + '"></span>';

      return content;
    },

    _getBuilderVisualSyntaxItem : function(cssRuleTokens, tokenDepth) {
      tokenDepth = (typeof tokenDepth == "undefined" ? 1 : tokenDepth);
      var objectInstance = this,
          content        = '';

      jQuery.each(cssRuleTokens, function(ruleIndex, cssRuleLevel) {
        cssRuleLevel = jQuery.trim(cssRuleLevel);

        var currentLevelPrimaryItem = jQuery.trim(
                        cssRuleLevel.indexOf(" ") === -1 ?
                        cssRuleLevel : cssRuleLevel.substr(0, cssRuleLevel.indexOf(" "))
            );


        if(currentLevelPrimaryItem != '') {
          var itemClass = objectInstance.builderInstance._settings.nodeItemClass;

          if(tokenDepth == 0)
            itemClass += ' ' + (ruleIndex == 0 ? objectInstance.builderInstance._settings.nodeItemFirstClass : objectInstance.builderInstance._settings.nodeItemTargetChildrenClass);

          content += '<div class="' + itemClass  + '">' + currentLevelPrimaryItem + '</div>';
        }

        if(currentLevelPrimaryItem != cssRuleLevel)
          content += objectInstance._getBuilderVisualSyntaxItem(cssRuleLevel.substr(currentLevelPrimaryItem.length).split(" "));

      });

      return content;
    },

    setBuilderInteraction : function() {
      var objectInstance = this;

      this.ruleControllerInput.bind(this.builderInstance._settings.inputRuleRefreshEvent, function(event) {
        objectInstance._interactionUpdateCSSRule(jQuery(this).val());
      });

      this.nodeItemContainer
          .off(this.builderInstance._settings.trigger, '> .' + this.builderInstance._settings.nodeItemClass)
          .on(this.builderInstance._settings.trigger, '> .' + this.builderInstance._settings.nodeItemClass, function(){
            jQuery(this).toggleClass(objectInstance.builderInstance._settings.nodeItemTargetChildrenClass);
            objectInstance._interactionUpdateCSSBasedOnSyntaxBuilder();
          });

      this.ruleSubmissionButton.bind(this.builderInstance._settings.trigger, function(event){
        event.preventDefault();
        event.stopImmediatePropagation();

        objectInstance.CloseAndRespond(objectInstance.cssRule);
      });

      this.ruleCancelButton.bind(this.builderInstance._settings.trigger, function(event){
        event.preventDefault();
        event.stopImmediatePropagation();

        objectInstance.CloseAndRespond(false);
      });
    },

    _interactionUpdateCSSBasedOnSyntaxBuilder : function() {
      var objectInstance = this,
          cssRule        = '';

      this.nodeItemContainer.find('> .' + this.builderInstance._settings.nodeItemClass).each(function(index) {
        if(index > 0)
          cssRule += (
              jQuery(this).hasClass(objectInstance.builderInstance._settings.nodeItemTargetChildrenClass) ?
                  ' > ' : ' '
          );

        cssRule += jQuery(this).text();
      });

      this._interactionUpdateCSSRule(cssRule);
    },

    _interactionUpdateCSSRule : function(cssRule) {
      if(this.ruleControllerInput.val() != cssRule)
        this.ruleControllerInput.val(cssRule);

      this.cssRule              = cssRule;
      this.cssRuleLevelTokens   = cssRule.split(">");
      this.nodeItemContainer.html(this._getBuilderVisualSyntax());

      this.builderInstance.visualDeveloperInstance.NavigationPanel._highlightNavigationMirrorJQueryDOMElement(
          jQuery(this.cssRule)
      );
    },

    arrangeBuilder : function() {
      this.builderOverlayObject
          .css("width", jQuery(window).width())
          .css("height", jQuery(window).height());
      var currentPanelObject = this.builderInstance.visualDeveloperInstance.Panel.currentPanelObject;

      var topDistance  = this.builderInstance
          .visualDeveloperInstance
          .Panel
          .currentPanelUserNotificationObject.outerHeight() + (
          this.builderInstance.visualDeveloperInstance.toolbarObject.length > 0 ?
              this.builderInstance.visualDeveloperInstance.toolbarObject.outerHeight() : 0
          );

      var leftDistance  = (currentPanelObject.length > 0
          ? ((currentPanelObject.offset().left + currentPanelObject.width()) | 0 )
          : ( jQuery(window).width() / 2 | 0 ));

      this.builderObject
          .css("top", topDistance + "px")
          .css("left", leftDistance + "px")
          .css("width", parseInt(jQuery(window).width()) - leftDistance)
          .css("position", "fixed");
    },

    CloseAndRespond : function(response) {
      this.CloseBuilder();
      this.Respond(response);
    },

    CloseBuilder : function() {
      jQuery('body').removeClass(this.builderInstance._settings.bodyClass);
      jQuery(window).unbind(this.builderInstance._settings.arrangeEvents);
      this.builderOverlayObject.fadeOut('slow', function(){
        jQuery(this).remove();
      });
    },

    Respond : function(response) {
      this.responseAction.call(this.responseObject, response);
    }

  }

};