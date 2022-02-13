<?php 
  require_once 'config/mydb.php';
  session_start();
  if(!isset($_SESSION['id'])){
    header('location: login-admin.php');
    exit();
  }
?>
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Update Right Side News</title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxiocns CDN Link -->
    <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body style="background-color: rgba(226, 223, 223, 0.842);">
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-menu'></i>
      <div class="logo">
        <img src ="logo1.png">
      </div>
    </div>
    <ul class="nav-links">
      <li>
        <a href="AdminDashboard.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="AdminDashboard.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-home'></i>
            <span class="link_name">Home</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Home</a></li>
          <li><a href="NewUpdateAdmin.php">News Updates</a></li>
          <li><a href="BaranggayAdmin.php">Baranggay</a></li> 
          <li><a href="HomeAdmin.php">Recent Post</a></li>
          <li><a href="TopicsAdmin.php">Topics</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bxs-news'></i>
            <span class="link_name">News</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">News</a></li>
          <li><a href="LeftSideAdmin.php">Left Side</a></li>
          <li><a href="RightSideAdmin.php">Right Side</a></li>

        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bxs-megaphone'></i>
            <span class="link_name">Announcement</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Announcement</a></li>
          <li><a href="AnnouncementAdmin.php">Carousel</a></li>
          <li><a href="GuideAdmin.php">Guides</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            <span class="link_name">Hazard</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Hazard</a></li>
          <li><a href="HazardAdmin.php">Hazard</a></li>
          <li><a href="HotlineAdmin.php">Hotline</a></li>
        </ul>
      </li>
      <li>
        <a href="AboutAdmin.php">
          <i class="fa fa-question-circle" aria-hidden="true"></i>
          <span class="link_name">About Us</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Abouts</a></li>
        </ul>
      </li>
      <li>
        <a href="UserAdmin.php">
          <i class='bx bxs-user'></i>
          <span class="link_name">User</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="UserAdmin.php">User</a></li>
        </ul>
      </li>
      <li>
        <a href="AlertAdmin.php">
          <i class='bx bxs-bell-ring'></i>
          <span class="link_name">Alert</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="AlertAdmin.php">Alert</a></li>
        </ul>
      </li>
      <li>
    <div class="profile-details">
      <div class="profile-content">
      <a href="logout.php" style="color: inherit;"><i class='bx bx-log-out' id="log_out" ></i></a>
      </div>
      <div class="name-job">
        <div class="profile_name"><?php echo $_SESSION['username'];?></div>
        <div class="job">Administration</div>
      </div>
      
    </div>
  </li>
</ul>
  </div>

  <div class="admin-content" style="background-color: rgba(226, 223, 223, 0.842);">

    <br>
    <br>
    <div class="content"  style="width:90%; margin:0 auto;">
    <div class="card shadow mb-4">
          <div class="card-header py-3">
          
            <h2 class="m-0 font-weight-bold text-danger" style="align-items: center;">
              Edit RightSide Side News
                    
            </h2>
          </div>
          <?php
          $conn = mysqli_connect("localhost","root","","user-verification");
          if(isset($_POST['edit_dataRightSide_btn']))
          {
              $id=$_POST['edit_id'];
              $query = "SELECT * FROM Rightsidenews WHERE id='$id' ";
              $query_run = mysqli_query($conn,$query);

              foreach($query_run as $row) 
              {
                  ?>
              
            <form action="UpdateValid.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                <div class="form-group" style="width:96%; margin-left:2%">
                    <label>Title</label>
                    <input type="text" name="Edit_RightLeft" value="<?php echo $row['title'] ?>" class="form-control">
                </div>
                <div class="form-group" style="width:96%; margin-left:2%">
                    <label>Author</label>
                    <input type="text" name="Edit_AuthorRight" value="<?php echo $row['author'] ?>" class="form-control">
                </div>
                <div class="form-group" style="width:96%; margin-left:2%">
                    <label>Date</label>
                    <input type="date" name="Edit_DateRight" value="<?php echo $row['date'] ?>"class="form-control">
                </div>
                <div class="form-group" style="width:96%; margin-left:2%">
                    <label>Description</label><br>
                    <textarea name="Edit_Right_des" style="width:100%;" rows="3"><?php echo $row['description']?></textarea>
                </div>
                <div class="form-group" style="width:96%; margin-left:2%">
                <label>Upload Image</label>
                  <input type="file" id="Right_image" name="Right_image" value="<?php echo $row['image'] ?>" class="form-control">
                </div>
                <div class="caasda" style="display:flex; margin:2% " >
                    <a href="RightSideAdmin.php" class="btn btn-danger" style="height:40px; margin-right:.5%;" >Cancel </a>
                    <button type="submit" class="btn btn-primary" name="RightSide_updatebtn"> Update </button>
                </div>
            </form>

            <?php
        }
    }
        
?>        


</div>

<script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
  let arrowParent = e.target.parentElement.parentElement;
  arrowParent.classList.toggle("showMenu");
    });
  }

  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
</script>
  


  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
