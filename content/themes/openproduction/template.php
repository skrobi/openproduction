<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo @$title; ?></title>

        <?php echo @$metadata; ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <?php echo @$css_files . "\n"; ?>
        <?php echo @$js_files . "\n"; ?>
    </head>

    <body class="horizontal-navigation" dir="<?php echo $language['direction']; ?>">
        <?php echo @$layout . "\n"; ?>


    </body>
</html>