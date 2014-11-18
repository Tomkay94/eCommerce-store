<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title; ?></title>
        <meta name="description" content="your first place to shop">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?=  base_url(); ?>css/template.css">
    </head>
    <body>
        <div id="header">
            header
        </div>

        <div id="nav">
            navigation
        </div>

        <div id="main">
            <?php $this->load->view($main); ?>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/latest/jquery.min.js"></script>
    </body>
</html>
