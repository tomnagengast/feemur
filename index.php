<?php 
include ("core/init.inc.php"); 
include ('core/pocket/api.php');
include ("core/nav.inc.php"); 
?>



  <!-- <body> -->
  <!-- Fixed navbar -->

    <div class="container">
      <div class="row">

              <ul class="nav nav-pills nav-stacked col-lg-3 pull-right">
                  <li class="active"><a href="#">Art</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Coffee</a></li>
                  <li><a href="#">Exercise</a></li>
                  <li><a href="#">Music</a></li>
                  <li><a href="#">New Zealand</a></li>
                  <li><a href="#">Python</a></li>
                  <li><a href="#">Technology</a></li>
                  <li><a href="#">Wine</a></li>
              </ul>

        <!-- begin accordion  -->
              <div class="accordion col-lg-9" id="accordion">

<?php 
$time = time();
$user = $_SESSION['username'];


$count = 1 ;
$show_links = show_links();

foreach ($show_links as $i => $row)
{
  if ($count == 1) {
  $in = 'in';
  } else {
    $in = '';
  }
  $item_id = $row['item_id'];
  $resolved_id = $row['resolved_id'];
  $given_url  = $row['given_url'];
  $given_title = $row['given_title'];
  $favorite = $row['favorite'];
  $status = $row['status'];
  $time_added = $row['time_added'];
  $time_updated = $row['time_updated'];
  $time_read = $row['time_read'];
  $time_favorited = $row['time_favorited'];
  $sort_id = $row['sort_id'];
  $resolved_title = $row['resolved_title'];
  $resolved_url = $row['resolved_url'];
  $excerpt = $row['excerpt'];
  $is_article = $row['is_article'];
  $is_index = $row['is_index'];
  $has_video = $row['has_video'];
  $has_image = $row['has_image'];
  $word_count = $row['word_count'];
  
 echo '<div class="accordion-group">' .
        '<div class="accordion-heading">' .
          '<a class="accordion-toggle" data-toggle="collapse" data-target="#' . $count . '" href="#collapseTwo">' .
                $given_title .
          '</a>' .
          '<ul class="meta">' .
            '<li><a class="url" href="' . $resolved_url . '" target="blank">' . $resolved_url . '</a></li>' .
            '<li><a class="user" href="' . $user . '">' . $user . '</a></li>' .
            '<li><a class="tags" href="#">tags</a>' .
          '</ul>' .
        '</div>' .

        '<div id="' . $count . '" class="accordion-body collapse '. $in .'  ">' .
          '<div class="accordion-inner">' .
            $excerpt .
          '</div>' .
        '</div>' .

      '</div>'; 
                
 // echo '<div class="accordion-group">' .
 //        '<div class="accordion-heading">' .
 //          '<a class="accordion-toggle" data-toggle="collapse" data-target="#' . $count . '" href="#collapseTwo">' .
 //                'word' .
 //          '</a>' .
 //          '<ul class="meta">' .
 //          '</ul>' .
 //        '</div>' .

 //        '<div id="' . $count . '" class="accordion-body collapse '. $in .'  ">' .
 //          '<div class="accordion-inner">' .
 //            'more' .
 //          '</div>' .
 //        '</div>' .
 //      '</div>'; 




++$count;
}

?>

              </div>
        <!-- End accordion -->
      </div>
    </div> <!-- /container -->
 
    <script>
      WebFont.load({
        google: {
          families: ["Montserrat:400,700","Varela Round:400","Varela:400"]
        }
      });
    </script>
        
 
<?php
include ('core/footer.inc.php');
?>