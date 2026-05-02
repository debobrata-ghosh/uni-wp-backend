<?php
$img = get_field('img');
$quote = get_field('quote_text');
$qname = get_field('quote_name');
$qtitle = get_field('quote_title');
$cta_text = get_field('cta_text');
$cta_url = get_field('cta_url');
$video_url = get_field('video_url');
$video_file_raw = get_field('video_file');
$video_placeholder = get_field('video_placeholder');

if (!function_exists('youtube_id')) {
    function youtube_id($url) {
        if(empty($url)) return false;
        if(preg_match('~youtu\.be/([^\?&]+)~', $url, $m)) return $m[1];
        if(preg_match('~youtube\.com/watch\?v=([^\?&]+)~', $url, $m)) return $m[1];
        if(preg_match('~youtube\.com/embed/([^\?&]+)~', $url, $m)) return $m[1];
        return false;
    }
}
$youtube_id = youtube_id($video_url);

$video_file = '';
if(is_array($video_file_raw) && !empty($video_file_raw['url'])) {
    $video_file = $video_file_raw['url'];
} elseif (is_string($video_file_raw)) {
    $video_file = $video_file_raw;
}

$has_video = $youtube_id || $video_file;
?>
<div class="ivt-main-bg-image">
<div class="image-video-testimonial-content">
    <div class="ivt-card">
        <?php if($img): ?>
            <img src="<?php echo esc_url($img); ?>" alt="Testimonial background" class="ivt-main-img" />
        <?php endif; ?>
        <div class="ivt-quote-bar">
            <div class="ivt-quote-row">
                <span class="ivt-quote-icon" aria-hidden="true">&#8220;</span>
                <span class="ivt-quote-main"><?php echo esc_html($quote); ?></span>
            </div>
            <div class="ivt-meta-bar">
                <?php if($qname): ?><span class="ivt-name"><?php echo esc_html($qname); ?></span><?php endif; ?><br/>
                <?php if($qtitle): ?><span class="ivt-title"><?php echo esc_html($qtitle); ?></span><?php endif; ?>
            </div>
            <?php if($cta_text && $cta_url): ?>
            <div class="ivt-cta-bar">
                <a href="<?php echo esc_url($cta_url); ?>" class="ivt-cta-link">
                    <?php echo esc_html($cta_text); ?>
                    <span class="ivt-cta-arrow">
                        <svg viewBox="0 0 32 32" fill="none">
                            <path d="M11 16H25M25 16L19 10M25 16L19 22" stroke="#23272a" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="ivt-video">
        <div class="ivt-video-full" id="ivt-video-inject" style="position:relative; background:#aeb5bb; border-radius:20px; display:flex; align-items:center; justify-content:center; min-height:400px;">
            <?php if($has_video): ?>
                <button class="ivt-play-btn" aria-label="Play video" onclick="showIvtInlineVideo('ivt-video-inject', '<?php echo esc_js($youtube_id ?: ''); ?>', '<?php echo esc_js($video_file ?: ''); ?>');" style="position:absolute; z-index:3;">
                    <svg viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg" style="width:56px; height:56px; fill:#353b45;">
                        <circle cx="22" cy="22" r="18" fill="#e3e5e7"/>
                        <polygon points="19,17 29,22 19,27"/>
                    </svg>
                </button>
            <?php else: ?>
                <button class="ivt-play-btn" disabled aria-label="No video set" style="background:#e3e5e7; cursor:not-allowed; position:absolute; z-index:3;">
                    <svg viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg" style="width:56px; height:56px; fill:#b0b5bc;">
                        <circle cx="22" cy="22" r="18"/>
                        <polygon points="19,17 29,22 19,27"/>
                    </svg>
                </button>
            <?php endif; ?>

            <?php if($video_placeholder): ?>
                <img src="<?php echo esc_url($video_placeholder); ?>" alt="Video Placeholder" style="position:absolute; object-fit:cover; box-shadow:0 4px 20px rgba(0,0,0,0.25);"/>
            <?php else: ?>
                <div style="position:absolute;background:#bbb; box-shadow:0 4px 20px rgba(0,0,0,0.25); display:flex; align-items:center; justify-content:center; color:#666; font-size:1.2em;">
                    No Video
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<div class="ivt-mobile-stack">
    <div class="ivt-mobile-video-outer" id="ivt-mobile-video-inject">
        <?php if($has_video): ?>
            <button class="ivt-play-btn" aria-label="Play video" onclick="showIvtInlineVideo('ivt-mobile-video-inject', '<?php echo esc_js($youtube_id ?: ''); ?>', '<?php echo esc_js($video_file ?: ''); ?>');">
                <svg viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg" style="width:56px; height:56px; fill:#353b45;">
                    <circle cx="22" cy="22" r="18" fill="#e3e5e7"/>
                    <polygon points="19,17 29,22 19,27"/>
                </svg>
            </button>
        <?php else: ?>
            <button class="ivt-play-btn" disabled aria-label="No video set" style="background:#e3e5e7; cursor:not-allowed;">
                <svg viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg" style="width:56px; height:56px; fill:#b0b5bc;">
                    <circle cx="22" cy="22" r="18" />
                    <polygon points="19,17 29,22 19,27"/>
                </svg>
            </button>
        <?php endif; ?>
    </div>
    <div class="ivt-mobile-quote-bar">
        <div class="ivt-quote-row">
            <span class="ivt-quote-icon" aria-hidden="true">&#8220;</span>
            <span class="ivt-quote-main"><?php echo esc_html($quote); ?></span>
        </div>
        <div class="ivt-meta-bar">
            <?php if($qname): ?><span class="ivt-name"><?php echo esc_html($qname); ?></span></br><?php endif; ?>
            <?php if($qtitle): ?><span class="ivt-title"><?php echo esc_html($qtitle); ?></span><?php endif; ?>
        </div>
        <?php if($cta_text && $cta_url): ?>
        <div class="ivt-cta-bar">
            <a href="<?php echo esc_url($cta_url); ?>" class="ivt-cta-link">
                <?php echo esc_html($cta_text); ?>
                <span class="ivt-cta-arrow">
                    <svg viewBox="0 0 32 32" fill="none">
                        <path d="M11 16H25M25 16L19 10M25 16L19 22" stroke="#23272a" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
</div>
<script>
function showIvtInlineVideo(holderId, ytId, fileUrl) {
    var holder = document.getElementById(holderId);
    if(!holder) return;
    holder.classList.add('showing-vid');

    // Clear any existing content (including play button and placeholder images)
    holder.innerHTML = '';

    if(ytId) {
        var iframe = document.createElement('iframe');
        iframe.setAttribute('src', 'https://www.youtube.com/embed/' + ytId + '?autoplay=1&rel=0');
        iframe.setAttribute('allowfullscreen', 'true');
        iframe.setAttribute('frameborder', '0');
        iframe.setAttribute('aria-label', 'Video player');
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        iframe.style.borderRadius = '20px';
        iframe.style.background = '#000';
        iframe.style.display = 'block';
        holder.appendChild(iframe);
    } else if(fileUrl) {
        var video = document.createElement('video');
        video.src = fileUrl;
        video.controls = true;
        video.autoplay = true;
        video.style.width = '100%';
        video.style.height = '100%';
        video.style.borderRadius = '20px';
        video.style.background = '#000';
        video.style.display = 'block';
        holder.appendChild(video);
    }
}
</script>

<style>
    .ivt-main-bg-image{
    background-image: url('<?php echo home_url(); ?>/wp-content/uploads/2025/12/Start-dates-bg-image.png');
    background-position: center top;
    background-repeat: no-repeat;
    background-size: cover;
    height: 500px;
    padding-top: 0px;
    }
.image-video-testimonial-content {
    display: flex;
    gap: 40px;
    justify-content: center;
    align-items: flex-end;
    max-width: 1728px;
    margin: 0 auto;
    padding: 0px 150px 30px;
}
.ivt-card, .ivt-video {
    border-radius: 20px;
    min-height: 400px;
    height: 400px;
    position: relative;
    background: #aeb5bb;
}
.ivt-card {
    flex: 1 1 67%;
    max-width: 68%;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    overflow: hidden;
}
.ivt-main-img {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px;
    z-index: 1;
}
.ivt-quote-bar {
    background: #c6f157;
    border-radius: 12px;
    margin-bottom: 14px;
    margin-left: 16px;
    margin-right: 16px;
    width: auto;
    padding: 20px 32px 18px 32px;
    position: relative;
    z-index: 2;
    box-shadow: 0 0 18px rgba(60, 90, 46, 0.04);
}
.ivt-quote-row {
    display: flex;
    align-items: flex-start;
    gap: 13px;
}
.ivt-quote-icon {
    font-size: 2.1rem;
    font-weight: 700;
    color: #325033;
    line-height: 1;
}
.ivt-quote-main {
    font-size: 1.03rem;
    font-weight: 500;
    color: #23272e;
    line-height: 1.42;
}
.ivt-meta-bar {
    margin-top: 15px;
}
.ivt-name {
    font-weight: 700;
    color: #20272e;
    font-size: .96rem;
}
.ivt-title {
    font-size: .93rem;
    color: #20272e;
}
.ivt-cta-bar {
    text-align: right;
    margin-top: 4px;
}
.ivt-cta-link {
    color: #23272a;
    font-size: .97rem;
    font-weight: 500;
    text-decoration: none;
    background: none;
    display: inline-flex;
    align-items: center;
    gap: 7px;
}
.ivt-cta-arrow {
    width: 18px;
    height: 18px;
    vertical-align: middle;
}
.ivt-cta-arrow svg {
    width: 100%;
    height: 100%;
}
.ivt-video {
    flex: 1 1 33%;
    max-width: 32%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.ivt-video-full {
    width: 100%;
    height: 100%;
    border-radius: 20px;
    background: #aeb5bb;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}
.ivt-video-full iframe {
    width: 100%;
    height: 100%;
    border-radius: 20px;
    background: #aeb5bb;
    border: none;
    display: block;
}
.ivt-play-btn {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: #e3e5e7;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    box-shadow: 0 2px 7px rgba(30, 34, 56, 0.09);
    transition: box-shadow 0.2s;
    padding: 0;
}
.ivt-play-btn:focus {
    outline: 2px solid #325033;
}
.ivt-play-btn svg {
    width: 24px;
    height: 24px;
    display: block;
}

.ivt-mobile-stack {
    display: none;
}

/* Mobile version */
@media (max-width: 900px) {
    .image-video-testimonial-content {
        display: none;
    }
    .ivt-meta-bar {
    margin-top: 0px;
}
    .ivt-mobile-stack {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        max-width: 100%;
        margin: 10px 10px;
        border-radius: 20px;
        background: #aeb5bb;
        min-height: 420px;
        height: 90vw;
        position: relative;
        overflow: hidden;
        box-shadow: 0 3px 22px #23272a10;
    }
    .ivt-mobile-video-outer {
        width: 100%;
        min-height: 160px;
        height: 350px;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        background: #aeb5bb;
        border-radius: 20px 20px 0 0;
        position: relative;
        z-index: 2;
    }
    .ivt-mobile-video-outer iframe {
        width: 100%;
        height: 172px;
        min-height: 140px;
        border-radius: 20px;
        background: #aeb5bb;
        border: none;
        display: block;
    }
    .ivt-mobile-quote-bar {
        width: 95%;
        margin: 14px auto 14px auto;
        background: #c6f157;
        border-radius: 12px;
        box-shadow: 0 0 12px #6b97020a;
        min-height:220px;
        padding: 23px 22px 18px 20px;
        z-index: 2;
        position: relative;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .ivt-quote-row {
        margin-bottom: 7px;
    }
}

/* Hide play button once video is opened inline */
.ivt-video-full.showing-vid .ivt-play-btn,
.ivt-mobile-video-outer.showing-vid .ivt-play-btn {
    display: none !important;
}
</style>
