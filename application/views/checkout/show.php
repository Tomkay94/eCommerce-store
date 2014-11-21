<!-- Page Content -->
<section class="closed-container">
  <h2 class="container-header">Checkout</h2>

  <?= form_open('order/create', "role='form'") ?>
    <div class="form-group">
      <?= form_label('Creditcard Number (16 digits)')?>
      <?= form_error('creditcard_number')?>
      <?= form_input('creditcard_number', set_value('creditcard_number'),
                     "class='form-control'", "required")?>
    </div>

    <div class="form-group">
      <?= form_label('Creditcard Month (2 digits)')?>
      <?= form_error('creditcard_month')?>
      <?= form_input('creditcard_month', set_value('creditcard_month'),
                     "class='form-control'", "required")?>
    </div>

    <div class="form-group">
      <?= form_label('Creditcard Year (2 digits)')?>
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