#
# Daten für Tabelle `modules_sasettings_desc`
#

INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (1, 'Deutsch', 'Grenze zwischen Spam und Ham', 'Um fest zu stellen, ob eine Mail Spam  oder Ham (normale Mails) ist, werden viele verschieden Tests durchgeführt. Ist ein Test positiv, erhöhen sich die Punkte um einen bestimmten Wert.\r\nMit dieser Punktegrenze können sie festlegen, ab welchem Wert eine Mail als Spam deklariert wird. <br />Erniedrigen Sie den Wert, werden Mails schneller als Spam erkannt.<br />\r\nErhöhen Sie den Wert um Falscherkennungen zu vermeiden.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (2, 'Deutsch', 'verwendete Sprachen', 'Geben Sie hier ihre verwendeten Sprachen an. Für Mails in anderen Sprachen steigt die Spam-Wahrscheinlichkeit!\r\n<br /><br /><dl>\r\n<dt>all</dt><dd>alle Sprachen erlauben</dd> \r\n<dt>en</dt><dd>Englisch</dd> \r\n<dt>de</dt><dd>Deutsch</dd> \r\n<dt>fr</dt><dd> French</dd> \r\n<dt>zh</dt><dd>Chinese</dd> \r\n<br />\r\nWeitere Sprachen sind <a href="http://spamassassin.apache.org/full/3.0.x/dist/doc/Mail_SpamAssassin_Conf.html#language_options"  target="_blank">hier</a> zu finden.  \r\n<br />\r\nDer Eintrag für Deutsch und Englisch lautet z.B. "en,de" ohne "".');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (2, 'English', 'your used languages', 'Fill in here your used languages. For mails in other languages the spam-probability will be increased.\r\n<br /><br />\r\n<dl>\r\n<dt>all</dt><dd>allow all languages</dd> \r\n<dt>en</dt><dd>english</dd> \r\n<dt>de</dt><dd>german</dd> \r\n<dt>fr</dt><dd> french</dd> \r\n<dt>zh</dt><dd>chinese</dd> \r\n<br />\r\nYou can find further languages <a href="http://spamassassin.apache.org/full/3.0.x/dist/doc/Mail_SpamAssassin_Conf.html#language_options"  target="_blank">here.</a> \r\n<br />\r\nFor example the entry for english and german would be "en,de" without "".');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (1, 'English', 'border between spam and ham', 'There are done many different tests to decide, if a mail is spam or ham (normal mail). Is a test positiv, the points for a mail are going to be increased by a specific value. With this preference  you can set the border above where the mail is declared as spam.<br />Lower the value to make the spamfilter more aggressiv.<br />\r\nIncrease the value for more relaxed filtering and avoid false-positives.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (3, 'English', 'use razor', 'With this preference you can control, if<a href="http://razor.sourceforge.net/" target="_blank">razor</a> should be used.\r\n\r\nWith razor\'s help incoming mails will be compared with already identified spam mails. If a comparison is positiv, the spampoints of the incoming mail will be increased.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (3, 'Deutsch', 'benutze razor', 'Mit dieser Option kann kontrolliert werden, ob <a href="http://razor.sourceforge.net/" target="_blank">razor</a> benutzt werden soll.\r\n\r\nMit der Hilfe von razor wird ein hereinkommendes Mail mit bereits bekannten Spam Mails verglichen. Bei einer Übereinstimmung werden die Spampunkte dieser Mail erhöht.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (4, 'English', 'use pyzor', 'With this preference you can control, if<a href="http://pyzor.sourceforge.net/" target="_blank">pyzor</a> should be used.\r\n\r\nWith pyzor\'s help incoming mails will be compared with already identified spam mails. If a comparison is positiv, the spampoints of the incoming mail will be increased.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (4, 'Deutsch', 'benutze pyzor', 'Mit dieser Option kann kontrolliert werden, ob <a href="http://pyzor.sourceforge.net/" target="_blank">pyzor</a> benutzt werden soll.\r\n\r\nMit der Hilfe von pyzor wird ein hereinkommendes Mail mit bereits bekannten Spam Mails verglichen. Bei einer Übereinstimmung werden die Spampunkte dieser Mail erhöht.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (5, 'English', 'use dcc', 'With this preference you can control, if <a href="http://www.rhyolite.com/anti-spam/dcc/" target="_blank">dcc</a> should be used.\r\n\r\ndcc stands for Distributed Checksum Clearinghouse. With its help incoming mails will be compared with already identified spam mails. If a comparison is positiv, the spampoints of the incoming mail will be increased.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (5, 'Deutsch', 'benutze dcc', 'Mit dieser Option kann kontrolliert werden, ob <a href="http://www.rhyolite.com/anti-spam/dcc/" target="_blank">dcc</a> benutzt werden soll.\r\n\r\ndcc steht für Distributed Checksum Clearinghouse. Mit der Hilfe von dcc wird ein hereinkommendes Mail mit bereits bekannten Spam Mails verglichen. Bei einer Übereinstimmung werden die Spampunkte dieser Mail erhöht.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (1, 'Chinese', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (1, 'Francais', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (2, 'Chinese', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (2, 'Francais', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (3, 'Chinese', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (3, 'Francais', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (4, 'Chinese', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (4, 'Francais', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (5, 'Chinese', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (5, 'Francais', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (6, 'Deutsch', 'benutze den Bayes-Filter', 'Mit dieser Option können sie kontrollieren, ob sie den Bayes-Filter von SpamAssassin benutzen wollen. Dies ist die Master on/off Einstellung für alle Optionen bezüglich dem Bayes-Filter.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (6, 'English', 'use Bayesian-stlye filter', 'With this preference you can decide, whether to use the naive-Bayesian-style classifier built into SpamAssassin. This is a master on/off switch for all Bayes-related operations.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (6, 'Francais', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (6, 'Chinese', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (7, 'Deutsch', 'Automatisches Lernen', 'Soll SpamAssassin Mails mit vielen Spam-Punkten (oder Mails mit wenig Spam-Punkten, für no-Spam) automatisch zum Trainieren des Bayes-Filter verwenden.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (7, 'English', 'automatic learning', 'Whether SpamAssassin should automatically feed high-scoring mails (or low-scoring mails, for non-spam) into its  naive-Bayesian-style learning systems.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (7, 'Francais', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (7, 'Chinese', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (8, 'Deutsch', 'maile Spam als Anhang', 'Ist diese Option <b>1</b>, wird für eine Spam-Mail eine neue Report-Mail erstellt, der die originale Spam-Mail als message/rfc822 MIME Anhang angehängt. (so dass die original  e Mail unverändert bleibt). \r\n<br  /><br />\r\nIst diese Option <b>2</b>, dann wird die Spam-Mail als  text/plain Anhang anstatt  dem message/rfc822 Anhang angehängt. Diese Option kann bei schlechten Mail Clients notwendig sein, die automatisch Anhänge von Mails öffnen, ohne die Interaktion mit dem User. Diese Option kann es etwas schwieriger machen, die original-Mail zu lesen.\r\n<br /><br />\r\nIst diese Option <b>0</b>, werden Spam Mails nur die X-Spam-headers hinzugefügt und ansonsten nichts an der Mail verändert, so dass sie die Mail normal erhalten.');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (8, 'English', 'mail spam as attachment', 'If this option is set to <b>1</b>, if an incoming message is tagged as spam, instead of modifying the original message, SpamAssassin will create a new report message and attach the original message as a message/rfc822 MIME part (ensuring the original message is completely preserved, not easily opened, and easier to recover). \r\n<br  /><br />\r\nIf this option is set to <b>2</b>, then original messages will be attached with a content type of text/plain instead of message/rfc822. This setting may be required for safety reasons on certain broken mail clients that automatically load attachments without any action by the user. This setting may also make it somewhat more difficult to extract or view the original message.\r\n<br /><br />\r\nIf this option is set to <b>0</b>, incoming spam is only modified by adding some X-Spam-headers and no changes will be made to the body. In addition, a header named X-Spam-Report will be added to spam. ');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (8, 'Francais', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (8, 'Chinese', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (9, 'Deutsch', 'aendere den Betreff von Spam', 'Per default, wird bei erkannten Spam-Mails der Betreff nicht verändert. (sowie das An: und Von: Feld). Mit setzen dieser Option wird jede Spam-Mail mit ihren Text markiert, um anzuzeigen, dass diese Spam ist. Der angegebene Text wird dem Betreff der Mail vorangestellt.<br />\r\n<br />\r\nDieses Beispiel fügt SPAM am Beginn des Betreffs jeder Spam-Mail ein:<br />\r\nsubject SPAM');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (9, 'English', 'change subject for spam', 'By default, suspected spam messages will not have the Subject, From or To lines tagged to indicate spam. By setting this option, the header will be tagged with YOUR STRING to indicate that a message is spam. For the Subject header, this will be prepended to the original subject.\r\n<br />\r\n<br />\r\nThis example will prepend "SPAM" to each subject of spam-mails: <br />\r\nsubject SPAM');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (9, 'Francais', '', '');
INSERT INTO modules_sasettings_desc (preferenceid, language, desc_short, desc_long) VALUES (9, 'Chinese', '', '');


#
# Daten für Tabelle `modules_sasettings_preferences`
#

INSERT INTO modules_sasettings_preferences (preferenceid, preferencename, used, type, enum_settings, maxsize) VALUES (1, 'required_hits', 'Y', 'float', '', 30);
INSERT INTO modules_sasettings_preferences (preferenceid, preferencename, used, type, enum_settings, maxsize) VALUES (2, 'ok_languages', 'Y', 'string', '', 30);
INSERT INTO modules_sasettings_preferences (preferenceid, preferencename, used, type, enum_settings, maxsize) VALUES (3, 'use_razor2', 'Y', 'boolean', '', 30);
INSERT INTO modules_sasettings_preferences (preferenceid, preferencename, used, type, enum_settings, maxsize) VALUES (4, 'use_pyzor', 'Y', 'boolean', '', 30);
INSERT INTO modules_sasettings_preferences (preferenceid, preferencename, used, type, enum_settings, maxsize) VALUES (5, 'use_dcc', 'N', 'boolean', '', 30);
INSERT INTO modules_sasettings_preferences (preferenceid, preferencename, used, type, enum_settings, maxsize) VALUES (6, 'use_bayes', 'Y', 'boolean', '', 30);
INSERT INTO modules_sasettings_preferences (preferenceid, preferencename, used, type, enum_settings, maxsize) VALUES (7, 'bayes_auto_learn', 'Y', 'boolean', '', 30);
INSERT INTO modules_sasettings_preferences (preferenceid, preferencename, used, type, enum_settings, maxsize) VALUES (8, 'report_safe', 'Y', 'enum', '\'0\',\'1\',\'2\'', 30);
INSERT INTO modules_sasettings_preferences (preferenceid, preferencename, used, type, enum_settings, maxsize) VALUES (9, 'rewrite_header', 'Y', 'string', '', 30);


-- 
-- Daten für Tabelle `modules_sasettings_rights`
-- 

INSERT INTO `modules_sasettings_rights` (`domainid`, `preferenceid`, `available`) VALUES (0, 1, 'Y');
INSERT INTO `modules_sasettings_rights` (`domainid`, `preferenceid`, `available`) VALUES (0, 3, 'Y');
INSERT INTO `modules_sasettings_rights` (`domainid`, `preferenceid`, `available`) VALUES (0, 2, 'Y');
INSERT INTO `modules_sasettings_rights` (`domainid`, `preferenceid`, `available`) VALUES (0, 4, 'Y');
INSERT INTO `modules_sasettings_rights` (`domainid`, `preferenceid`, `available`) VALUES (0, 6, 'Y');
INSERT INTO `modules_sasettings_rights` (`domainid`, `preferenceid`, `available`) VALUES (0, 7, 'Y');
INSERT INTO `modules_sasettings_rights` (`domainid`, `preferenceid`, `available`) VALUES (0, 8, 'Y');
INSERT INTO `modules_sasettings_rights` (`domainid`, `preferenceid`, `available`) VALUES (0, 9, 'Y');

-- 
-- Daten für Tabelle `modules_sasettings_sa`
-- 

INSERT INTO `modules_sasettings_sa` (`username`, `preference`, `value`) VALUES ('$GLOBAL', 'required_hits', '6.5');
INSERT INTO `modules_sasettings_sa` (`username`, `preference`, `value`) VALUES ('$GLOBAL', 'ok_languages', 'en,de');
INSERT INTO `modules_sasettings_sa` (`username`, `preference`, `value`) VALUES ('$GLOBAL', 'use_razor2', '1');
INSERT INTO `modules_sasettings_sa` (`username`, `preference`, `value`) VALUES ('$GLOBAL', 'use_pyzor', '0');
INSERT INTO modules_sasettings_sa (username, preference, value) VALUES ('$GLOBAL', 'rewrite_header', 'subject');
INSERT INTO modules_sasettings_sa (username, preference, value) VALUES ('$GLOBAL', 'report_safe', '1');
INSERT INTO modules_sasettings_sa (username, preference, value) VALUES ('$GLOBAL', 'bayes_auto_learn', '1');
INSERT INTO modules_sasettings_sa (username, preference, value) VALUES ('$GLOBAL', 'use_bayes', '1');

