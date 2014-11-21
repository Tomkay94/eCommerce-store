<script>
  $(document).ready(function () {
    $("#pop-up").click(function() {
      window.open(
        '<?= base_url() ?>order/receipt/<?= $order->id?>',
        'receipt for order #<?= $order->id?>',
        'width=500; height=500;'
      );
    });
  });
</script>

<section class="closed-container">
  <a id="pop-up" href="#">
    Click here to view a pop-up printable version of your receipt.
  </a>
  <div>
    When pop-up is present, press Ctrl+P to trigger print command.
  </div>
</section><br>

<section class="closed-container">
  <a href="<?= base_url() ?>order/receipt/<?= $order->id?>">
    If you can't see the pop-up, click here to access that page directly.
  </a>
  <div>
    Here, you can also select the print option in the menu bar in the File section.
  </div>
</section>
