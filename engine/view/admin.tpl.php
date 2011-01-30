<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html class="js" dir="ltr" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="alternate" type="application/rss+xml" title="Orange demo RSS" href="http://drupal.amandarodriguez.com/rss.xml">
        <link rel="shortcut icon" href="http://drupal.amandarodriguez.com/misc/favicon.ico" type="image/x-icon">
        <title>[% $Title %]</title>
        <link type="text/css" rel="stylesheet" media="all" href="[% $SYS_FOLDER %]themes/admin.css">
    </head>

    <body class="anonymous-user right">

        <div id="wrapper">
            [%include file='view/test/header-top.tpl.php'%]
            [%include file='view/test/header.tpl.php'%]


            <div id="container">
                [%include file='view/test/content-top.tpl.php'%]
                [% $main %]
                [%include file='view/test/sidebar.tpl.php'%]
                <div class="clear"> </div>
                [%include file='view/test/content-bottom.tpl.php'%]
            </div>
        </div> <!-- end wrapper -->

        <div id="footer">
          [%include file='view/test/footer.tpl.php'%]
        </div> <!-- end footer -->

    </body>

</html>