<?php
require 'config/mydb.php';
$name='';
if (isset($_POST['registerbtn'])) {
    $news = $_POST['News'];
    $date = $_POST['Date'];
    if (empty($news)){
            header("Location: NewUpdateAdmin.php?error=Fill up empty fields!");
        
        }else{
            $sql2 = "INSERT INTO news_update(title,date) VALUES('$news', '$date')";
                $result2 = mysqli_query($conn, $sql2);

            if($result2){   
                header("Location: NewUpdateAdmin.php?success=News Update successfully added");
                exit();
            

            }else{
                header("Location: NewUpdateAdmin.php?error=Error Occured");
                        }
        }
}


if(isset($_POST['SaveAnnouncement']))
{   
    $AnnouncementName= $_POST['AnnouncementName'];
    $images1 = $_FILES['Announcementimage']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["Announcementimage"]['type'],$img_types);

    if($validate_img_extension)
    { 
        if(file_exists("AnnouncementFiles/".$_FILES["Announcementimage"]["name"]))
        {
            $store=$_FILES["Announcementimage"]["name"];
            header("Location: AnnouncementAdmin.php?error=Image is Already exists.'.$store.'");

        }
        else{

            $squery3 ="INSERT INTO announcement(title,images) VALUES('$AnnouncementName','$images1')";
                $squery_run3 = mysqli_query($conn,$squery3);

            if($squery_run3)
            {
                move_uploaded_file($_FILES["Announcementimage"]["tmp_name"],"AnnouncementFiles/".$_FILES["Announcementimage"]["name"]);
                header("Location: AnnouncementAdmin.php?success=News Update successfully added");
                        exit();
            }
            else{
                header("Location: AnnouncementAdmin.php?error=Error Occured");
            }

        }
    }
    else if (empty($AnnouncementName)){
        header("Location: AnnouncementAdmin.php?error=Name is required");

    }
    else
    {
        header("Location: AnnouncementAdmin.php?error=Only PNG, JPG and JPEG Images are allowed!");

    }
    

}



if(isset($_POST['SaveHome']))
{   
    $Hometitle= $_POST['Home_title'];
    $HomeAuthor= $_POST['Home_author'];
    $HomeDate= $_POST['Home_Date'];
    $HomeDes= $_POST['Home_des'];
    $images1 = $_FILES['Home_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["Home_image"]['type'],$img_types);

    if($validate_img_extension)
    { 
        if(file_exists("HomeFiles/".$_FILES["Home_image"]["name"]))
        {
            $store=$_FILES["Home_image"]["name"];
            header("Location: HomeAdmin.php?error=Image is Already exists.'.$store.'");

        }
        else{

            $squery3 ="INSERT INTO home(title,author,date,description,image) VALUES('$Hometitle','$HomeAuthor','$HomeDate','$HomeDes','$images1')";
                $squery_run3 = mysqli_query($conn,$squery3);

            if($squery_run3)
            {
                move_uploaded_file($_FILES["Home_image"]["tmp_name"],"HomeFiles/".$_FILES["Home_image"]["name"]);
                header("Location: HomeAdmin.php?success=Data successfully added");
                        exit();
            }
            else{
                header("Location: HomeAdmin.php?error=Error Occured");
            }

        }
    }
    else if (empty($Hometitle)||($HomeAuthor)||($HomeDate)||($HomeDes)){
        header("Location: HomeAdmin.php?error=Fill up all fields");

    }
    else
    {
        header("Location: HomeAdmin.php?error=Only PNG, JPG and JPEG Images are allowed!");

    }
    

}










if(isset($_POST['saveImage']))
{   
    $hotlineName= $_POST['HotlineName'];
    $images = $_FILES['Hotlineimage']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["Hotlineimage"]['type'],$img_types);

    if($validate_img_extension)
    { 
        if(file_exists("uploads/".$_FILES["Hotlineimage"]["name"]))
        {
            $store=$_FILES["Hotlineimage"]["name"];
            header("Location: HotlineAdmin.php?error=Image is Already exists.'.$store.'");

        }
        else{

            $squery4 ="INSERT INTO hotline(title,image) VALUES('$hotlineName','$images')";
                $squery_run4 = mysqli_query($conn,$squery4);

            if($squery_run4)
            {
                move_uploaded_file($_FILES["Hotlineimage"]["tmp_name"],"uploads/".$_FILES["Hotlineimage"]["name"]);
                header("Location: HotlineAdmin.php?success=News Update successfully added");
                        exit();
            }
            else{
                header("Location: HotlineAdmin.php?error=Error Occured");
            }

        }
    }
    else if (empty($hotlineName)){
        header("Location: HotlineAdmin.php?error=Empty Fields!");

    }
    else
    {
        header("Location: HotlineAdmin.php?error=Only PNG, JPG and JPEG Images are allowed!");

    }
    

}





if(isset($_POST['updatebtn']))
{   
    $id=$_POST['edit_id'];
    $news = $_POST['NewsName'];
    $date1 = $_POST['EditDate'];


    $squery2 ="UPDATE news_update SET title='$news' , date='$date1' WHERE id='$id' ";
    $squery_run2 = mysqli_query($conn,$squery2);

    if($squery2)
    {
        header("Location: NewUpdateAdmin.php?success=News Update successfully!");
    }
    else{
        header("Location: NewUpdateAdmin.php?error=News Update error occured!");

    }
}




if(isset($_POST['announcement_updatebtn']))
{
    $edit_id1 =$_POST['edit_id'];
    $edit_name1=$_POST['Edit_Announcement'];

    $edit_announcement_image=$_FILES["Announcement_image"]['name'];


        $facul_query="SELECT * FROM announcement WHERE id='$edit_id1' ";
        $facul_query_run=mysqli_query($conn,$facul_query);

        foreach($facul_query_run as $fa_row)
        {
            if($edit_announcement_image == NULL)
            {
                $image_data1 = $fa_row['images'];
            }
            else
            {
                if($img_path = "AnnouncementFiles/".$fa_row['images'])
                {
                    unlink($img_path);
                    $image_data1 = $edit_announcement_image;
                }
            }
        }

        $query5 ="UPDATE announcement SET title='$edit_name1', images='$image_data1' WHERE id='$edit_id1' ";
        $squery_run5=mysqli_query($conn,$query5);


        if($squery_run5)
        {
            if($edit_announcement_image == NULL)
            {
                header("Location: AnnouncementAdmin.php?success=Announcement Updated with existing image");

            }
            else
            {
                move_uploaded_file($_FILES["Announcement_image"]["tmp_name"],"AnnouncementFiles/".$_FILES["Announcement_image"]["name"]);
                header("Location: AnnouncementAdmin.php?success=Announcement Update successfully");
                exit();

            }
        }
        else{
            header("Location: AnnouncementAdmin.php?error=Announcement Update error occured!");
        }
}






if(isset($_POST['hotline_updatebtn']))
{
    $edit_id =$_POST['edit_id'];
    $edit_name=$_POST['Edit_News'];

    $edit_hotline_image=$_FILES["Hotline_image"]['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');

        $facul_query="SELECT * FROM hotline WHERE id='$edit_id' ";
        $facul_query_run=mysqli_query($conn,$facul_query);

        foreach($facul_query_run as $fa_row)
        {
            if($edit_hotline_image == NULL)
            {
                $image_data = $fa_row['image'];
            }
            else
            {
                if($img_path = "uploads/".$fa_row['image'])
                {
                    unlink($img_path);
                    $image_data = $edit_hotline_image;
                }
            }
        }

        $query5 ="UPDATE hotline SET title='$edit_name', image='$image_data' WHERE id='$edit_id' ";
        $squery_run5=mysqli_query($conn,$query5);


        if($squery_run5)
        {
            if($edit_hotline_image == NULL)
            {
                header("Location: HotlineAdmin.php?success=Hotline Updated with existing image");

            }
            else
            {
                move_uploaded_file($_FILES["Hotline_image"]["tmp_name"],"uploads/".$_FILES["Hotline_image"]["name"]);
                header("Location: HotlineAdmin.php?success=Hotline Update successfully ");
                exit();

            }
        }
        else{
            header("Location: HotlineAdmin.php?error=Hotline Update error occured!");
        }

}








if(isset($_POST['Home_updatebtn']))
{
    $edit_id =$_POST['edit_id'];
    $edit_title=$_POST['Edit_TitleHome'];
    $edit_author=$_POST['Edit_AuthorHome'];
    $edit_date=$_POST['Edit_DateHome'];
    $edit_des=$_POST['Edit_Home_des'];

    $edit_hotline_image=$_FILES["Home_image"]['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    
        $facul_query="SELECT * FROM home WHERE id='$edit_id' ";
        $facul_query_run=mysqli_query($conn,$facul_query);

        foreach($facul_query_run as $fa_row)
        {
            if($edit_hotline_image == NULL)
            {
                $image_data = $fa_row['image'];
            }
            else
            {
                if($img_path = "HomeFiles/".$fa_row['image'])
                {
                    unlink($img_path);
                    $image_data = $edit_hotline_image;
                }
            }
        }

        $query5 ="UPDATE home SET title='$edit_title', author='$edit_author', date ='$edit_date', description='$edit_des', image='$image_data' WHERE id='$edit_id' ";
        $squery_run5=mysqli_query($conn,$query5);


        if($squery_run5)
        {
            if($edit_hotline_image == NULL)
            {
                header("Location: HomeAdmin.php?success=Home Updated with existing image");

            }
            else
            {
                move_uploaded_file($_FILES["Home_image"]["tmp_name"],"HomeFiles/".$_FILES["Home_image"]["name"]);
                header("Location: HomeAdmin.php?success=Home successfully Edit");
                exit();

            }
        }
        else{
            header("Location: HomeAdmin.php?error=Home Update error occured!");
        }

}








if(isset($_POST['about_btn']))
{   
    $Abouttitle= $_POST['About_title'];
    $AboutDes= $_POST['About_des'];
    $images2 = $_FILES['Aboutimage']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["Aboutimage"]['type'],$img_types);

    if($validate_img_extension)
    { 
        if(file_exists("AboutFiles/".$_FILES["Aboutimage"]["name"]))
        {
            $store=$_FILES["Aboutimage"]["name"];
            header("Location: AboutAdmin.php?error=Image is Already exists.'.$store.'");

        }
        else{

            $squery1 ="INSERT INTO about(title,description,image) VALUES('$Abouttitle','$AboutDes','$images2')";
                $squery_run1 = mysqli_query($conn,$squery1);

            if($squery_run1)
            {
                move_uploaded_file($_FILES["Aboutimage"]["tmp_name"],"AboutFiles/".$_FILES["Aboutimage"]["name"]);
                header("Location: AboutAdmin.php?success=Data successfully added");
                        exit();
            }
            else{
                header("Location: AboutAdmin.php?error=Error Occured");
            }

        }
    }
    else if (empty($Abouttitle)||($AboutDes)){
        header("Location: AboutAdmin.php?error=Fill up all fields");

    }
    else
    {
        header("Location: AboutAdmin.php?error=Only PNG, JPG and JPEG Images are allowed!");

    }
    

}










if(isset($_POST['About_updatebtn']))
{
    $edit_id =$_POST['edit_id'];
    $edit_title=$_POST['Edit_TitleAbout'];
    $edit_des=$_POST['Edit_About_des'];

    $edit_about_image=$_FILES["About_image"]['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    
        $facul_query="SELECT * FROM about WHERE id='$edit_id' ";
        $facul_query_run=mysqli_query($conn,$facul_query);

        foreach($facul_query_run as $fa_row)
        {
            if($edit_about_image == NULL)
            {
                $image_data = $fa_row['image'];
            }
            else
            {
                if($img_path = "AboutFiles/".$fa_row['image'])
                {
                    unlink($img_path);
                    $image_data = $edit_about_image;
                }
            }
        }

        $query5 ="UPDATE about SET title='$edit_title',description='$edit_des', image='$image_data' WHERE id='$edit_id' ";
        $squery_run5=mysqli_query($conn,$query5);


        if($squery_run5)
        {
            if($edit_about_image == NULL)
            {
                header("Location: AboutAdmin.php?success=About Us Updated with existing image");

            }
            else
            {
                move_uploaded_file($_FILES["About_image"]["tmp_name"],"AboutFiles/".$_FILES["About_image"]["name"]);
                header("Location: AboutAdmin.php?success=About Us successfully Update");
                exit();

            }
        }
        else{
            header("Location: AboutAdmin.php?error=About Us Update error occured!");
        }

}








if (isset($_POST['hazard_btn'])) {
    $title = $_POST['Hazard_title'];
    $subtitle = $_POST['Hazard_sub_title'];
    $hazard_des = $_POST['Hazard_des'];
    
    if (empty($title)){
            header("Location: HazardAdmin.php?error=Fill up empty fields!");
        
    }
    else if (empty($subtitle)){
        header("Location: HazardAdmin.php?error=Fill up empty fields!");
    
    }

    else if (empty($hazard_des)){
        header("Location: HazardAdmin.php?error=Fill up empty fields!");
    
    }   
    else{
        $sql2 = "INSERT INTO hazard(title,sub_title,description) VALUES('$title', '$subtitle','$hazard_des')";
            $result2 = mysqli_query($conn, $sql2);

        if($result2){   
            header("Location: HazardAdmin.php?success=Hazard successfully added");
            exit();
            

        }else{
            header("Location: HazardAdmin.php?error=Error Occured");
        }
    }
}


if(isset($_POST['Hazard_updatebtn']))
{   
    $id=$_POST['edit_id'];
    $hazardTitle = $_POST['Edit_TitleHazard'];
    $subtitle = $_POST['Edit_subTitleHazard'];
    $desc = $_POST['Edit_Hazard_des'];


    $squery2 ="UPDATE hazard SET title='$hazardTitle' , sub_title='$subtitle', description='$desc' WHERE id='$id' ";
    $squery_run2 = mysqli_query($conn,$squery2);

    if($squery2)
    {
        header("Location: HazardAdmin.php?success=Hazard Update successfully!");
    }
    else{
        header("Location: HazardAdmin.php?error=Hazard Update error occured!");

    }
}











if (isset($_POST['topics_btn'])) {
    $title = $_POST['Topics_title'];
    $subtitle = $_POST['Topics_sub_title'];
    
    if (empty($title)){
            header("Location: TopicsAdmin.php?error=Fill up empty fields!");
        
    }
    else if (empty($subtitle)){
        header("Location: TopicsAdmin.php?error=Fill up empty fields!");
    
    }   
    else{
        $sql2 = "INSERT INTO topics(title,sub_title) VALUES('$title', '$subtitle')";
            $result2 = mysqli_query($conn, $sql2);

        if($result2){   
            header("Location: TopicsAdmin.php?success=Topics successfully added");
            exit();
            

        }else{
            header("Location: TopicsAdmin.php?error=Error Occured");
        }
    }
}



if(isset($_POST['Topics_updatebtn']))
{   
    $id=$_POST['edit_id'];
    $hazardTitle = $_POST['Edit_TitleTopics'];
    $subtitle = $_POST['Edit_subTitleTopics'];


    $squery2 ="UPDATE topics SET title='$hazardTitle' , sub_title='$subtitle'WHERE id='$id' ";
    $squery_run2 = mysqli_query($conn,$squery2);

    if($squery2)
    {
        header("Location: TopicsAdmin.php?success=Topics Update successfully!");
    }
    else{
        header("Location: TopicsAdmin.php?error=Topics update error occured!");

    }
}






if(isset($_POST['guide_btn']))
{   
    $Guidetitle= $_POST['Guide_title'];
    $images1 = $_FILES['Guide_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["Guide_image"]['type'],$img_types);

    if($validate_img_extension)
    { 
        if(file_exists("GuideFiles/".$_FILES["Guide_image"]["name"]))
        {
            $store=$_FILES["Guide_image"]["name"];
            header("Location: GuideAdmin.php?error=Image is Already exists.'.$store.'");

        }
        else{

            $squery3 ="INSERT INTO guides(title,image) VALUES('$Guidetitle','$images1')";
                $squery_run3 = mysqli_query($conn,$squery3);

            if($squery_run3)
            {
                move_uploaded_file($_FILES["Guide_image"]["tmp_name"],"GuideFiles/".$_FILES["Guide_image"]["name"]);
                header("Location: GuideAdmin.php?success=Data successfully added");
                        exit();
            }
            else{
                header("Location: GuideAdmin.php?error=Error Occured");
            }

        }
    }
    else if (empty($Guidetitle)){
        header("Location: GuideAdmin.php?error=Fill up all fields");

    }
    else
    {
        header("Location: GuideAdmin.php?error=Only PNG, JPG and JPEG Images are allowed!");

    }
    

}


if(isset($_POST['Guide_updatebtn']))
{
    $edit_id1 =$_POST['edit_id'];
    $edit_name4=$_POST['Edit_TitleGuide'];

    $edit_guide_image=$_FILES["Guide_image"]['name'];


        $facul_query="SELECT * FROM guides WHERE id='$edit_id1' ";
        $facul_query_run=mysqli_query($conn,$facul_query);

        foreach($facul_query_run as $fa_row)
        {
            if($edit_guide_image == NULL)
            {
                $image_data1 = $fa_row['image'];
            }
            else
            {
                if($img_path = "GuideFiles/".$fa_row['image'])
                {
                    unlink($img_path);
                    $image_data1 = $edit_guide_image;
                }
            }
        }

        $query5 ="UPDATE guides SET title='$edit_name4', image='$image_data1' WHERE id='$edit_id1' ";
        $squery_run5=mysqli_query($conn,$query5);


        if($squery_run5)
        {
            if($edit_guide_image == NULL)
            {
                header("Location: GuideAdmin.php?success=Guide Updated with existing image");

            }
            else
            {
                move_uploaded_file($_FILES["Guide_image"]["tmp_name"],"GuideFiles/".$_FILES["Guide_image"]["name"]);
                header("Location: GuideAdmin.php?success=Guide Update successfully");
                exit();

            }
        }
        else{
            header("Location: GuideAdmin.php?error=Guide Update error occured!");
        }
}














if(isset($_POST['baranggay_btn']))
{   
    $Baranggaytitle= $_POST['Baranggay_title'];
    $images1 = $_FILES['Baranggayimage']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["Baranggayimage"]['type'],$img_types);

    if($validate_img_extension)
    { 
        if(file_exists("BaranggayFiles/".$_FILES["Baranggayimage"]["name"]))
        {
            $store=$_FILES["Baranggayimage"]["name"];
            header("Location: BaranggayAdmin.php?error=Image is Already exists.'.$store.'");

        }
        else{

            $squery3 ="INSERT INTO baranggay(baranggay,image) VALUES('$Baranggaytitle','$images1')";
                $squery_run3 = mysqli_query($conn,$squery3);

            if($squery_run3)
            {
                move_uploaded_file($_FILES["Baranggayimage"]["tmp_name"],"BaranggayFiles/".$_FILES["Baranggayimage"]["name"]);
                header("Location: BaranggayAdmin.php?success=Data successfully added");
                        exit();
            }
            else{
                header("Location: BaranggayAdmin.php?error=Error Occured");
            }

        }
    }
    else if (empty($Baranggaytitle)){
        header("Location: BaranggayAdmin.php?error=Fill up all fields");

    }
    else
    {
        header("Location: BaranggayAdmin.php?error=Only PNG, JPG and JPEG Images are allowed!");

    }
    

}






if(isset($_POST['Baranggay_updatebtn']))
{
    $edit_id1 =$_POST['edit_id'];
    $edit_name4=$_POST['Edit_TitleBaranggay'];

    $edit_baranggay_image=$_FILES["Baranggay_image"]['name'];


        $facul_query="SELECT * FROM baranggay WHERE id='$edit_id1' ";
        $facul_query_run=mysqli_query($conn,$facul_query);

        foreach($facul_query_run as $fa_row)
        {
            if($edit_baranggay_image == NULL)
            {
                $image_data1 = $fa_row['image'];
            }
            else
            {
                if($img_path = "BaranggayFiles/".$fa_row['image'])
                {
                    unlink($img_path);
                    $image_data1 = $edit_baranggay_image;
                }
            }
        }

        $query5 ="UPDATE baranggay SET baranggay='$edit_name4', image='$image_data1' WHERE id='$edit_id1' ";
        $squery_run5=mysqli_query($conn,$query5);


        if($squery_run5)
        {
            if($edit_baranggay_image == NULL)
            {
                header("Location: BaranggayAdmin.php?success=Baranggay Updated with existing image");

            }
            else
            {
                move_uploaded_file($_FILES["Baranggay_image"]["tmp_name"],"BaranggayFiles/".$_FILES["Baranggay_image"]["name"]);
                header("Location: BaranggayAdmin.php?success=Baranggay Update successfully");
                exit();

            }
        }
        else{
            header("Location: BaranggayAdmin.php?error=Baranggay Update error occured!");
        }
}






if(isset($_POST['Left_btn']))
{   
    $Lefttitle= $_POST['Left_title'];
    $LeftAuthor= $_POST['Left_author'];
    $LeftDate= $_POST['Left_Date'];
    $LeftDes= $_POST['Left_des'];
    $images1 = $_FILES['Left_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["Left_image"]['type'],$img_types);

    if($validate_img_extension)
    { 
        if(file_exists("LeftSideNews/".$_FILES["Left_image"]["name"]))
        {
            $store=$_FILES["Left_image"]["name"];
            header("Location: LeftSideAdmin.php?error=Image is Already exists.'.$store.'");

        }
        else{

            $squery3 ="INSERT INTO leftsidenews(title,author,date,description,image) VALUES('$Lefttitle','$LeftAuthor','$LeftDate','$LeftDes','$images1')";
                $squery_run3 = mysqli_query($conn,$squery3);

            if($squery_run3)
            {
                move_uploaded_file($_FILES["Left_image"]["tmp_name"],"LeftSideNews/".$_FILES["Left_image"]["name"]);
                header("Location: LeftSideAdmin.php?success=Data successfully added");
                        exit();
            }
            else{
                header("Location: LeftSideAdmin.php?error=Error Occured");
            }

        }
    }
    else if (empty($Lefttitle)||($LeftAuthor)||($LeftDate)||($LeftDes)){
        header("Location: LeftSideAdmin.php?error=Fill up all fields");

    }
    else
    {
        header("Location: LeftSideAdmin.php?error=Only PNG, JPG and JPEG Images are allowed!");

    }
    

}











if(isset($_POST['LeftSide_updatebtn']))
{
    $edit_id =$_POST['edit_id'];
    $edit_title=$_POST['Edit_TitleLeft'];
    $edit_author=$_POST['Edit_AuthorLeft'];
    $edit_date=$_POST['Edit_DateLeft'];
    $edit_des=$_POST['Edit_Left_des'];

    $edit_hotline_image=$_FILES["Left_image"]['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    
        $facul_query="SELECT * FROM leftsidenews WHERE id='$edit_id' ";
        $facul_query_run=mysqli_query($conn,$facul_query);

        foreach($facul_query_run as $fa_row)
        {
            if($edit_hotline_image == NULL)
            {
                $image_data = $fa_row['image'];
            }
            else
            {
                if($img_path = "LeftSideNews/".$fa_row['image'])
                {
                    unlink($img_path);
                    $image_data = $edit_hotline_image;
                }
            }
        }

        $query5 ="UPDATE leftsidenews SET title='$edit_title', author='$edit_author', date ='$edit_date', description='$edit_des', image='$image_data' WHERE id='$edit_id' ";
        $squery_run5=mysqli_query($conn,$query5);


        if($squery_run5)
        {
            if($edit_hotline_image == NULL)
            {
                header("Location: LeftSideAdmin.php?success=Left Side News Updated with existing image");

            }
            else
            {
                move_uploaded_file($_FILES["Left_image"]["tmp_name"],"LeftSideNews/".$_FILES["Left_image"]["name"]);
                header("Location: LeftSideAdmin.php?success=Left Side News successfully Edit");
                exit();

            }
        }
        else{
            header("Location: LeftSideAdmin.php?error=Left Side News Update error occured!");
        }

}






if(isset($_POST['Right_btn']))
{   
    $Right_title= $_POST['Right_title'];
    $RightAuthor= $_POST['Right_author'];
    $RightDate= $_POST['Right_Date'];
    $RightDes= $_POST['Right_des'];
    $images1 = $_FILES['Right_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["Right_image"]['type'],$img_types);

    if($validate_img_extension)
    { 
        if(file_exists("RightSideNews/".$_FILES["Right_image"]["name"]))
        {
            $store=$_FILES["Right_image"]["name"]; 
            header("Location: RightSideAdmin.php?error=Image is Already exists.'.$store.'");

        }
        else{

            $squery3 ="INSERT INTO rightsidenews(title,author,date,description,image) VALUES('$Right_title','$RightAuthor','$RightDate','$RightDes','$images1')";
                $squery_run3 = mysqli_query($conn,$squery3);

            if($squery_run3)
            {
                move_uploaded_file($_FILES["Right_image"]["tmp_name"],"RightSideNews/".$_FILES["Right_image"]["name"]);
                header("Location: RightSideAdmin.php?success=Data successfully added");
                        exit();
            }
            else{
                header("Location: RightSideAdmin.php?error=Error Occured");
            }

        }
    }
    else if (empty($Right_title)||($RightAuthor)||($RightDate)||($RightDes)){
        header("Location: RightSideAdmin.php?error=Fill up all fields");

    }
    else
    {
        header("Location: RightSideAdmin.php?error=Only PNG, JPG and JPEG Images are allowed!");

    }
    

}



if(isset($_POST['RightSide_updatebtn']))
{
    $edit_id =$_POST['edit_id'];
    $edit_title=$_POST['Edit_RightLeft'];
    $edit_author=$_POST['Edit_AuthorRight'];
    $edit_date=$_POST['Edit_DateRight'];
    $edit_des=$_POST['Edit_Right_des'];

    $edit_hotline_image=$_FILES["Right_image"]['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    
        $facul_query="SELECT * FROM rightsidenews WHERE id='$edit_id' ";
        $facul_query_run=mysqli_query($conn,$facul_query);

        foreach($facul_query_run as $fa_row)
        {
            if($edit_hotline_image == NULL)
            {
                $image_data = $fa_row['image'];
            }
            else
            {
                if($img_path = "RightSideNews/".$fa_row['image'])
                {
                    unlink($img_path);
                    $image_data = $edit_hotline_image;
                }
            }
        }

        $query5 ="UPDATE rightsidenews SET title='$edit_title', author='$edit_author', date ='$edit_date', description='$edit_des', image='$image_data' WHERE id='$edit_id' ";
        $squery_run5=mysqli_query($conn,$query5);


        if($squery_run5)
        {
            if($edit_hotline_image == NULL)
            {
                header("Location: RightSideAdmin.php?success=Right Side News Updated with existing image");

            }
            else
            {
                move_uploaded_file($_FILES["Right_image"]["tmp_name"],"RightSideNews/".$_FILES["Right_image"]["name"]);
                header("Location: RightSideAdmin.php?success=Right Side News successfully Edit");
                exit();

            }
        }
        else{
            header("Location: RightSideAdmin.php?error=Right Side News Update error occured!");
        }

}

?>

    
    
