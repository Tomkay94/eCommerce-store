<!-- Page Content -->
<script>
  // placed here since it's only used in this view
  $(document).ready(function () {
    $('#checkout-form').validate({ // initialize the plugin
      rules: {
        creditcard_number: {
          required: true,
          rangelength: [16, 16]
        },
        creditcard_month: {
          required: true,
          min: 1,
          max: 12
        },
        creditcard_year: {
          required: true,
          min: parseInt(new Date().getFullYear().toString().slice(-2)),
          max: 99
        }
      }
    });
  });
</script>

<section class="closed-container">
  <h2 class="container-header">Checkout</h2>

  <?= form_open('order/create', "id='checkout-form' role='form'") ?>
    <div class="form-group">
      <?= form_label('Creditcard Number (16 digits)')?>
      <?= form_error('creditcard_number')?>
      <?= form_input('creditcard_number', set_value('creditcard_number'),
                     "class='form-control'", "required")?>
    </div>

    <div class="form-group">
      <?= form_label('Creditcard Month (2 digits, MM)')?>
      <?= form_error('creditcard_month')?>
      <?= form_input('creditcard_month', set_value('creditcard_month'),
                     "class='form-control'", "required")?>
    </div>

    <div class="form-group">
      <?= form_label('Creditcard Year (2 digits YY)')?>
      <?= form_error('creditcard_year')?>
      <?= form_input('creditcard_year', set_value('creditcard_year'),
                     "class='form-control'", "required")?>
    </div>

    <strong>
      Number of Items:<?= $this->cart->total_items() ?>
    </strong><br>
    <strong>
      Total: $<?= $this->cart->total() ?>
    </strong><br><br>

    <?= form_submit('submit', 'Create Order', "class='btn btn-default'")?>
  <?= form_close()?>
</section>
