<?php 
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_testimonial_video_section',
    'title' => 'Testimonial Video Section',
    'fields' => array(
        array(
            'key' => 'field_testimonial_quote',
            'label' => 'Testimonial Quote',
            'name' => 'testimonialquote',
            'type' => 'textarea',
        ),
        array(
            'key' => 'field_testimonial_name',
            'label' => 'Testimonial Name',
            'name' => 'testimonialname',
            'type' => 'text',
        ),
        array(
            'key' => 'field_testimonial_title',
            'label' => 'Testimonial Title/Role',
            'name' => 'testimonialtitle',
            'type' => 'text',
        ),
        array(
            'key' => 'field_top_right_image',
            'label' => 'Top Right Image',
            'name' => 'toprightimage',
            'type' => 'image',
            'return_format' => 'url',
        ),
        // Originally YouTube video URL field
        array(
            'key' => 'field_lower_left_youtube_url',
            'label' => 'Lower Left YouTube Video URL',
            'name' => 'lowerleftvideourl',
            'type' => 'url',
            'instructions' => 'Paste a YouTube video URL only. The video will fill the left lower pane.',
        ),
        // New field for local video file upload
        array(
            'key' => 'field_lower_left_local_video',
            'label' => 'Lower Left Local Video Upload',
            'name' => 'lowerleftlocalvideo',
            'type' => 'file',
            'instructions' => 'Upload a local video file to display instead of YouTube video.',
            'return_format' => 'url',
            'mime_types' => 'mp4,mov,ogg,webm',
        ),
        // New field for placeholder image for local video
        array(
            'key' => 'field_lower_left_local_video_placeholder',
            'label' => 'Local Video Placeholder Image',
            'name' => 'lowerleftlocalvideoplaceholder',
            'type' => 'image',
            'return_format' => 'url',
            'instructions' => 'Image to show as placeholder or poster for the local video.',
        ),
        array(
            'key' => 'field_lower_right_title',
            'label' => 'Lower Right Title',
            'name' => 'lowerrighttitle',
            'type' => 'text',
        ),
        array(
            'key' => 'field_lower_right_desc',
            'label' => 'Lower Right Description',
            'name' => 'lowerrightdesc',
            'type' => 'textarea',
        ),
        array(
            'key' => 'field_resources',
            'label' => 'Resources',
            'name' => 'resources',
            'type' => 'repeater',
            'sub_fields' => array(
                array(
                    'key' => 'field_resource_title',
                    'label' => 'Resource Title',
                    'name' => 'resourcetitle',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_resource_link',
                    'label' => 'Resource Link',
                    'name' => 'resourcelink',
                    'type' => 'url',
                ),
            ),
            'layout' => 'table',
            'min' => 0,
            'max' => 8,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/testimonial-video-section',
            ),
        ),
    ),
));

endif;
?>
