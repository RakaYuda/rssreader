<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="container content mt-5">

    <!-- <form method="post" action="">
      <input type="text" name="feedurl" placeholder="Enter website feed URL">&nbsp;<input type="submit" value="Submit"
        name="submit">
    </form> -->

    <?php
      
      //  $url = "https://makitweb.com/feed/";
       $url = "http://sindikasi.okezone.com/index.php/rss/1/RSS2.0";
       if(isset($_POST['submit'])){
         if($_POST['feedurl'] != ''){
           $url = $_POST['feedurl'];
         }
       }
      
       $invalidurl = false;
       if(@simplexml_load_file($url)){
        $feeds = simplexml_load_file($url);
       }else{
        $invalidurl = true;
        echo "<h2>Invalid RSS feed URL.</h2>";
       }
      
      
       $i=0;
      //  print_r($feeds);
      //  exit;
       if(!empty($feeds)){
      
        $site = $feeds->channel->title;
        // $sitelink = $feeds->channel->link;
      
        echo "<h1>".$site."</h1>";
        echo "<div class='card-deck'>";
        foreach ($feeds->channel->item as $item) {
      
         $title = $item->title;
         $link = $item->link;
         $description = $item->description;
         $postDate = $item->pubDate;
         $pubDate = date('D, d M Y',strtotime($postDate));
      
      
         if($i>=3) break;
        ?>


    <div class="card" style="width:24rem">
      <img class="card-img-top" src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg"
        alt="Card image cap">
      <div class="card-body">
        <h4 class="card-title"><?php echo $title; ?></h4>
        <p class="card-text"><?php echo $description ?></p>
        <a href="<?php echo $link; ?>" class="btn btn-primary waves-effect waves-light">Read more</a>
      </div>

      <div class="card-footer">
        <small class="text-muted"><?php echo $pubDate; ?></small>
      </div>
    </div>

    <?php
          $i++;
         }
       }else{
         if(!$invalidurl){
           echo "<h2>No item found</h2>";
         }
       }
       echo "</div>";
       ?>

  </div>

</body>

</html>