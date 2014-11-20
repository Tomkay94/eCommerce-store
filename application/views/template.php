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
          <?php if ($this->session->userdata('signed_in') && 
                    $this->MUser->isAdmin($this->session->userdata('login'))):  ?>
            <li><a href="<?= base_url(); ?>user">User List</a></li>
          <? endif ?>
          <?php if ($this->session->userdata('signed_in')): ?>
            <li><a href="<?= base_url(); ?>user/logout">Sign out</a></li>
          <? else: ?>
            <li><a href="<?= base_url(); ?>user/login">Sign in</a></li>
          <? endif ?>
        </ul>
      </nav>

      <?php 
        if ($this->session->flashdata('warning') || 
            $this->session->flashdata('info')) {
      ?>
      <br /><br />
      <?php if ($this->session->flashdata('warning')): ?>
        <div class="alert alert-warning" role="alert">
          <?= $this->session->flashdata('warning') ?>
        </div>
      <?php endif;
        if ($this->session->flashdata('info')): ?>
          <div class="alert alert-info" role="alert">
            <?= $this->session->flashdata('info') ?>
          </div>
      <?php
          endif;
        } ?>
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
