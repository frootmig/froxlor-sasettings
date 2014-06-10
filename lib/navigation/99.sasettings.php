<?php
return array (
        'admin' => array (
                'spam_assassin' => array (
                        'label' => $lng['modules']['sasettings']['title'],
                        'show_element' => true,
                        'elements' => array (
                                array (
                                        'url' => 'modules_admin_sasettings.php?page=global',
                                        'label' => $lng['modules']['sasettings']['globaltitle'],
                                ),
                                array (
                                        'url' => 'modules_admin_sasettings.php?page=domains',
                                        'label' => $lng['modules']['sasettings']['domainstitle'],
                                ),
                                array (
                                        'url' => 'modules_admin_sasettings.php?page=prefs',
                                        'label' => $lng['modules']['sasettings']['preftitle'],
                                ),
                        ),
                ),
        ),
        'customer' => array (
                'email' => array (
                        'elements' => array (
                                array (
                                        'url' => 'modules_customer_sasettings.php',
                                        'label' => $lng['modules']['sasettings']['title'],
			), 
                        ),
                ),
        ),

);
?>

