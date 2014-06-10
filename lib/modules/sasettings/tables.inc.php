<?php
// Contains information about all current SpamAssassin-
// settings:
// global defaults, domain-wide settings and user specified settings
// columns: username, preference, value
define('TABLE_MODULES_SASETTINGS_SA','modules_sasettings_sa');

// Contains information about the available SpamAssassin-
// options which can be chosen
// columns: preference-id, preference-name, type, enum_settings, maxsize
define('TABLE_MODULES_SASETTINGS_PREFERENCES','modules_sasettings_preferences');

// Contains descriptions for each option in each language
// uses 'eng' as fallback if no entry is present
// columns: id, preference-id, language, desc_short, desc
define('TABLE_MODULES_SASETTINGS_DESC','modules_sasettings_desc');

// Defines which options are available to which customers
// columns: id, domain-id, preference-id, available
define('TABLE_MODULES_SASETTINGS_RIGHTS','modules_sasettings_rights');
?>
