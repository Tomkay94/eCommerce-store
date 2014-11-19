<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title; ?></title>
        <meta name="description" content="your first place to shop">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- asset imports -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>css/template.css">
    	<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="<?= base_url(); ?>">eStore</a></li>
                <li><a href="<?= base_url(); ?>user">User List</a></li>
                <li><a href="<?= base_url(); ?>user/register">Sign up</a></li>
            </ul>
        </nav>

        <div id="main">
            <?php $this->load->view($main); ?>
        </div>

        <div class="container">
		    <hr />
		    <!-- Footer -->
		    <footer>
		        <div class="row">
		            <div class="col-lg-12">
		                <p>Copyright &copy; eStore 2014</p>
		            </div>
		        </div>
		    </footer>
		</div>
        <!-- javascript imports -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/latest/jquery.min.js"></script>
    </body>
</html>
