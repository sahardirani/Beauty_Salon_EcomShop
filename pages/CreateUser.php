<?php
require_once '../BackEnd/Common/setup.php';
require_once '../FE/Controls/AdminActions.php';

authentication();
$page = 'CreateUsers';
role($page);

?>
<html>
    <head>
        <link rel="stylesheet" href="../css/style.css"> 
        <link rel="stylesheet" href="../css/plug.css"> 
        <link rel="stylesheet" href="../css/tables.css">
        <title>
            Create User 
        </title>
       
    </head>
    <body>
        
    <div class="row1 header1 " >
<?php DisplayHeader(); ?>     
</div>


       <br>
       <br>
       <h2>Create Users:</h2>



       
   <form action="SignIN.php" method ='POST'>

       <div id="SignIN-form">  

       <label for="username">Username:</label>
       <input type="text" id="username" name="username"><br><br>
       
       <label for="password">Password:</label>
       <input type="password" id="password" name="password"><br><br>

       <label for="role">Role:</label>

       <select id="role" name="role">
       <option value="executive">Executive</option>
       <option value="receptionist">Receptionist</option>
       <option value="shopper">Shopper</option>
       </select>

       <input type='submit' value='Create' class="butn">
       </div>

   </form>


   <h2>Activity Moniter:</h2>
   <table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Status</th>
    </tr>
    <?php
      $data =  AdminUsers();
      foreach ($data as $row): 
     ?>
        <tr>
            <td><?= htmlspecialchars($row['ID']) ?></td>
            <td><?= htmlspecialchars($row['USERNAME']) ?></td>
            <td>
                <label class="switch">
                <input type="checkbox" id="user-toggle-<?= htmlspecialchars($row['ID']) ?>" data-id="<?= htmlspecialchars($row['ID']) ?>" <?= $row['ACTIVITY'] == 1 ? 'checked' : '' ?>>

                    <span class="slider round"></span>
                </label>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php addUsers();?>


</body>
</html>