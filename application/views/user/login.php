<script>
  // placed here since it's only used in this view
  $(document).ready(function () {
    $('#login-form').validate({ // initialize the plugin
      rules: {
        login: {
          required: true
        },
        pass: {
          required: true
        }
      }
    });
  });
</script>

<section class="closed-container">
  
  <h2 class="container-header">Sign in</h2>
  
  <?= form_open('user/process_login', "id='login-form' role='form'") ?>
    <div class="form-group">
      <?= form_error('login')?>
      <?= form_label('Username')?>
      <?= form_input('login', set_value('login'), "class='form-control'", "required")?>
    </div>

    <div class="form-group">
      <?= form_error('pass')?>
      <?= form_label('Password')?>
      <?= form_password('pass', "", "class='form-control'", "required")?>
    </div>

    <br>
    <?= form_submit('submit', 'Sign in', "class='btn btn-default'")?>
  <?= form_close()?>

  <br>
  <div>
    New users please <?= anchor('user/register','register here') ?>.
  </div>

</section>
