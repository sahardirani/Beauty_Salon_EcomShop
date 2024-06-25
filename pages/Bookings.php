<?php
  include "../BackEnd/Common/setup.php"; 
  authentication();

  $page = 'Booking';
  role($page);

?>
<!DOCTYPE html>
<html>
<head>
 <!--   <link rel="stylesheet" href="../css/tables.css"> -->
    <link rel="stylesheet" href="../css/style.css"> 
    <title>Booking</title>
    <style>
   .row.header {
position: relative;

    }
   
table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

img {
    width: 50px;
    height: auto;
}
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="row1 header1 " >
<?php DisplayHeader(); ?>     
</div>


       <br>
       <br>
    





    
    <h2>Booking Data</h2>


    <?php

   

    $pdo = dbConnect();
    
    ?>


    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Username</th>
                <th>Last Name</th>
                <th>Date of Booking</th>
                <th>Time Booked</th>
                <th>Category</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
           <?php
          $stmt = $pdo->prepare("SELECT * FROM BOOKING WHERE BOOKING_DATE=CURDATE() AND STATUS=0  ORDER BY TIME ASC;");
          $stmt->execute();
          while ($row = $stmt->fetch()) {
          
              echo "<tr>";
              echo "<td>" . $row['EMAIL'] . "</td>";
              echo "<td>" . $row['FIRST_NAME'] . "</td>";
              echo "<td>" . $row['LAST_NAME'] . "</td>";
              echo "<td>" . $row['BOOKING_DATE'] . "</td>";
          
              $time = new DateTime($row['TIME']);
              echo "<td>" . $time->format("h:i A") . "</td>";
          
              echo "<td>" . $row['Service'] . "</td>";
              echo '<td><button data-id="' . $row['BOOK_ID'] . '" class="butn updateStatusBtn">Done</button></td>';
              echo "</tr>";
          
          }
          

?>
        </tbody>
    </table>

    <script>
    function deleteRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
    $(".updateStatusBtn").on("click", function() {
        var button = $(this);
        var bookingId = button.data("id");

        $.ajax({
            url: "../BackEnd/Models/BookMangment.php",
            type: "POST",
            data: { action: 'update_status', id: bookingId },
            success: function(response) {
                console.log("Response: ", response);
                if (response.trim() === "success") {
                    deleteRow(button[0]);
                    alert("Customer removed successfully!!");
                } else {
                    alert("Failed to update the booking status. Please try again.");
                }
            },
            error: function() {
                alert("An error occurred. Please try again.");
            }
        });

    });
</script>




</body>
</html>
