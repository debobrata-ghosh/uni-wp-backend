<?php 
$quote = get_field('testimonialquote');
$name = get_field('testimonialname');
$title = get_field('testimonialtitle');
$image = get_field('toprightimage');
$youtube_url = get_field('lowerleftvideourl');
$local_video = get_field('lowerleftlocalvideo');
$local_video_placeholder = get_field('lowerleftlocalvideoplaceholder');
$lrtitle = get_field('lowerrighttitle');
$lrdesc = get_field('lowerrightdesc');
$resources = get_field('resources');

if ( ! function_exists( 'get_youtube_id_from_url1' ) ) {
    function get_youtube_id_from_url1( $url ) {
        if ( preg_match( '/youtu\.be\/([^?]+)/', $url, $matches ) ) {
            return $matches[1];
        }

        if ( preg_match( '/youtube\.com\/watch\?v=([^&]+)/', $url, $matches ) ) {
            return $matches[1];
        }

        if ( preg_match( '/youtube\.com\/embed\/([^?]+)/', $url, $matches ) ) {
            return $matches[1];
        }

        return false;
    }
}


$youtube_id = get_youtube_id_from_url1( $youtube_url );
?>

<style>
@media screen and (min-width: 1025px) {
 .main-wrapper-desk{
        max-width: 1440px;
    margin: 0 auto;
    padding: 0 80px;
}
}
.testimonial-video-section-wrap {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    min-height: 600px;
    width: 100%;
    background: #e7eaec;
}
/* Existing styling here (omit for brevity) */
.tvs-top-left {
    background: #49a145;
    color: #fff;
    padding: 56px 60px 32px 280px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
}
.tvs-quote {
    font-size: 1.20rem;
    font-weight: 400;
    line-height: 1.48;
    margin-bottom: 20px;
    margin-top: 7px;
    position: relative;
}
.tvs-quote:before {
    content: '“';
    font-size: 2.9rem;
    color: #fff;
    font-family: serif;
    vertical-align: top;
    position: absolute;
    left: -0.8em;
    top: -11px;
}
.tvs-name, .tvs-title {
    color: #d8fbd8;
    margin-top: 23px;
    font-size: 1.01rem;
    line-height: 1.12;
}
.tvs-title {
    margin-top: 6px;
}
.tvs-top-right {
    background: #e3e6e7;
    display: flex;
    justify-content: stretch;
    align-items: stretch;
    overflow: hidden;
}
.tvs-hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    min-height: 260px;
    min-width: 100%;
    background: #bbc0c5;
    display: block;
}
.tvs-lower-left {
    background: #d3d4d6;
    display: flex;
    align-items: stretch;
    justify-content: stretch;
    min-height: 240px;
    padding: 0;
}
.tvs-video-outer {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: stretch;
    justify-content: stretch;
}
.tvs-video-outer iframe, 
.tvs-video-outer video {
    width: 100%;
    height: 100%;
    border: none;
    min-height: 240px;
    background: #000;
    display: block;
}
.tvs-lower-right {
    background: #174e7d;
    color: #fff;
    padding: 48px 54px 30px 60px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.tvs-lr-title {
    font-size: 1.34rem;
    font-weight: 600;
    margin-bottom: 17px;
}
.tvs-lr-desc {
    font-size: 1.01rem;
    color: #cbe6fd;
    margin-bottom: 26px;
    max-width: 600px;
}
.tvs-resource-cols {
    display: flex;
    flex-direction: row;
    gap: 58px;
    align-items: flex-start;
}

.tvs-resource-list {
    display: flex;
    flex-direction: column;
    gap: 6px;
    min-width: 180px;
    max-width: 280px;
    width: 100%;
}
.tvs-resource {
    font-size: 0.98rem;
    color: #ace8fc;
    font-weight: 400;
}
.tvs-resource a {
    color: #ace8fc;
    text-decoration: none;
}
@media (max-width: 980px) {
    .testimonial-video-section-wrap {
        display: flex;
        flex-direction: column;
        padding: 0;
        min-height: unset;
    }
    .tvs-top-right,
    .tvs-top-left,
    .tvs-lower-left,
    .tvs-lower-right {
        width: 100% !important;
        min-width: 0 !important;
        min-height: 0 !important;
        padding: 20px 8px !important;
        box-sizing: border-box;
    }
    .tvs-top-right {
        order: 1;
        padding-top: 24px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 80px;
    }
    .tvs-top-left {
        order: 2;
        padding: 22px 50px 18px 50px !important;
        text-align: left;
    }
    .tvs-lower-left {
        order: 3;
        padding: 30px 8px 24px 8px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #d3d4d6;
        min-height: 120px;
    }
    /* .tvs-video-outer iframe,
    .tvs-video-outer video {
        min-height: 70px;
        height: 170px;
        border-radius: 50%;
        max-width: 60px;
        max-height: 60px;
        margin: 12px auto;
    } */
    .tvs-lower-right {
        order: 4;
        padding: 24px 40px 14px 40px !important;
        text-align: left;
        background: #174e7d;
    }
    .tvs-resource-cols {
        flex-direction: column;
        gap: 16px;
    }
    .tvs-resource-list {
        min-width: 80px;
        max-width: 100%;
        margin: 0;
    }
}

/* Responsive styles omitted for brevity */
</style>

<div class="testimonial-video-section-wrap" role="region" aria-label="Testimonial with Video Section">

    <!-- Top Right -->
     <div class="tvs-top-left">
        <blockquote class="tvs-quote"><?php echo esc_html($quote); ?></blockquote>
        <?php if ($name): ?>
            <div class="tvs-name" aria-label="Testimonial author"><?php echo esc_html($name); ?></div>
        <?php endif; ?>
        <?php if ($title): ?>
            <div class="tvs-title"><?php echo esc_html($title); ?></div>
        <?php endif; ?>
    </div>
    <div class="tvs-top-right" aria-label="Photo accompanying testimonial">
        <?php if ($image): ?>
            <img class="tvs-hero-img" src="<?php echo esc_url($image); ?>" alt="Photo accompanying testimonial" />
        <?php elseif ($name): ?>
            <span class="tvs-hero-img" style="display:flex;align-items:center;justify-content:center;background:#c0c8c9;font-size:1.25em;">
                Image
            </span>
        <?php endif; ?>
    </div>

    <!-- Top Left -->
    

    <!-- Lower Left Video -->
    <div class="tvs-lower-left">
        <div class="tvs-video-outer" role="region" aria-label="Testimonial video">
            <?php 
            if ($youtube_id):
                // Show YouTube embedded iframe if YouTube URL present
            ?>
                <iframe 
                    src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>?rel=0&autohide=1&showinfo=0&modestbranding=1" 
                    allow="autoplay; encrypted-media" allowfullscreen
                    title="Video testimonial from <?php echo esc_attr($name); ?>">
                </iframe>
            <?php 
            elseif ($local_video):
                // Show local video with placeholder image as poster if set
                $poster = $local_video_placeholder ? esc_url($local_video_placeholder) : '';
            ?>
                <video controls <?php if ($poster) echo 'poster="' . $poster . '"'; ?>>
                    <source src="<?php echo esc_url($local_video); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php else: ?>
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#bbb;color:#424;font-size:2.0rem;">
                    Paste YouTube URL or upload local video
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Lower Right -->
    <div class="tvs-lower-right">
        <h3 class="tvs-lr-title"><?php echo esc_html($lrtitle); ?></h3>
        <div class="tvs-lr-desc"><?php echo nl2br(esc_html($lrdesc)); ?></div>
        <?php if (!empty($resources)) : ?>
            <div class="tvs-resource-cols" role="list" aria-label="Resources">
                <?php 
                $mid = ceil(count($resources) / 2);
                $col1 = array_slice($resources, 0, $mid);
                $col2 = array_slice($resources, $mid);
                ?>
                <ul class="tvs-resource-list">
                    <?php foreach($col1 as $item): ?>
                        <li class="tvs-resource">
                            <?php if (!empty($item['resourcelink'])): ?>
                                <a href="<?php echo esc_url($item['resourcelink']); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($item['resourcetitle'].' opens in new tab'); ?>">
                                    <?php echo esc_html($item['resourcetitle']); ?>
                                </a>
                            <?php else: ?>
                                <?php echo esc_html($item['resourcetitle']); ?>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="tvs-resource-list">
                    <?php foreach($col2 as $item): ?>
                        <li class="tvs-resource">
                            <?php if (!empty($item['resourcelink'])): ?>
                                <a href="<?php echo esc_url($item['resourcelink']); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($item['resourcetitle'].' opens in new tab'); ?>">
                                    <?php echo esc_html($item['resourcetitle']); ?>
                                </a>
                            <?php else: ?>
                                <?php echo esc_html($item['resourcetitle']); ?>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>
