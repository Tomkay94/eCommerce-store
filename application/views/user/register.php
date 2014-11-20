<section class="closed-container">
  
  <h2 class="container-header">Sign up</h2>
  
  <?= form_open('user/create', "role='form'") ?>

    <div class="form-group">
      <?= form_error('login')?>
      <?= form_label('Username')?>
      <?= form_input('login', set_value('login'), "class='form-control'", "required")?>
    </div>

    <div class="form-group">
      <?= form_label('Email')?>
      <?= form_error('email')?>
      <?= form_input('email', set_value('email'), "class='form-control'", "required")?>
    </div>

    <div class="form-group">
      <?= form_error('first')?>
      <?= form_label('First Name')?> 
      <?= form_input('first', set_value('first'), "class='form-control'", "required")?>
    </div>

    <div class="form-group">
      <?= form_error('last')?>
      <?= form_label('Last Name')?> 
      <?= form_input('last', set_value('last'), "class='form-control'", "required")?>
    </div>

    <div class="form-group">
      <?= form_error('pass')?>
      <?= form_label('Password')?>
      <?= form_password('pass', "", "class='form-control'", "required")?>
    </div>

    <div class="form-group">
      <?= form_error('pass_conf')?>
      <?= form_label('Password Confirmation')?>
      <?= form_password('pass_conf', "", "class='form-control'", "required")?>
    </div>

    <br>
    <?= form_submit('submit', 'Register', "class='btn btn-default'")?>
  
  <?= form_close()?>
</section>