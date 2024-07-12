<?php

namespace App\View\Composers;

use Illuminate\Support\Arr;
use Roots\Acorn\View\Composer;

class TsContent extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        // '*',
        'partials.content-ts',
    ];

    /**
     * Data to be passed to the view.
     *
     * @return array
     */
    public function with()
    {
        return [
            'tsContetData' => $this->tsContetData(),
            // Add more fields as needed
        ];
    }

    /**
     * Get ACF repeater field.
     *
     * @return array
     */

    public function tsContetData()
    {
        $data = [];
        $flexible_content = get_field('page_content');
        if ($flexible_content) {
            foreach ($flexible_content as $content) {
                if ($content['acf_fc_layout'] == 'hero_slider') {
                    $this_content = (object) [
                        'layout'            => $content['acf_fc_layout'],
                        'image_slider'      => $content['image_slider'],
                        'id'                => $content['id'],
                        'extra_class'       => $content['extra_class'],
                        'hide_section'      => $content['hide_section'],
                    ];
                    array_push($data, $this_content);
                } elseif ($content['acf_fc_layout'] == 'simple_content') {
                    $this_content = (object) [
                        'layout'            => $content['acf_fc_layout'],
                        'title'             => $content['title'],
                        'sub_title'         => $content['sub_title'],
                        'description'       => $content['description'],
                        'id'                => $content['id'],
                        'extra_class'       => $content['extra_class'],
                        'hide_section'      => $content['hide_section'],
                    ];
                    array_push($data, $this_content);
                } elseif ($content['acf_fc_layout'] == 'image_with_content') {
                    $this_content = (object) [
                        'layout'            => $content['acf_fc_layout'],
                        'image_position'    => $content['image_position'],
                        'image'             => $content['image'],
                        'title'             => $content['title'],
                        'description'       => $content['description'],
                        'button'            => $content['button'],
                        'id'                => $content['id'],
                        'extra_class'       => $content['extra_class'],
                        'hide_section'      => $content['hide_section'],
                    ];
                    array_push($data, $this_content);
                } elseif ($content['acf_fc_layout'] == 'our_process') {
                    $this_content = (object) [
                        'layout'                => $content['acf_fc_layout'],
                        'title'                 => $content['title'],
                        'background_image'      => $content['background_image'],
                        'process_grid'          => $content['process_grid'],
                        'id'                    => $content['id'],
                        'extra_class'           => $content['extra_class'],
                        'hide_section'          => $content['hide_section'],
                    ];
                    array_push($data, $this_content);
                } elseif ($content['acf_fc_layout'] == 'our_partners') {
                    $this_content = (object) [
                        'layout'            => $content['acf_fc_layout'],
                        'title'             => $content['title'],
                        'our_partners'      => $content['our_partners'],
                        'id'                => $content['id'],
                        'extra_class'       => $content['extra_class'],
                        'hide_section'      => $content['hide_section'],
                    ];
                    array_push($data, $this_content);
                } elseif ($content['acf_fc_layout'] == 'our_location') {
                    $this_content = (object) [
                        'layout'            => $content['acf_fc_layout'],                                                
                        'background_image'   => $content['background_image'],                       
                        'mobie_backgound_image'  => $content['mobie_backgound_image'],                       
                        'title'             => $content['title'],
                        'subtitle'          => $content['subtitle'],
                        'description'       => $content['description'],
                        'button'            => $content['button'],
                        'id'                => $content['id'],
                        'extra_class'       => $content['extra_class'],
                        'hide_section'      => $content['hide_section'],
                    ];
                    array_push($data, $this_content);
                } elseif ($content['acf_fc_layout'] == 'contact_information') {
                    $this_content = (object) [
                        'layout'            => $content['acf_fc_layout'],
                        'title'             => $content['title'],
                        'map_iframe'        => $content['map_iframe'],
                        'subtitle'          => $content['subtitle'],
                        'address'           => $content['address'],
                        'phone_number'      => $content['phone_number'],
                        'email_address'     => $content['email_address'],
                        'id'                => $content['id'],
                        'extra_class'       => $content['extra_class'],
                        'hide_section'      => $content['hide_section'],
                    ];
                    array_push($data, $this_content);
                } elseif ($content['acf_fc_layout'] == 'contact_us_form') {
                    $this_content = (object) [
                        'layout'                => $content['acf_fc_layout'],                 
                        'title'                 => $content['title'],
                        'form_shortcode'        => $content['form_shortcode'],
                        'description'           => $content['description'],
                        'id'                    => $content['id'],
                        'extra_class'           => $content['extra_class'],
                        'hide_section'          => $content['hide_section'],
                    ];
                    array_push($data, $this_content);
                } elseif ($content['acf_fc_layout'] == 'inner_banner') {
                    $this_content = (object) [
                        'layout'                => $content['acf_fc_layout'],
                        'banner_image'          => $content['banner_image'],
                        'banner_title'          => $content['banner_title'],
                        'banner_description'    => $content['banner_description'],
                        'id'                    => $content['id'],
                        'extra_class'           => $content['extra_class'],
                        'hide_section'          => $content['hide_section'],
                    ];
                    array_push($data, $this_content);
                } elseif ($content['acf_fc_layout'] == 'service_list') {
                    $service_post_data = array(
                        'post_type' => 'service',
                        'posts_per_page' => '-1',
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'ASC',
                    );
                    $service_posts = new \WP_Query($service_post_data);
                    $all_services = [];
                    if ($service_posts->have_posts()) {
                        while ($service_posts->have_posts()) : $service_posts->the_post();
                            $services_icon = get_field('service_icon', get_the_ID());
                            $fea_img = '';
                            if (get_the_post_thumbnail_url()) {
                                $fea_img = get_the_post_thumbnail_url();
                                $image_id = get_post_thumbnail_id();
                                $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                                $image_title = get_the_title($image_id);
                                if ($image_alt) {
                                    $image_alt = $image_alt;
                                } else {
                                    $image_alt = get_the_title();
                                }
                            } else {
                                $image_alt = get_the_title();
                            }
                            $all_services[] = array(
                                'id' => get_the_ID(),
                                'title' => get_the_title(),
                                'service_icon' => $services_icon,
                                'fea_img' => $fea_img,
                                'url' => get_the_permalink(),
                                'con_excerpt' => get_the_excerpt(),
                                'content_desc' => get_the_content(),
                            );
                        endwhile;
                        wp_reset_postdata();
                    }
                    $this_content = (object) [
                        'layout'            => $content['acf_fc_layout'],
                        'section_style'     => $content['section_style'],
                        'all_services'      => $all_services,
                        'id'                => $content['id'],
                        'extra_class'       => $content['extra_class'],
                        'hide_section'      => $content['hide_section']
                    ];
                    array_push($data, $this_content);
                } elseif ($content['acf_fc_layout'] == 'location_list') {
                    $this_content = (object) [
                        'layout'                => $content['acf_fc_layout'],
                        'title'                 => $content['title'],
                        'subtitle'              => $content['subtitle'],
                        'map_title'             => $content['map_title'],
                        'map_sub_title'         => $content['map_sub_title'],
                        'id'                    => $content['id'],
                        'extra_class'           => $content['extra_class'],
                        'hide_section'          => $content['hide_section'],
                    ];
                    array_push($data, $this_content);
                } elseif ($content['acf_fc_layout'] == 'news_list') {
                    $this_content = (object) [
                        'layout'                => $content['acf_fc_layout'],
                        'title'                 => $content['title'],
                        'id'                    => $content['id'],
                        'extra_class'           => $content['extra_class'],
                        'hide_section'          => $content['hide_section'],
                    ];
                    array_push($data, $this_content);
                } elseif ($content['acf_fc_layout'] == 'general_content') {
                    $this_content = (object) [
                        'layout'                => $content['acf_fc_layout'],
                        'description'           => $content['description'],
                        'id'                    => $content['id'],
                        'extra_class'           => $content['extra_class'],
                        'hide_section'          => $content['hide_section'],
                    ];
                    array_push($data, $this_content);
                }
            }
        }
        return $data;
    }
}
