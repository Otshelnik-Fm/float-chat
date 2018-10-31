/* global ssi_modal, Rcl */

jQuery(function($){
    $('.fc_wrap').css({'display':'inline-flex'});
    
    $('.fc_wrap').click(function(){
        fc_load_chat();
        return false;
    });
    
    $(document).on( 'click', '.ssi-modalOuter.fchat_dialog, .ssi-modalOuter.fchat_dialog .ssi-closeIcon', function(e) {
        if(e.target !== this) return;
        console.info('fchat: click close');
        rcl_chat_clear_beat('ZmNoYXQ=');
        console.log('fchat: You killed me :(');
    });

});
    
function fc_load_chat(){
    rcl_preloader_show(jQuery('.fc_bttn'),27);

    rcl_ajax({
        data: {
            action: 'fchat_load'
        },
        success: function(result){
            var ssiOptions = {
                className: 'fchat_dialog',
                sizeClass: 'small',
                content: result.content
            };

            ssi_modal.show(ssiOptions);
            
            fcIsLoad();
            fcDisableGuestsAjax();
            
            rcl_do_action('fc_load_chat'); // js-хук - float chat загружен
        }
    });

    return false;
}

// по загрузке чата еще манипуляции
function fcIsLoad(){
    var fcModal = jQuery('.fchat_dialog'); 
    
    // прижмем последнее сообщение к низу (может быть картинка или ютуб - там не прижималось)
    fcModal.on('onShow.ssi-modal',function(){
        var rChat = jQuery('.rcl-chat[data-token="ZmNoYXQ="] .chat-messages');
        if( typeof rChat === 'undefined' || rChat.length === 0 ) return false;

        setTimeout(function(){
            jQuery(rChat).scrollTop( rChat.get(0).scrollHeight );
        },500);
    });
    
    var fcCont = jQuery('.fchat_dialog.ssi-modal .chat-messages');
    jQuery(fcCont).css({'opacity':'0'});
    setTimeout(function(){
        jQuery(fcCont).css({'opacity':'1'});
    },600);
}

function fcDisableGuestsAjax(){
    if (Rcl.user_ID == 0){
        rcl_chat_clear_beat('ZmNoYXQ=');
        jQuery('.fchat_dialog .rcl-pager').css({'pointer-events':'none','opacity':'0.5'});
    }
}
