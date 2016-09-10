<?php

function fc_settings($options){

    $fc_warning = '<span class="adm_warn adm_b18">Эта настройка не будет работать!</span><br/>';
    $fc_link = 'Перейдите на страницу <a href="' .home_url('/wp-admin/admin.php?page=manage-addon-recall'). '" '
               . 'title="Перейти к странице управления дополнениями"> управления дополнениями</a><br/>и активируйте ';

    $fc_message = '';
    if (!function_exists('rcl_insert_chat')){   // если не активен Чат
    $fc_message = $fc_warning.'<span class="adm_warn adm_b14">- У вас не активирован Чат!</span><br/>'
                 .$fc_link. 'Rcl Chat (Чат)<br/>';
    }

    $opt = new Rcl_Options(__FILE__);
    $options .= $opt->options(
        'Настройки Float Chat',array(
            $opt->option_block(
                array(
                    $opt->title('Вывод кнопки чата:'),
                    '<div>'.$fc_message.'</div>',
                    $opt->option('select',array(
                        'name'=>'fchat_button',
                        'default'=>'Автоматически',
                        'options'=>array('auto'=>'Автоматически','manual'=>'Выведу шорткодом',)
                    )),
                    $opt->help('"Автоматически": Кнопка будет выведена слева вверху.<br/><br/>"Выведу шорткодом": вы сами вставите шорткод в нужное место (Например в текстовый виджет)'),
                )
            )
        )
    );
    return $options;
}
add_filter('admin_options_wprecall','fc_settings');