<?php
if (function_exists('acf_add_local_field_group')):

acf_add_local_field_group(array(
    'key' => 'group_image_video_testimonial',
    'title' => 'Image Video Testimonial Fields',
    'fields' => array(
        array(
            'key' => 'field_img',
            'label' => 'Background Image',
            'name' => 'img',
            'type' => 'image',
            'return_format' => 'url',
        ),
        array(
            'key' => 'field_quote_text',
            'label' => 'Testimonial Quote',
            'name' => 'quote_text',
            'type' => 'textarea',
        ),
        array(
            'key' => 'field_quote_name',
            'label' => 'Testimonial Name',
            'name' => 'quote_name',
            'type' => 'text',
        ),
        array(
            'key' => 'field_quote_title',
            'label' => 'Testimonial Title',
            'name' => 'quote_title',
            'type' => 'text',
        ),
        array(
            'key' => 'field_cta_text',
            'label' => 'CTA Text',
            'name' => 'cta_text',
            'type' => 'text',
        ),
        array(
            'key' => 'field_cta_url',
            'label' => 'CTA URL',
            'name' => 'cta_url',
            'type' => 'url',
        ),
        array(
            'key' => 'field_video_url',
            'label' => 'Video URL (YouTube)',
            'name' => 'video_url',
            'type' => 'url',
        ),
        array(
            'key' => 'field_video_file',
            'label' => 'Upload Video (MP4, WebM, OGG)',
            'name' => 'video_file',
            'type' => 'file',
            'instructions' => 'Optional: Upload a local MP4, WebM, or OGG video. If both YouTube and local video are filled, YouTube will be used.',
            'return_format' => 'array',
            'mime_types' => 'mp4,webm,ogg',
        ),
        array(
            'key' => 'field_video_placeholder',
            'label' => 'Video Placeholder Image',
            'name' => 'video_placeholder',
            'type' => 'image',
            'return_format' => 'url',
            'instructions' => 'Image to show as placeholder/poster for the local video.',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/image-video-testimonial',
            ),
        ),
    ),
));

endif;
