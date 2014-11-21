<script>
  $(document).ready(function () {
    $('#edit-form').validate({ // initialize the plugin
      rules: {
        first: {
          required: true
        },
        last: {
          required: true
        },
        pass: {
          required: true,
          minlength: 6
        },
        pass_conf: {
          equalTo: '#pass'
        }
      }
    });
  });
</script>

<section class="closed-container">
  
  <h2 class="container-header">Edit User #<?= $user->id ?></h2>

  <?= form_open("user/update/$user->id", "id='edit-form' role='form'") ?>
    <div class="form-group">
      <?= form_label('First Name') ?>
      <?= form_error('first') ?>
      <?= form_input('first', set_value('first', $user->first)) ?>
    </div>

    <div class="form-group">
      <?= form_label('Last Name') ?>
      <?= form_error('last') ?>
      <?= form_input('last', set_value('last', $user->last)) ?>
    </div>
  
    <div class="form-group">
      <?= form_label('New Password') ?>
      <?= form_error('pass') ?>
      <?= form_password('pass', "", "id='pass' required") ?>
    </div>

    <div class="form-group">
      <?= form_label('New Password Confirmation') ?>
      <?= form_error('pass_conf') ?>
      <?= form_password('pass_conf', "", "required") ?>
    </div>

    <?= form_submit('submit', 'Edit user', "class='btn btn-default'") ?>
  <?= form_close() ?>
  <br>

  <div>
    <?= anchor("user/show/$user->id",'Back to read only view') ?>
  </div>

</section>
