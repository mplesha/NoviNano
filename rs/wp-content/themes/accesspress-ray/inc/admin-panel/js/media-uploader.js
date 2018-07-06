jQuery(document).ready(function($){
  var _custom_media = true,
      _orig_send_attachment = wp.media.editor.send.attachment;

  $('.accesspress_ray_upload_button').click(function(e) {
    var send_attachment_bkp = wp.media.editor.send.attachment;
    var button = $(this);
    var id = button.attr('id').replace('_button', '');
    var uploadAttr = button.attr('attr-upload');
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
      if ( _custom_media ) {
        $("#"+id).val(attachment.url);
        $('.'+uploadAttr).fadeIn();
        $("."+uploadAttr).attr('src',attachment.url);
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }

    wp.media.editor.open(button);
    return false;
  });

  $(document).on( 'click', '.accesspress_ray_remove_upload', function(){
    var removeAttr = $(this).attr('attr-remove');
    $(this).parent().find('img').attr('src','');
  	$('input.'+ removeAttr).val('');
  });

  });