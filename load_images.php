<?php

require('inc/function.php');

$start = isset($_POST['start']) ? $_POST['start'] : 0;
$limit = 6;

// Query to fetch images
$sql = mysqli_query($conn, "SELECT * FROM tbl_gallery Where status = '1' LIMIT $start, $limit");
if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_assoc($sql)) {
    echo '<div class="gallery-block-two col-md-4 l-item">';
    echo '<div class="inner-box">';
    echo '<figure class="image-box">';
    echo '<img src="uploads/gallery/'.$row['image'].'"  alt="">';
    echo '</figure>';
    echo '<div class="content-box">';
    echo '<div class="view-btn">';
    echo '<a href="uploads/gallery/'.$row['image'].'" class="lightbox-image" data-fancybox="gallery">';
    echo '<i class="icon-16"></i>';
    echo '</a></div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
    }
} else {
    echo 'No more images to load.';
}


?>
