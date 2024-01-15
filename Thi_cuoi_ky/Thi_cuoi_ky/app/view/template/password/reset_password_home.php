<link href="web/css/style_ps.css" rel="stylesheet">
<a href="home"><button><<</button><a>
<div class="container">

<table class="custom-table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Tên người dùng</th>
        <th>Mật khẩu mới</th>
        <th>action</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
            foreach($data['user_data'] as $key => $value) {
        ?>

       <tr>
        <form method="POST" action="password/confirm_password">
            <td><?php echo $count; ?></td>
            <td><?php echo $value->login_id; ?></td>
            <td>
                <div style="color: red;">
                    <?php
                        if (!empty($data['user_password_'.$value->id])){
                            echo $data['user_password_'.$value->id];
                        }
                    ?>
                </div>
                <input type="text" name="user_password_<?php echo $value->id; ?>">
            </td>
            <td><input type="submit" value = "RESET"></td>
        </form>
      </tr>

      <?php
      $count+=1;
            }
      ?>
    </tbody>
  </table>

</div>