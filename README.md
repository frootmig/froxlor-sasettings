froxlor-sasettings
==================

The SysCP SpamAssassin Plugin revised for [froxlor Server Management Panel](http://www.froxlor.org/).

During one of the last froxlor updates the old SysCP SpamAssassin module broke, due to the new database layer and the missing variable $db. I changed all the calls to $db to the new API and applied all other changes needed for this plugin to work again.
