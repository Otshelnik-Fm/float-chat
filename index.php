<?php

/*

╔═╗╔╦╗╔═╗╔╦╗
║ ║ ║ ╠╣ ║║║ https://otshelnik-fm.ru
╚═╝ ╩ ╚  ╩ ╩

*/


// подключаем настройки в админке, но не в управлении мультисайта
// баг мультисайта описан здесь https://otshelnik-fm.ru/?p=3629
if( is_admin() && !is_network_admin() ){
    require_once 'settings.php';
}



// svg inliner     http://yoksel.github.io/url-encoder/ru/
// svg compressor  https://jakearchibald.github.io/svgomg/
// great packer http://dean.edwards.name/packer/
// great packer https://cssminifier.com/
// подключаем стиль
function fchat_load_resourse(){
    if ( !rcl_exist_addon('rcl-chat') ) return false;   // если не активен Rcl Chat (Чат)

    rcl_enqueue_script('fchat_script', rcl_addon_url('inc/fchat-js.min.js', __FILE__), false, true);

    if( rcl_get_option('fchat_guest', 'yes') !== 'yes' && !is_user_logged_in() ){   // гости могут чат видеть
        rcl_enqueue_style('fchat_style_guests', rcl_addon_url('inc/fchat-style-guests.min.css', __FILE__), true);
    } else {
        rcl_enqueue_style('fchat_style', rcl_addon_url('inc/fchat-style.min.css', __FILE__), true);
    }
}
if ( !is_admin() ) {
    add_action('rcl_enqueue_scripts','fchat_load_resourse',10);
}




// ajax ответ
// мы правильные ребята - do_shortcode не используем
// но для примера его ниже оставил
function fchat_load(){
    rcl_verify_ajax_nonce();

    global $user_ID;

    $fchat_uploads = 0;
    if(rcl_get_option('fchat_upload') == 'yes') $fchat_uploads = 1;

    // получим чат
    $get_chat = rcl_chat_shortcode(array('chat_room'=>'fchat','userslist'=>1,'file_upload'=>$fchat_uploads,'in_page'=>30));
    //$get_chat = do_shortcode('[rcl-chat chat_room="fchat" userslist="1" file_upload="1" in_page="15"]');

    $content = '<div class="fc_title">'.rcl_get_option('fchat_name').'</div>';

    if(rcl_get_option('fchat_guest', 'yes') == 'yes'){  // гость может смотреть чат
        $content .= $get_chat;
    } else {                                            // гостю нельзя смотреть чат
        if($user_ID){
            $content .= $get_chat;
        } else {
            $content .= '<div class="chat-form">';
                $content .= '<div class="ynl-fc-box chat-notice"><span class="notice-error"></span></div>'; // поддержка допа you need to login
            $content .= '</div>';
            $content .= rcl_get_include_template('fchat-guest-info.php',__FILE__);  // подключаем шаблон
        }
    }

    wp_send_json(array(
        'content' => $content
    ));
}
rcl_ajax_action('fchat_load',true);



// token внутри функции rcl_chat_clear_beat('ZmNoYXQ=');
// берется из атрибута шорткод: chat_room="fchat"
//
// функция по клику гасит ajax запросы к чату
// клик по оверлею, по крестику
//
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



// функция вывода кнопки
function fchat_button($dop_class){
    if ( !rcl_exist_addon('rcl-chat') ) return false; // если не активен Rcl Chat (Чат)

    rcl_dialog_scripts();   // скрипты ssi

    if( rcl_get_option('fchat_upload') == 'yes' && is_user_logged_in() ) {  // в настройках разрешена загрузка файлов и залогинен
        rcl_fileupload_scripts();                                           // скрипты fileupload (загрузка файлов)
    }

    if( !$dop_class ) $dop_class = 'fc_manual';

    $txt = rcl_get_option('fchat_text','Float chat');
    $ico = rcl_get_option('fchat_ico','fa-laptop');

    $out = '<div class="fc_wrap '.$dop_class.'" style="display:none;">';
        $out .= '<div class="fc_bttn">';
            $out .= '<i class="rcli '.$ico.'"></i>';
            $out .= '<span class="fc_text">'.$txt.'</span>';
        $out .= '</div>';
    $out .= '</div>';

    return $out."\r\n";
}


// вывод автоматически
function fchat_auto(){
    if(rcl_get_option('fchat_button', 'auto') != 'auto') return false;

    echo fchat_button($dop_class = 'fc_float');
}
add_action('wp_footer','fchat_auto',5);


// вывод шорткодом [fchat_init]
function fchat_init_shortcode(){
    if(rcl_get_option('fchat_button', 'auto') == 'auto') return false; // если стоит авто вывод кнопки f-чата

    return fchat_button($dop_class = 'fc_manual');
}
add_shortcode('fchat_init','fchat_init_shortcode');



// инлайн стили
function fchat_inline_color($styles,$rgb){
    if( !rcl_exist_addon('rcl-chat') ) return $styles;

    $offset = rcl_get_option('fchat_pad', 0);

    if( rcl_get_option('fchat_button', 'auto') == 'auto' ){
        if( rcl_get_option('fchat_pos', 'top') == 'bottom' ){   // автоматический вывод кнопки и внизу
            $styles .= '.fc_wrap.fc_float{top:auto;}';

            if($offset){
                $styles .= '.fc_wrap.fc_float{bottom:'.$offset.'px;}';
            } else {
                $styles .= '.fc_wrap.fc_float{bottom:5px;}';
            }

        } else if ( rcl_get_option('fchat_pos', 'top') == 'top' ){
            if($offset){
                $styles .= '.fc_wrap.fc_float{top:'.$offset.'px;}';
            }
        }
    }


    list($r, $g, $b) = $rgb;
    $color = $r.','.$g.','.$b;

    $styles .= '
        .fc_wrap{
            background-color: rgb('.$color.');
        }
    ';

    if( !is_user_logged_in() ) return $styles;

    $styles .= '
        .fchat_dialog.ssi-modal .rcl-chat{
            background-color: rgba('.$color.',0.035);
        }
    ';


    return $styles;
}
add_filter('rcl_inline_styles','fchat_inline_color',10,2);
