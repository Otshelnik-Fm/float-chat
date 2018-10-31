<?php

function fc_settings($options){

    $fc_warning = '<span class="adm_warn adm_b16">Эти настройки не будут работать!</span><br/>';
    $fc_link = '<br/>Перейдите на страницу <a href="' .home_url('/wp-admin/admin.php?page=manage-addon-recall'). '" '
               . 'title="Перейти к странице управления дополнениями"> управления дополнениями</a><br/>и активируйте ';

    $fc_message = '';
    if ( !rcl_exist_addon('rcl-chat') ){   // если не активен Чат
    $fc_message = $fc_warning.'<span class="adm_warn adm_b14">- У вас не активирован Чат!</span><br/>'
                 .$fc_link. 'Rcl Chat (Чат)<br/>';
    }

    $opt = new Rcl_Options(__FILE__);
    $options .= $opt->options('Настройки Float Chat',array(
            $opt->options_box('Кнопка',
                    array(
                        array(
                            'type' => 'custom',
                            'content'=>$fc_message
                        ),

                        array(
                            'title'=>'Вывод кнопки чата:',
                            'type' => 'select',
                            'slug' => 'fchat_button',
                            'values'=> array('auto'=>'Автоматически','manual'=>'Выведу шорткодом или вручную'),
                            'help' => '<strong>"Автоматически"</strong>: Кнопка будет выведена слева вверху.<br/><br/>'
                                      . '<strong>"Выведу шорткодом"</strong>: вы сами вставите шорткод в нужное место '
                                      . '(Например в текстовый виджет). Эта же опция подходит для ручного вывода (через HTML)',
                            'notice' => 'По умолчанию: Автоматически<hr>',
                            'childrens' => array(
                                'auto' => array(
                                    array(
                                        'title'=>'Положение кнопки:',
                                        'type' => 'select',
                                        'slug' => 'fchat_pos',
                                        'values'=> array('top'=>'Слева вверху','bottom'=>'Слева внизу'),
                                        'notice'=>'По умолчанию: Слева вверху<hr>'
                                    ),
                                    array(
                                        'title'=>'Отступ от выбранного края:',
                                        'type' => 'number',
                                        'slug' => 'fchat_pad',
                                        'help' => 'Опция позволяет выбрать отступ от ближнего выбранного края.<br><br>'
                                                  . 'Это значит: что выбрав "Положение кнопки"=>"Слева вверху" - вы будете задавать верхний отступ.<br>'
                                                  . 'А при опции "Слева внизу" - вы будет выставлять значение в пикселях от нижнего края, поднимая кнопку.',
                                        'notice' => 'В пикселях<br>Выставляя значение - убедитесь, что на мобильных "не убежала" кнопка<hr>'
                                    )
                                )
                            )
                        ),

                        array(
                            'title'=>'Текст кнопки:',
                            'type' => 'text',
                            'slug' => 'fchat_text',
                            'notice' => 'По умолчанию: "Float chat"'
                        ),

                        array(
                            'title'=>'Иконка кнопки:',
                            'type' => 'text',
                            'slug' => 'fchat_ico',
                            'notice' => 'По умолчанию: "fa-laptop"',
                            'help' => 'Иконку выбираем <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank">здесь</a><br>'
                                      . 'Вписываем так: fa-telegram'
                        ),
                    )
            ),

            $opt->options_box('Чат',
                    array(
                        array(
                            'title'=>'Возможность загружать файлы в чат:',
                            'type' => 'select',
                            'slug' => 'fchat_upload',
                            'values'=> array('no'=>'Нет','yes'=>'Да'),
                            'notice' => 'Пользователи получат возможность загрузки файлов в чат'
                        ),

                        array(
                            'title'=>'Заголовок чата:',
                            'type' => 'text',
                            'slug' => 'fchat_name',
                            'notice' => 'Например: "Чат"'
                        ),

                        array(
                            'title'=>'Гости могут видеть последние сообщения в чате:',
                            'type' => 'select',
                            'slug' => 'fchat_guest',
                            'values'=> array('yes' => 'Да', 'no' => 'Нет'),
                            'help' => 'Если выбрать "Нет", то гости не увидят чат, а увидят в всплывающем окне призыв "Войти на сайт"',
                            'notice' => 'По умолчанию <strong>Да</strong>'
                        ),
                    )
            )
        )
    );
    return $options;
}
add_filter('admin_options_wprecall','fc_settings');