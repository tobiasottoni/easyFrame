<link href="styles/slide.css" rel="stylesheet">

<div class="slider">

    <?php

    include('connections/databaseConnection.php');

    $getSlides = "SELECT src, alt, link FROM slides WHERE active = 'active'";

    $executeGetSlides = mysqli_query($conn, $getSlides);

    while ($slide = mysqli_fetch_array($executeGetSlides)) {

        echo '<div class="slide">
                <a href="' . $slide['link'] . '">
                    <img class="slide_img" src="' . $slide['src'] . '" alt="' . $slide['alt'] . '">
                </a>
             </div>';
    }

    ?>
</div>

<script>
    const slider = document.querySelector('.slider');
    let currentIndex = 0;

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slider.children.length;
        updateSlider();
    }

    function updateSlider() {
        const translateValue = -currentIndex * 100 + '%';
        slider.style.transform = 'translateX(' + translateValue + ')';
    }

    setInterval(nextSlide, 3000);
</script>