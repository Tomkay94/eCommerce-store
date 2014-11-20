<section class="closed-container">

  <?php
    echo anchor("user/delete_all", 'Delete all users and their orders (except Admin)',
                  "onClick='return confirm(".
                    '"DANGER: You are about to delete all users and their orders"'.
                  ");'")
  ?>
  <br>

  <h2 class="container-header">User Table</h2>

  <table class="table">
    <thead>
      <tr>
        <th>id</th>
        <th>login</th>
        <th>first name</th>
        <th>last name</th>
        <th>email</th>
      </tr>
    </thead>
  <?php
    foreach ($users as $user) {
      if ($this->MUser->isAdmin($user->login)) {
        continue;
      }
      echo "<tr>";
      echo "<td>" . $user->id . "</td>";
      echo "<td>" . $user->login . "</td>";
      echo "<td>" . $user->first . "</td>";
      echo "<td>" . $user->last . "</td>";
      echo "<td>" . $user->email . "</td>";

      echo "<td>" . anchor("user/show/$user->id", 'Show') . "</td>";
      echo "<td>" . anchor("user/edit/$user->id", 'Edit') . "</td>";
      echo "<td>" . anchor("user/delete/$user->id", 'Delete',
                            "onClick='return confirm(".
                              '"Do you really want to delete this record?"'.
                            ");'"
                          ) . "</td>";
      echo "</tr>";
    }
  ?>
  </table>
</section><!-- ./closed-container -->
