<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <meta name="description" content="your first place to shop">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- asset imports -->
    <link rel="stylesheet" href="<?= base_url(); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>css/template.css">
    <link href='//fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

    <script src="<?= base_url(); ?>js/jquery.min.js"></script>
    <!-- form validation -->
    <script src="<?= base_url(); ?>js/jquery.validate.min.js"></script>
  </head>

  <body>
    <nav>
      <ul>
        <li>
          <a href="<?= base_url(); ?>">eStore</a>
        </li>
        <?php
          if ($this->session->userdata('signed_in')) {
            if ($this->MUser->isAdmin($this->session->userdata('login'))):
            // is admin
        ?>
              <li>
                <a href="<?= base_url(); ?>user">User List</a>
              </li>
              <li>
                <a href="<?= base_url(); ?>order">Order List</a>
              </li>
        <?php
            endif; // is signed in
        ?>
            <li>
              <a href="<?= base_url(); ?>user/logout">Sign out</a>
            </li>
        <?php
          } else { // not signed in
        ?>
            <li>
              <a href="<?= base_url(); ?>user/login">Sign in</a>
            </li>
        <?php
          }
        ?>
      </ul>
    </nav>

    <?php
      // flash notifications
      if ($this->session->flashdata('warning') ||
          $this->session->flashdata('info')) {
    ?>
      <br /><br />

      <?php
        if ($this->session->flashdata('warning')) {
      ?>
        <div class="alert alert-warning" role="alert">
          <?= $this->session->flashdata('warning') ?>
        </div>

      <?php
        }
        if ($this->session->flashdata('info')) {
      ?>
        <div class="alert alert-info" role="alert">
          <?= $this->session->flashdata('info') ?>
        </div>

    <?php
        }
      }
    ?>

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
  </body>
</html>
