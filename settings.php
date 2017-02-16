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
                    $opt->help('<strong>"Автоматически"</strong>: Кнопка будет выведена слева вверху.<br/><br/><strong>"Выведу шорткодом"</strong>: вы сами вставите шорткод в нужное место (Например в текстовый виджет)'),

                    $opt->label('Возможность загружать файлы в чат:'),
                    $opt->option('select',array(
                        'name'=>'fchat_upload',
                        'default'=>'Нет',
                        'options'=>array('no'=>'Нет','yes'=>'Да',)
                    )),
                    $opt->notice('Пользователи получат возможность загрузки файлов в чат'),

                    $opt->label('Заголовок чата:'),
                    $opt->option('text', array('name' => 'fchat_name')),
                    $opt->notice('Например: "Чат"'),

                    $opt->label('Гости могут просматривать чат:'),
                    $opt->option('select',array(
                        'name'=>'fchat_guest',
                        'default'=>'Да',
                        'options'=>array(1 => 'Да', 0 => 'Нет',)
                    )),
                    $opt->help('Если выбрать "Нет", то гости не увидят чат, а увидят в всплывающем окне призыв "Войти на сайт"'),
                    $opt->notice('По умолчанию <strong>Да</strong>'),

                )
            )
        )
    );
    return $options;
}
add_filter('admin_options_wprecall','fc_settings');