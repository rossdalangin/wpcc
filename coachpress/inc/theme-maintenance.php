<?php
/**
 * Theme Maintenance Logic
 *
 * @package CoachPress
 */

/**
 * Reset Theme Data (CPTs and Theme Mods)
 */
function coachpress_reset_theme_data() {
    $cpts = array('services', 'testimonials', 'case-studies', 'processes', 'faqs', 'portfolio', 'team');
    foreach ( $cpts as $cpt ) {
        $posts = get_posts( array( 'post_type' => $cpt, 'numberposts' => -1, 'post_status' => 'any' ) );
        foreach ( $posts as $post ) {
            wp_delete_post( $post->ID, true );
        }
    }
    remove_theme_mods();
}

/**
 * Add Professional Sample Data
 */
function coachpress_add_sample_data() {
    // Services
    $services = array(
        array(
            'title'   => 'Executive Leadership Coaching',
            'content' => 'High-impact coaching for C-suite executives and founders focusing on strategic decision-making and sustainable growth.',
        ),
        array(
            'title'   => 'Operational Excellence Consulting',
            'content' => 'Streamline your business processes and maximize efficiency with our data-driven operational strategies.',
        ),
        array(
            'title'   => 'Scalable Growth Strategy',
            'content' => 'Bespoke roadmaps designed to help established businesses break through plateaus and achieve exponential scale.',
        ),
    );
    foreach ( $services as $item ) {
        wp_insert_post( array( 'post_title' => $item['title'], 'post_content' => $item['content'], 'post_type' => 'services', 'post_status' => 'publish' ) );
    }

    // Testimonials
    $testimonials = array(
        array(
            'title'   => 'Sarah Jenkins, CEO of TechFlow',
            'content' => 'The strategic guidance we received was transformative. Our revenue grew by 40% within the first six months of implementation.',
        ),
        array(
            'title'   => 'Michael Chen, Founder of Zenith Scale',
            'content' => 'Invaluable perspective. As a founder, I was too close to the problems. CoachPress helped me see the path to the next level.',
        ),
    );
    foreach ( $testimonials as $item ) {
        wp_insert_post( array( 'post_title' => $item['title'], 'post_content' => $item['content'], 'post_type' => 'testimonials', 'post_status' => 'publish' ) );
    }

    // Case Studies
    $case_studies = array(
        array(
            'title'   => 'Scaling a Global SaaS to $10M ARR',
            'content' => 'How we restructured the sales process and customer success team to achieve 3x growth in 18 months.',
        ),
        array(
            'title'   => 'Leadership Turnaround at a Fortune 500 Firm',
            'content' => 'Rebuilding trust and alignment within a fractured executive team to drive a successful merger.',
        ),
    );
    foreach ( $case_studies as $item ) {
        wp_insert_post( array( 'post_title' => $item['title'], 'post_content' => $item['content'], 'post_type' => 'case-studies', 'post_status' => 'publish' ) );
    }

    // Processes
    $processes = array(
        array( 'title' => 'Phase 1: Deep Discovery', 'content' => 'We audit your current systems, leadership dynamics, and market positioning to find the hidden bottlenecks.' ),
        array( 'title' => 'Phase 2: Strategic Blueprint', 'content' => 'A custom roadmap with clear milestones, KPIs, and resource allocation plans.' ),
        array( 'title' => 'Phase 3: Agile Execution', 'content' => 'Iterative implementation with weekly check-ins to ensure momentum and alignment.' ),
        array( 'title' => 'Phase 4: Optimization & Scale', 'content' => 'Finalizing systems for long-term sustainability and hand-off to your internal team.' ),
    );
    foreach ( $processes as $item ) {
        wp_insert_post( array( 'post_title' => $item['title'], 'post_content' => $item['content'], 'post_type' => 'processes', 'post_status' => 'publish' ) );
    }

    // FAQs
    $faqs = array(
        array( 'title' => 'What is the typical duration of an engagement?', 'content' => 'Our core consulting engagements typically last between 3 to 9 months, depending on complexity.' ),
        array( 'title' => 'Do you work with startups?', 'content' => 'We primarily work with established businesses doing $2M+ in revenue, but we have selective slots for high-potential Series A startups.' ),
    );
    foreach ( $faqs as $item ) {
        wp_insert_post( array( 'post_title' => $item['title'], 'post_content' => $item['content'], 'post_type' => 'faqs', 'post_status' => 'publish' ) );
    }

    // Portfolio
    $portfolio = array(
        array( 'title' => 'The Sovereign Executive Program', 'content' => 'A curated 12-month mastermind for high-performing CEOs.' ),
        array( 'title' => 'Operations Overhaul: Retail Giant', 'content' => 'Redesigning the supply chain logic for a national retail chain.' ),
    );
    foreach ( $portfolio as $item ) {
        wp_insert_post( array( 'post_title' => $item['title'], 'post_content' => $item['content'], 'post_type' => 'portfolio', 'post_status' => 'publish' ) );
    }

    // Team
    $team = array(
        array( 'title' => 'Jonathan Vance', 'content' => 'Founder & Principal Consultant with 20 years of experience in organizational psychology.' ),
        array( 'title' => 'Elena Rodriguez', 'content' => 'Head of Strategic Operations and former COO of a Silicon Valley unicorn.' ),
    );
    foreach ( $team as $item ) {
        wp_insert_post( array( 'post_title' => $item['title'], 'post_content' => $item['content'], 'post_type' => 'team', 'post_status' => 'publish' ) );
    }
}

/**
 * Recreate Necessary Pages
 */
function coachpress_recreate_theme_pages() {
    if ( function_exists( 'coachpress_create_pages' ) ) {
        coachpress_create_pages();
    }
}

/**
 * Remove Necessary Pages
 */
function coachpress_remove_theme_pages() {
    $pages = array('home', 'about', 'services', 'portfolio', 'process', 'team', 'contact');
    foreach ( $pages as $slug ) {
        $page = get_page_by_path( $slug );
        if ( $page ) {
            wp_delete_post( $page->ID, true );
        }
    }
}

// AJAX Handlers
function coachpress_handle_maintenance_action() {
    check_ajax_referer( 'coachpress_maintenance_nonce', 'nonce' );

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Unauthorized' ) );
    }

    $action_type = sanitize_text_field( $_POST['maintenance_action'] );

    switch ( $action_type ) {
        case 'reset_db':
            coachpress_reset_theme_data();
            wp_send_json_success( array( 'message' => 'Database reset successfully.' ) );
            break;
        case 'add_data':
            coachpress_add_sample_data();
            wp_send_json_success( array( 'message' => 'Sample data added successfully.' ) );
            break;
        case 'recreate_pages':
            coachpress_recreate_theme_pages();
            wp_send_json_success( array( 'message' => 'Pages recreated successfully.' ) );
            break;
        case 'remove_pages':
            coachpress_remove_theme_pages();
            wp_send_json_success( array( 'message' => 'Pages removed successfully.' ) );
            break;
        default:
            wp_send_json_error( array( 'message' => 'Invalid action.' ) );
    }
}
add_action( 'wp_ajax_coachpress_maintenance_action', 'coachpress_handle_maintenance_action' );
