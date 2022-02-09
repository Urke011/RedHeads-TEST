<style>

    * {
        box-sizing: border-box;
    }


    /* The actual timeline (the vertical ruler) */
    .timeline {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* The actual timeline (the vertical ruler) */
    .timeline::after {
        content: '';
        position: absolute;
        width: 11px;
        background-color: #C8C8C8;
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -3px;
    }

    /* Container around content */
    .container {

        position: relative;
        width: 65%;
    }

    /* The circles on the timeline */
    .container::after {
        content: '';
        position: absolute;
        width: 52px;
        height: 52px;
        right: 0%;
        background-color: #C8C8C8;
        border: 4px solid #C8C8C8;
        top: 42px;
        border-radius: 50%;
        z-index: 1;
    }

    /* Place the container to the left */
    .left {
        left: -30%;
        top: 106px;
    }

    /* Place the container to the right */
    .right {
        left: 40%;
        flex-direction: column;
    }

    /* Add arrows to the left container (pointing right) */
    .left::before {
        content: " ";
        height: 11px;
        position: absolute;
        top: 64px;
        width: 365px;
        z-index: 1;
        /* right: -250px; */
        left: 50%;
        /* border: medium solid #C8C8C8; */
        /* border-width: 10px 0 10px 10px; */
        /* border-color: transparent transparent transparent white; */
        background-color: #C8C8C8;
        border: medium solid #C8C8C8;
    }

    /* Add arrows to the right container (pointing left) */
    .right::before {
        content: " ";
        height: 11px;
        position: absolute;
        top: 28px;
        width: 80px;
        /* z-index: 1; */
        left: -8%;
        /* border: medium solid white; */
        /* border-width: 10px 10px 10px 0; */
        background: #C8C8C8;
    }

    /* Fix the circle for containers on the right side */
    .right::after {
        left: -14.5%;
        top: 7px;
    }

    /* The actual content */
    .content {
        position: relative;
        border-radius: 6px;
        bottom: 50px;
        display: flex;
    }

    .container:nth-child(odd) .content {
        flex-direction: column;
    }

    /* Media queries - Responsive timeline on screens less than 600px wide */
    @media screen and (max-width: 600px) {
        /* Place the timelime to the left */
        .timeline::after {
            left: 31px;
        }

        /* Full-width containers */
        .container {
            width: 100%;
            padding-left: 70px;
            padding-right: 25px;
            background-color: #C8C8C8;
            position: relative;
            border-radius: 6px;
            bottom: 50px;
            display: flex;
        }

        /* Make sure that all arrows are pointing leftwards */
        .container::before {
            left: 60px;
            border: medium solid #C8C8C8;
            border-width: 10px 10px 10px 0;
            border-color: transparent #C8C8C8 transparent transparent;
        }

        /* Make sure all circles are at the same spot */
        .left::after, .right::after {
            left: 15px;
        }

        /* Make all right containers behave like the left ones */
        .right {
            left: 0%;
        }
    }

    .wrapper {
        margin: 200px;
        position: relative;
    }

    .wrapper:after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        background-color: #C8C8C8;
        border-radius: 50%;
        top: -181px;
        left: 50%;
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
    }

    .wrapper:before {
        content: '';
        position: absolute;
        width: 11px;
        background-color: #C8C8C8;
        top: -89px;
        bottom: 0;
        left: 50%;
        margin-left: -3px;
    }


    .content_img {
        width: 50%;
    }

    .content_img img {
        min-width: 100%;
        max-width: 100%;
        height: 100%
    }

    .content_text {
        min-width: 300px;
        max-width: 300px;
        height: 300px;
    }
    .content_img:hover {
        -ms-transform: scale(1.03);
        -webkit-transform: scale(1.03);
        transform: scale(1.03);
        z-index: 1;

    }

</style>


<?php //var_dump($list);


?>
<?php if (!empty($list)) {
?>
<div class="wrapper">
</div>
<div class="timeline">
    <?php

    $i = 0;
    foreach ($list as $item) {
        //decode img
        $imgJson = $item->images;
        $jsonDecodedImg = json_decode($imgJson, true);

        if ($i % 2 == 0) {
            $direction = "left";
        } else {
            $direction = "right";
        }
        $i++;
        ?>
        <div class="container <?php echo $direction; ?>">
            <div class="content">
                <div class="content_img">
                    <img src="<?php echo $jsonDecodedImg['image_intro']; ?>"
                         alt="You need to choose an image">
                </div>
                <div class="content_text">
                    <p><?php echo $item->introtext; ?></p>
                    <i><?php echo $item->displayDate; ?></i>
                    <p><a href="#"><?php echo $item->author; ?></a></p>
                </div>
            </div>
        </div>
        <?php
    }
    }; ?>


</div>
