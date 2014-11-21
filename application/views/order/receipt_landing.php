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
</section><br>

<section class="closed-container">
  <a href="<?= base_url() ?>order/receipt/<?= $order->id?>">
    If you can't see the pop-up, click here to access that page directly.
  </a>
</section>
