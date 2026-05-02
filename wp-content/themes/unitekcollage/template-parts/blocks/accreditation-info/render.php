<?php
if (!defined('ABSPATH')) {
  exit;
}

$heading      = get_field('heading') ?: 'Accreditation';
$description  = get_field('description') ?: '';
$link_text    = get_field('link_text') ?: '';
$link_url     = get_field('link_url') ?: '';
$badge        = get_field('badge'); // array or null
$badge_width  = intval(get_field('badge_width') ?: 50);
$badge_height = intval(get_field('badge_height') ?: 50);

$block_id = !empty($block['anchor'])
  ? sanitize_title($block['anchor'])
  : 'accreditation-' . esc_attr($block['id']);

// Generate badge HTML with dynamic size
$badge_html = '';
if (is_array($badge) && !empty($badge['url'])) {
    $src = esc_url($badge['url']);
    $alt = esc_attr($badge['alt'] ?? 'Accreditation badge');
    $badge_html = "<img src=\"{$src}\" alt=\"{$alt}\" loading=\"lazy\" decoding=\"async\" style=\"width: {$badge_width}px; height: {$badge_height}px;\" />";
}
?>

<section id="<?php echo $block_id; ?>" class="v0-acc" aria-label="<?php echo esc_attr($heading); ?>">
  <style>
    #<?php echo $block_id; ?> {
      padding: 80px 0;
      background: #f7f8f9;
    }
    #<?php echo $block_id; ?> .v0-acc__inner {
      margin: 0 auto;
      padding: 50px 20px;
      text-align: center;
      color: #2a2f36;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
    }
    #<?php echo $block_id; ?> .v0-acc__title {
      font-weight: 700;
      font-size: clamp(22px, 3vw, 28px);
      line-height: 1.25;
      margin: 0 0 12px;
      letter-spacing: .2px;
    }
    #<?php echo $block_id; ?> .v0-acc__desc {
      margin: 0 auto 18px;
      font-size: 15px;
      line-height: 1.6;
      color: #4b5563;
      max-width: 62ch;
    }
    #<?php echo $block_id; ?> .v0-acc__link {
      color: #0d6b3f;
      text-decoration: underline;
      text-underline-offset: 2px;
    }
    #<?php echo $block_id; ?> .v0-acc__badge {
      margin-top: 20px;
    }
    #<?php echo $block_id; ?> a:focus-visible {
      outline: 2px solid #0d6b3f;
      outline-offset: 2px;
      border-radius: 3px;
    }
    @media (max-width: 900px) {
    .acc__inner-main{
        padding: 20px;
    }
}
  </style>

  <div class="v0-acc__inner acc__inner-main">
    <h2 class="v0-acc__title"><?php echo esc_html($heading); ?></h2>

    <?php if ($description || $link_url) : ?>
      <p class="v0-acc__desc">
        <?php echo wp_kses_post(nl2br($description)); ?>
        <?php if ($link_url) : ?>
          <?php
            $lt = esc_html($link_text ?: $link_url);
            $lu = esc_url($link_url);
          ?>
          <a target="_blank" class="v0-acc__link" href="<?php echo $lu; ?>"><?php echo $lt; ?></a>.
        <?php endif; ?>
      </p>
    <?php endif; ?>

    <?php if (!empty($badge_html)) : ?>
      <div class="v0-acc__badge" role="img" aria-label="<?php echo esc_attr($badge['alt'] ?? 'Accreditation badge'); ?>">
        <?php echo $badge_html; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
