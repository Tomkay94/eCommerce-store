<section class="closed-container">
  <h2 class="container-header">User #<?= $user->id ?></h2>

  <table class="table">
    <thead>
      <tr>
        <th>username</th>
        <th>first name</th>
        <th>last name</th>
        <th>email</th>
      </tr>
    </thead>
    <tr>
      <td><?= $user->login ?></td>
      <td><?= $user->first ?></td>
      <td><?= $user->last ?></td>
      <td><?= $user->email ?></td>
      <td><?= anchor("user/edit/$user->id", 'Edit') ?></td>
      <td><?= anchor("user/delete/$user->id", 'Delete',
                      "onClick='return confirm(".
                        '"Do you really want to delete this record?"'.
                      ");'"
                    );
          ?>
      </td>
    </tr>
  </table>
</section><!-- ./closed-container -->
