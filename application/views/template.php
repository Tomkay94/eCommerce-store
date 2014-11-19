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
        <header>
            <h2 id="main-title">
                <a href="<?=  base_url(); ?>">eStore</a>
            </h2>
            <div class="user-bar">
                <a href="<?=  base_url(); ?>user/register">Sign up</a>
            </div>
        </header>

        <nav>
            <h3>Navigation</h3>
            <ul>
                <li><a href="<?=  base_url(); ?>">Store Front</a></li>
                <!-- if admin -->
                <li><a href="<?=  base_url(); ?>user">User List</a></li>
            </ul>
        </nav>

        <div id="main">
            <?php $this->load->view($main); ?>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/latest/jquery.min.js"></script>
    </body>
</html>
