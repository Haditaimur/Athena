



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">



    <title>Check-in's</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link rel="shortcut icon" href="YYY.PNG" type="image/x-icon">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="transition.css">
    
    
    

    <?php

try {
    require_once('config.php');

    if(isset($_POST['submit'])) {
        $search_date = $_POST['search_date'];
      }
      if(isset($_POST['submit'])) {
        // Search form has been submitted, retrieve data for the specified date
        $sql = "SELECT * FROM details WHERE DATE(date) = :search_date";

      } else {
        // Search form has not been submitted, retrieve data for the current day
        $current_date = date('Y-m-d');
        $sql = "SELECT * FROM details WHERE DATE(date) = :current_date";
      }
      
      $rows = $pdo->prepare($sql);
      
      if(isset($_POST['submit'])) {
        $count = $rows->rowCount();
        $rows->bindParam(':search_date', $search_date);
        
      } else {
        $count = $rows->rowCount();
        $rows->bindParam(':current_date', $current_date);
      }
      $rows->execute();
}
    
 catch (Exception $e) {
    echo $e->getMessage();
}

if(isset($_POST['click'])) {

    // Query the database to retrieve today's data
    $stmt = $pdo->prepare("SELECT * FROM details WHERE DATE(date) = CURDATE()");
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);}
?>


</head>

<body>
    <nav class="navbar">
        <div class="container-fluid">
            <img src="YYY.png" width="70" height="35" alt="athena">

            
        
        <form action="display_form.php" method="get">
        <div class=" topnav-centered">
          <input type="text" class="form-control searchbar" name="search" id="search" placeholder="Search guests" aria-describedby="basic-addon2" autocomplete="off">
          <button  class="btn" type="submit" name="submit"><i class="fa fa-search"></i></button>

          <div class="card list-group" id="show-list" ></div>
         <div class="div form"></div>
          
      
        </div>
        </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="frontpage.php">Guest</a></li>
                <li><a href="logout.php">logout</a></li>
            </ul>
        </div>
</nav>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
        integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
        integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <div class="container" >
        <div class="row align-items-center">
            <div class="col-md-6"  style="width:100%;">
                <div class="mb-3">
                    <h5 class="card-title">Check-in List <span class="text-muted fw-normal ms-2">
                            <?php echo " ($count)" ?>
                        </span></h5>
                </div>
                <form method="POST" action="">
  <label for="search_date">Search by Date:</label>
  <input type="date" name="search_date" id="search_date">
  <input type="submit" name="submit" value="Search">
</form>
<div class="col-12" >
	<form method="POST" class="float-right">
		<button type="submit" name="click" class="btn btn-primary " style="width: 60px;;">Today</button>
	</form>
</div>
            </div>
        </div>
        <div class="row" >
            <div class="col-lg-12">
                <div class="">
                    <div class="table-responsive">
                        <table class="table project-list-table table-nowrap align-middle table-borderless" id="paginated-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="ps-4" style="width: 50px;">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Adults</th>
                                    <th scope="col">Children</th>
                                    <th scope="col">Room</th>
                                    <th scope="col">Reservation detail</th>
                                    <th scope="col">Payment Type</th>
                                    <th scope="col" style="width: 200px;">Checkin Time</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 1;
                                    // Display data for current date
                                    while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
                                       
                                            
                                    echo "

                                        <tr class='highlight'>
                                         
                                        
                                            <th scope='row' class='ps-4'>
                                                $i
                                            </th>
                                            <td>
                                                <b>
                                                 $row[firstname]
                                                $row[lastname]
                                                </b>
                                                </br><a href='mailto: $row[email]'> $row[email]</a>
                                                </br>
                                                $row[phone]
                                            </td>
                                            <td>
                                                <b>
                                                $row[street1]
                                                $row[street2]
                                                </b>
                                                </br>
                                                $row[country]
                                                , 
                                                $row[state]
                                                </br>
                                                $row[zip_code]
                                            </td>
                                            <td>
                                                $row[adults]
                                            </td>
                                            <td>
                                                $row[children]
                                            </td>
                                            <td>
                                                $row[roomNum]
                                            </td>
                                            <td>
                                                $row[arrivaldate]</br>
                                                $row[depdate]
                                            </td>
                                            <td>
                                                $row[payment_type]
                                            </td>
                                            <td>
                                                $row[chkin_time]
                                            </td>
                                            <td style='position:relative'>
                                            <div class='dropdown'>
    <button type='button'  data-bs-toggle='dropdown' style='width:20px; margin-left:5px; border:none;'>
    <i class='fas fa-grip-vertical'></i>
    </button>
    <ul class='dropdown-menu'>
      <li><a href='edit.php?id=$row[id]' class='edit'><i class='fas fa-pen fa-xs'></i> Edit</a></li>
      <li><a href='delete.php?id=$row[id]' class='trash' ><i class='fas fa-trash fa-xs'></i> Delete</a></li>
      
      
    </ul>
  </div>
                   
                    
                </td>
                                        </tr>
                                       ";
                                        $i = $i + 1;}
                                    
                                    

                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="row g-0 align-items-center pb-4">
            <div class="col-sm-6">
                <div>
                    <p class="mb-sm-0"></p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-sm-end">
                    <ul class="pagination mb-sm-0">
                        <li class="page-item disabled">
                            <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item">
                            <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        html,
        body,
        div,
        input,
        span,
        a,
        select,
        textarea,
        option,
        h1,
        h2,
        h3,
        h4,
        main,
        aside,
        article,
        section,
        header,
        p,
        footer,
        nav,
        pre {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container{
            background-color: #f2f2f2;
            
        }

        .navbar {
            width: 90%;
            border: none;
            border-bottom: 1px solid #f2f2f2;
            margin: 0 auto;
            margin-bottom: 20px;
            background: transparent;
            color: gray;
            position: relative;
            
        }

        .navbar a {
            color: #8e939b;
        }

        .navbar a:hover {
            text-decoration: underline;
            color: black;

        }
        
        .topnav-centered .searchbar {
  float: none;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius: 50px;
  border: none;
  width: 500px;
  height: 30px;
  background-color: transparent;
  /* background-color:#f2f2f2; */
  background:transparent;
  outline: none;
  padding-inline: 0.5em;
  padding-block: 0.7em;
  --timing: 0.3s;

  
}
.card{
    float: none;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 500px;
  height: 30px;
  padding: 10px;
  visibility: ;
    min-width:max-content; 
    margin-top: 30px; 
    z-index: 1;
}
.btn{
    position: absolute;
    top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius:50px;
  margin-left: 270px;

}

@media screen and (max-width: 600px) {
  
  .topnav-centered .searchbar {
    position: relative;
    top: 0;
    left: 0;
    transform: none;
  }
}

    img{
        position:absolute;
    }

        .project-list-table {
            border-collapse: separate;
            border-spacing: 0px 10px;
        }

        .project-list-table tr {
            background-color: #fff
        }

        .table-nowrap td,
        .table-nowrap th {
            white-space: nowrap;
        }

        .table-borderless>:not(caption)>*>* {
            border-bottom-width: 0;
        }

        .table>:not(caption)>*>* {
            padding: 0.75rem 0.75rem;
            background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }
         table tbody tr td.actions .edit, table tbody tr td.actions .trash {
  	display: inline-flex;
  	text-align: right;
  	text-decoration: none;
  	color: #FFFFFF;
  	padding: 10px 12px;
}
table tbody tr td.actions .trash {
  	background-color: #b73737;
}
table tbody tr td.actions .trash:hover {
  	background-color: #a33131;
}
table tbody tr td.actions .edit {
  	background-color: #37afb7;
}
table tbody tr td.actions .edit:hover {
  	background-color: #319ca3;
}


        /* a {
    color: #3b76e1;
    text-decoration: none;
} */


        /* .highlight:hover{
    background-color: #CED0D6;
    cursor: pointer;
} */
    </style>
    <!-- Ajax script for search input -->
    <script>
      // When the search form is submitted
      $("#search-form").on("submit", function(e) {
        e.preventDefault(); // Prevent the form from submitting normally
        var searchDate = $("#search-date").val(); // Get the search date
        $.ajax({
          url: "http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=reservations&table=details", // URL of the server-side script that handles the search request
          method: "POST",
          data: { searchDate: searchDate }, // Data to be sent to the server
          success: function(result) {
            $("#data-table tbody").html(result); // Update the table body with the server's response
          },
        });
      });
    </script>





    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
$(document).ready(function () {
  // Send Search Text to the server
  $("#search").keyup(function () {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          query: searchText,
        },
        success: function (response) {
          $("#show-list").html(response);
        },
      });
    } else {
      $("#show-list").html("");
    }
  });
  // Set searched text in input field on click of search button
  $(document).on("click", "a", function () {
    $("#search").val($(this).text());
    $("#show-list").html("");
  });
});
</script>



</body>

</html>