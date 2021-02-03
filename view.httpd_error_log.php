<?php
//this expects (obviously) PHP. It also needs the read-bit set on the log file for group

//get the last 20 lines, reverse sort, newest on the top
$statement = "tail -20 /var/log/httpd/error_log | sort -r";
$errorlines = preg_split( '/[\r\n]+/', shell_exec( $statement ));
array_pop( $errorlines );
//echo "<pre>errorlines:"; print_r( $errorlines ); echo "</pre>";

#we want the first line to be bold
$FIRST_LINE_BOLD=true;

//provide the current server date and time
$server_datetime=time();
echo "Server date and time: <b>" . ( date("Y-m-d H:i:s e", $server_datetime )) . "</b><br /><br />";

//provide current user date and time
date_default_timezone_set("America/New_York");
$user_datetime=time();
echo "User date and time: <b>" . ( date("Y-m-d H:i:s e", $user_datetime )) . "</b><br />";


foreach( $errorlines as $line ){
    if ( $FIRST_LINE_BOLD ) {
        echo '<br /><hr /><br /><span style="color:red"><b>' . $line . '</b></span><br />';
        $FIRST_LINE_BOLD=false;
    } else {
        echo $line . '<br />';
    }
}
echo '<hr /><h2><a href="javascript:window.close();">Close</a></h2>';

?>

