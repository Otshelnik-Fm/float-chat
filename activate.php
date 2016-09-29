<?php

global $rcl_options;

if(!isset($rcl_options['fchat_button'])) $rcl_options['fchat_button'] = 'auto';

update_option('rcl_global_options',$rcl_options);