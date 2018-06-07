<?php
//first we need to delete some old backup file
exec('find /var/backup/ -type d -ctime +7 -exec rm -rf {} \;');
//we need to take daily back up
date_default_timezone_set("UTC");           

chdir('/var/backup');
$folderName=date('Y-m-d')."_BackUp";
exec("mkdir $folderName");
exec("zip -r /var/backup/$folderName/webanalysisFileBK_".date('Y-m-d').".zip /var/www");
exec("mysqldump -u webanal -p'34&TwgrweDFwe4%' webanalysis | gzip -9 > /var/backup/$folderName/webanalysisBK_".date('Y-m-d').".sql.gz");
?>