<?php

/**
 * Load All customizer controller dynamically...
 */

if (getCynicOptionsVal('theme_mode') == 2) {
    $customizer_dir = CYNIC_THEME_CORE_INCLUDES . '/customizations';
    if (is_dir($customizer_dir) && $cc_dirhandle = opendir($customizer_dir)) {
        while ($cc_file = readdir($cc_dirhandle)) {
            if (!in_array($cc_file, array('.', '..'))) {
                $cfile = explode('.', $customizer_dir . '/' . $cc_file);
                require_once wp_normalize_path($customizer_dir . '/' . $cc_file);
            }
        }
    }
}