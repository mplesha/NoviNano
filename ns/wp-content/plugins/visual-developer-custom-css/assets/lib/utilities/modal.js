VisualDeveloper.Utility.Modal = {

  _settings : {
    overlayID            : 'utility-modal-overlay',
    containerID          : 'utility-modal',
    modalArrangeEvent    : 'resize',
    optionSelectionEvent : 'click',
    optionListClass      : 'utility-modal-list-container',
    optionAttribute      : 'utility-modal-list-option-index',
    optionClass          : 'utility-modal-list-option',
    activeOptionClass    : 'utility-modal-list-active-option',
    highlightOptionClass : 'utility-modal-list-highlight-option',
    dangerOptionClass    : 'utility-modal-list-danger-option'
  },

  visualDeveloperInstance : {},
  instanceList            : [],

  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;

    this._initDependencies();
  },

  _initDependencies : function() {
    this._prefixCSSSettings();

    this._settings.optionSelectionEvent  = this._settings.optionSelectionEvent
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-utility-modal ') +
        '.' + this.visualDeveloperInstance.namespace + '-utility-modal ';

    this._settings.modalArrangeEvent  = this._settings.modalArrangeEvent
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-utility-modal ') +
        '.' + this.visualDeveloperInstance.namespace + '-utility-modal ';
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  InitInstance : function(modalTitle, options, responseObject, responseAction) {
    this.instanceList[this.instanceList.length] = jQuery.extend(1, {}, this.InstanceObject);
    this.instanceList[this.instanceList.length - 1].Init(this, modalTitle, options, responseObject, responseAction);
  },

  InstanceObject : {

    modalInstance  : {},

    responseObject : {},
    responseAction : {},

    title          : {},
    options        : {},

    modalOverlayObject  : {},
    modalObject         : {},
    modalOptionsObject  : {},

    Init : function(modalInstance, modalTitle, options, responseObject, responseAction) {
      this.modalInstance  = modalInstance;

      this.responseObject = responseObject;
      this.responseAction = responseAction;

      this.title          = modalTitle;
      this.options        = options;
      this.displayModal();

      var objectInstance = this;

      jQuery(window)
          .unbind(this.modalInstance._settings.modalArrangeEvent)
          .bind(this.modalInstance._settings.modalArrangeEvent, function(){
        objectInstance.arrangeModal();
      });
    },

    displayModal : function() {
      jQuery('body').append(this.getModalContent());

      this.modalOverlayObject = jQuery("#" + this.modalInstance._settings.overlayID);
      this.modalObject        = jQuery("#" + this.modalInstance._settings.containerID);
      this.modalOptionsObject = this.modalObject.find('.' + this.modalInstance._settings.optionClass);

      this.modalOverlayObject.hide().fadeIn("slow");
      this.modalObject.hide().fadeIn("slow");

      this.setModalInteraction();
      this.arrangeModal();
    },

    getModalContent : function() {
      var objectInstance = this,
          modalContent   = '';
      modalContent += '<div id="' + this.modalInstance._settings.overlayID + '">';
      modalContent += '<div id="' + this.modalInstance._settings.containerID + '">';
      modalContent +=   '<h2>' + this.title + '</h2>';
      modalContent +=   '<ul class="' + this.modalInstance._settings.optionListClass + '">';

      jQuery.each(this.options, function(optionIndex, optionInformation) {
        modalContent +=   '<li class="' + objectInstance.modalInstance._settings.optionClass + ' ' +
                               (typeof optionInformation.active !== "undefined" &&
                                   optionInformation.active == true ? objectInstance.modalInstance._settings.activeOptionClass + " " : '') +
                               (typeof optionInformation.highlight !== "undefined" &&
                                   optionInformation.highlight == true ? objectInstance.modalInstance._settings.highlightOptionClass + " " : '') +
                               (typeof optionInformation.danger !== "undefined" &&
                                   optionInformation.danger == true ? objectInstance.modalInstance._settings.dangerOptionClass + " " : '') +
                                    '" ' +
                               objectInstance.modalInstance._settings.optionAttribute + '="' + optionIndex + '"' +
                           '>' +
                              '<span>' + optionInformation.name + '</span>' +
                          '</li>';
      });
      modalContent +=   '</ul>';
      modalContent += '</div>';
      modalContent += '</div>';

      return modalContent;
    },

    setModalInteraction : function() {
      var objectInstance = this;

      this.modalOptionsObject.bind(this.modalInstance._settings.optionSelectionEvent, function(){
        objectInstance.Respond(jQuery(this).attr(objectInstance.modalInstance._settings.optionAttribute));

        objectInstance.modalObject.fadeOut("slow");
        objectInstance.modalOverlayObject.fadeOut('slow', function(){
          jQuery(this).remove();
        });
        jQuery(window).unbind(objectInstance.modalInstance._settings.modalArrangeEvent);
      });
    },

    arrangeModal : function() {
      this.modalOverlayObject
          .css("width", jQuery(window).width())
          .css("height", jQuery(window).height());
      var currentPanelObject = this.modalInstance.visualDeveloperInstance.Panel.currentPanelObject;

      var topDistance  = this.modalInstance
                             .visualDeveloperInstance
                             .Panel
                             .currentPanelUserNotificationObject.outerHeight() + (
            this.modalInstance.visualDeveloperInstance.toolbarObject.length > 0 ?
                this.modalInstance.visualDeveloperInstance.toolbarObject.outerHeight() : 0
          );

      var leftDistance  = (currentPanelObject.length > 0
          ? ((currentPanelObject.offset().left + currentPanelObject.width()) | 0 )
          : ( jQuery(window).width() / 2 | 0 ));

      if(currentPanelObject.length > 0 &&
          parseInt(jQuery(window).width(), 10) <
              parseInt(currentPanelObject.width(), 10) + parseInt(this.modalObject.width(), 10)
          )
        leftDistance = 0;

      this.modalObject
          .css("top", topDistance + "px")
          .css("left", leftDistance + "px")
          .css("position", "fixed");
    },

    Respond : function(response) {
      this.responseAction.call(this.responseObject, [response]);
    }

  }
};