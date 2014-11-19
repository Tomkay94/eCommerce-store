<section class="closed-container">
  
  <h2 class="container-header">User Table</h2>

  <table>
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