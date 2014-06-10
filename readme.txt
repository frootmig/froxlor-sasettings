INSTALLATION
============

* MODULE:
1)	Unpak all files into a temporary directory
2)	Copy the "modules_*" files to /var/www/froxlor/ (or the directory where you installed Froxlor)
3)	Copy the "lib" directory to /var/www/froxlor/
4)	Copy the "templates" directory to /var/www/froxlor/
5)	Add the content of "english.lng.txt" to the end of /var/www/froxlor/lng/english.lng.php before ?>
6)	Add the content of "dutch.lng.txt" to the end of /var/www/froxlor/lng/dutch/lng.php before ?>
7)	Insert "sasettings.sql" into the Froxlor database 
8)	Insert "preferences.sql" into the Froxlor database

* SYSTEM:
9)	Install the following packages: (this list is for Debian lenny apt-get)
	spamassassin libmail-spf-query-perl libmailtools-perl libnet-dns-perl libdbi-perl
	libio-socket-ssl-perl libnet-ident-perl perl-modules pyzor razor spamc
10)	edit /etc/default/spamassassin and change the following lines (between the >>> and <<<):
	>>>
	ENABLED=1
	OPTIONS="--create-prefs --max-children 5 -q -x -u vmail"
	NICE="--nicelevel 10"
	<<<
11)	edit /etc/spamassassin/local.cf and add the following lines:
	>>>
	user_scores_dsn DBI:mysql:<SYSCP DATABASE>:localhost
	user_scores_sql_username <SYSCP USERNAME>
	user_scores_sql_password <SYSCP PASSWORD>
	user_scores_sql_custom_query SELECT preference, value FROM modules_sasettings_sa WHERE username = _USERNAME_ OR username = '$GLOBAL' OR 
username = 
	CONCAT('%',_DOMAIN_) ORDER BY username ASC

	#and if you use the debian dcc packages add
	#dcc_dccifd_path /var/lib/dcc/dccifd
	<<<
12)	modify the user vmail's homedirectory to /var/customers/mail
13)	login as user vmail and run the following commando's:
	razor-admin -d -register
	pyzor discover
14)	edit /etc/postfix/master.cf and change the folling line
	>>>
	smtp      inet  n       -       -       -       -       smtpd
	<<<        
	into
	>>>
	smtp      inet  n       -       -       -       -       smtpd
        	-o content_filter=spamassassin
	<<<
	OR use another way to include the spamassassin scanning to postfix (for example by Mailscanner)
15)	restart spamassassin
16)	restart postfix
