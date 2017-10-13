<?php

require_once('settings.php');

// подключаем стиль
function fc_add_style(){
    if ( !rcl_exist_addon('rcl-chat') ) return false;  // если не активен Rcl Chat (Чат)

    rcl_enqueue_style('fchat_style',rcl_addon_url('fchat-style.css', __FILE__));
}
if (!is_admin()) {
    add_action('rcl_enqueue_scripts','fc_add_style',10);
}


// добавляем кнопку в лк
function fchat_tab(){
    if ( !rcl_exist_addon('rcl-chat') ) return false; // если не активен Rcl Chat (Чат)

    $tab_data = array(
        'id'=>'fc_float_chat',
        'name'=> 'Float chat',
        'supports'=>array('ajax','dialog'),
        'public'=>1,
        'icon'=>'fa-laptop',
        'output'=> '',          // не задаем вывод, т.к. нам не нужен вывод в лк. Ф-ция ниже fchat_button() выведет где нам надо
        'content'=>array(
            array(		//массив данных первой дочерней вкладки
                'callback' => array(
                    'name'=>'fchat_shortcode',
                )
            )
        )
    );
    rcl_tab($tab_data);
}
add_action('init','fchat_tab');


// функция обработчик
// мы правильные ребята - do_shortcode не используем
// но для примера его ниже оставил
function fchat_shortcode(){
    global $user_ID;

    $fchat_uploads = 0;
    if(rcl_get_option('fchat_upload') == 'yes') $fchat_uploads = 1;

    // получим чат
    $get_chat = rcl_chat_shortcode(array('chat_room'=>'fchat','userslist'=>1,'file_upload'=>$fchat_uploads,'in_page'=>30));
    //$get_chat = do_shortcode('[rcl-chat chat_room="fchat" userslist="1" file_upload="1" in_page="15"]');

    $content = '<h3>'.rcl_get_option('fchat_name').'</h3>';

    if(rcl_get_option('fchat_guest') == 1){ // гость может смотреть чат
        $content .= $get_chat;
    } else {                                // гостю нельзя смотреть чать
        if($user_ID){
            $content .= $get_chat;
        } else {
            $content .= '<div class="chat-form">';
                $content .= '<div class="chat-notice"><span class="notice-error"></span></div>'; // поддержка допа you need to login
            $content .= '</div>';
            $content .= rcl_get_include_template('fchat-guest-info.php',__FILE__); // подключаем шаблон
        }
    }

    return $content;
}


// token внутри функции rcl_chat_clear_beat('ZmNoYXQ=');
// берется из атрибута шорткод: chat_room="fchat"
//
// функция по клику гасит ajax запросы к чату
// клик по оверлею, по крестику, и кнопке "Закрыть"
//
// if(e.target != this) return; - чтобы только по клику на этих элементах, а не на дочерних
// - касается глобального класса .ssi-modalOuter.fc_float_chat
//
// по клику на кнопке показываю в ней спиннер загрузки
// хотя спинер автоматом убивается как контент вкладки загружен, а по таймауту на всякий случай убираю его
// можно было повесить на js событие rcl_add_action('rcl_upload_tab','наша ф-ция'), но не стал
function fchat_burn_in_hell(){
    if ( !rcl_exist_addon('rcl-chat') ) return false; // если не активен Rcl Chat (Чат)

    echo "<script>
(function($){
$(document).on( 'click', '.ssi-modalOuter.fc_float_chat, .ssi-modalOuter.fc_float_chat .ssi-closeIcon', function(e) {
    if(e.target != this) return;
    console.info('fchat: click close');
    rcl_chat_clear_beat('ZmNoYXQ=');
    console.log('fchat: You killed me :(');
});

// ставим спинер на кнопку по вызову чата
$('#tab-button-fc_float_chat').click(function(){
    rcl_preloader_show(jQuery('#tab-button-fc_float_chat'),30);
    setTimeout(function(){
        rcl_preloader_hide();
    },2000)
});
})(jQuery);
</script>";
}
add_action('wp_footer','fchat_burn_in_hell');

// фрагмент для вставки в скрипт выше - проверить токены чата
/* for (var token in rcl_chat_beat) {
    console.log('for start');
    console.log(token + ' ' + rcl_chat_beat[token]);
    if(token != rcl_chat_contact_token){
        console.log('in if');
        console.log(token);
        rcl_chat_clear_beat(token);
    }
}; */


/*
*   TODO:
*       9-09-2016
*           Скрипт fileupload нам нужен, если в чате разрешена загрузка файлов
*           В дальнейшем можно опцией сделать отключать загрузку файлов и не забыть похерить этот скрипт
*       29-09-2016 - выполнено
*/

// функция вывода кнопки за пределами личного кабинета
function f_chat_button(){
    if ( !rcl_exist_addon('rcl-chat') ) return false; // если не активен Rcl Chat (Чат)

    global $user_ID;
    $button = rcl_get_tab_button('fc_float_chat',$user_ID);

    rcl_dialog_scripts();       // скрипты ssi

    if(rcl_get_option('fchat_upload') == 'yes') { // в настройках разрешена загрузка файлов
        rcl_fileupload_scripts();               // скрипты fileupload (загрузка файлов)
    }

    return $button;
}


// вывод автоматически
function fchat_auto(){
    if(rcl_get_option('fchat_button') != 'auto') return false;

    echo f_chat_button();
}
add_action('wp_head','fchat_auto');


// вывод шорткодом [fchat_init]
function fchat_init_shortcode(){
    if(rcl_get_option('fchat_button') == 'auto') return false; // если стоит авто вывод кнопки f-чата

    return f_chat_button();
}
add_shortcode('fchat_init','fchat_init_shortcode');

