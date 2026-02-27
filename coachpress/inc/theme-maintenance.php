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
    $cpts = array('services', 'testimonials', 'case-studies', 'processes', 'faqs', 'portfolio', 'team', 'partners');
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
    $datasets = array(
        // Set 1: Executive Consulting
        array(
            'services' => array(
                array( 'title' => 'The Executive Edge System', 'content' => 'A rigorous, outcomes-based framework for high-performing CEOs. We specialize in eliminating decision fatigue.' ),
                array( 'title' => 'Operational Infrastructure Audit', 'content' => 'Stop being the bottleneck. We rebuild your backend systems from the ground up.' ),
                array( 'title' => 'Authority Branding', 'content' => 'Transform from "one of many" to the "only logical choice." We refine your market positioning.' ),
            ),
            'case_studies' => array(
                array( 'title' => '300% Growth in 14 Months', 'content' => 'Helping a boutique consultancy transition from manual outreach to an automated authority engine.' ),
                array( 'title' => 'Turnaround: From Deficit to $2M Profit', 'content' => 'Restructuring the operational logic of a struggling logistics firm.' ),
            ),
            'partners' => array('Global Finance Corp', 'Innovate AI', 'Nexus Logistics', 'Summit Healthcare')
        ),
        // Set 2: Health & Performance
        array(
            'services' => array(
                array( 'title' => 'Bio-Individual Optimization', 'content' => 'Data-driven performance coaching for elite athletes and entrepreneurs who demand peak physical output.' ),
                array( 'title' => 'Metabolic Reset Protocol', 'content' => 'A science-backed nutrition framework designed to stabilize energy and accelerate recovery.' ),
                array( 'title' => 'The Longevity Blueprint', 'content' => 'Strategic wellness planning focusing on cellular health and cognitive longevity.' ),
            ),
            'case_studies' => array(
                array( 'title' => 'Ironman PR in 6 Months', 'content' => 'How we used biomarker tracking to cut 45 minutes off an executive athlete’s marathon time.' ),
                array( 'title' => 'Reversing Burnout in Tech Teams', 'content' => 'Implementing performance protocols at a fast-growing startup to reduce sick leave by 40%.' ),
            ),
            'partners' => array('Vitality Lab', 'Peak Performance Co', 'BioHack Global', 'Endure Tech')
        ),
        // Set 3: SaaS / Tech Advisory
        array(
            'services' => array(
                array( 'title' => 'Product-Led Growth Strategy', 'content' => 'Turning your product into your primary customer acquisition channel. We build viral loops that scale.' ),
                array( 'title' => 'Cloud Architecture Audit', 'content' => 'Scaling your tech stack without scaling your costs. We optimize for high-concurrency environments.' ),
                array( 'title' => 'Tech Talent Retention', 'content' => 'Building an engineering culture that attracts and keeps world-class developers.' ),
            ),
            'case_studies' => array(
                array( 'title' => 'Scaling to 1M Users', 'content' => 'How we optimized the backend of a social networking app to handle viral growth spikes.' ),
                array( 'title' => 'Legacy Migration Success', 'content' => 'Moving a fintech giant from a monolith to microservices with zero downtime.' ),
            ),
            'partners' => array('CloudScale', 'DevOps Elite', 'SaaS Frontier', 'CodeCraft')
        ),
        // Set 4: Financial Strategy
        array(
            'services' => array(
                array( 'title' => 'Wealth Preservation Framework', 'content' => 'Strategic tax and asset protection planning for high-net-worth families and founders.' ),
                array( 'title' => 'M&A Advisory', 'content' => 'Buy-side and sell-side representation for middle-market companies looking for strategic exits.' ),
                array( 'title' => 'Capital Structuring', 'content' => 'Optimizing your balance sheet for growth, from debt restructuring to private equity rounds.' ),
            ),
            'case_studies' => array(
                array( 'title' => '$50M Strategic Exit', 'content' => 'Preparing a manufacturing firm for acquisition by a private equity group, maximizing valuation.' ),
                array( 'title' => 'Family Office Architecture', 'content' => 'Setting up the governance and investment framework for a multi-generational legacy.' ),
            ),
            'partners' => array('Legacy Trust', 'Capital Group', 'Prudent Fin', 'Asset Elite')
        ),
        // Set 5: Creative Agency / Branding
        array(
            'services' => array(
                array( 'title' => 'Visual Identity Overhaul', 'content' => 'Crafting iconic brands that resonate with high-end consumers and command market attention.' ),
                array( 'title' => 'Digital Experience Design', 'content' => 'More than just a website. We build immersive digital journeys that convert browsers into advocates.' ),
                array( 'title' => 'Campaign Creative Strategy', 'content' => 'High-stakes creative direction for product launches and international market entry.' ),
            ),
            'case_studies' => array(
                array( 'title' => 'Rebranding a Luxury Resort', 'content' => 'How a new visual narrative led to a 25% increase in seasonal bookings and 5-star reviews.' ),
                array( 'title' => 'The Global Launch of X-Tech', 'content' => 'A cross-platform campaign that reached 10M people in 48 hours.' ),
            ),
            'partners' => array('Vogue Media', 'Canvas Studio', 'Brand Union', 'Creative Flow')
        )
    );

    // Randomly select one dataset
    $data = $datasets[array_rand($datasets)];

    // Services
    foreach ( $data['services'] as $item ) {
        wp_insert_post( array( 'post_title' => $item['title'], 'post_content' => $item['content'], 'post_type' => 'services', 'post_status' => 'publish' ) );
    }

    // Case Studies
    foreach ( $data['case_studies'] as $item ) {
        wp_insert_post( array( 'post_title' => $item['title'], 'post_content' => $item['content'], 'post_type' => 'case-studies', 'post_status' => 'publish' ) );
    }

    // Partners
    foreach ( $data['partners'] as $name ) {
        wp_insert_post( array( 'post_title' => $name, 'post_type' => 'partners', 'post_status' => 'publish' ) );
    }

    // Add some universal Testimonials
    $testimonials = array(
        array( 'title' => 'Sarah Jenkins, CEO', 'content' => 'The strategic guidance we received was transformative. Our revenue grew by 40% in six months.' ),
        array( 'title' => 'Michael Chen, Founder', 'content' => 'Invaluable perspective. As a founder, I was too close to the problems. They helped me see the path.' ),
    );
    foreach ( $testimonials as $item ) {
        wp_insert_post( array( 'post_title' => $item['title'], 'post_content' => $item['content'], 'post_type' => 'testimonials', 'post_status' => 'publish' ) );
    }

    // Processes
    $processes = array(
        array( 'title' => 'Phase 1: Discovery', 'content' => 'We audit your current systems to find hidden bottlenecks.' ),
        array( 'title' => 'Phase 2: Strategy', 'content' => 'A custom roadmap with clear milestones and KPIs.' ),
        array( 'title' => 'Phase 3: Execution', 'content' => 'Iterative implementation with weekly check-ins.' ),
        array( 'title' => 'Phase 4: Scale', 'content' => 'Finalizing systems for long-term sustainability.' ),
    );
    foreach ( $processes as $item ) {
        wp_insert_post( array( 'post_title' => $item['title'], 'post_content' => $item['content'], 'post_type' => 'processes', 'post_status' => 'publish' ) );
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
