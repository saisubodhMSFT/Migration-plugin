<?php
class Azure_app_service_migration_Import_AjaxHandler {
    
    // To Do: This function is redundant if realtime status is not implemented.
    public function get_migration_status() {
        if ( ! headers_sent() ) {
            header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset', 'utf-8' ) );
        }

        // get AASM_MIGRATION_STATUS option from database and send json encoded value to browser client
        $data = get_option( AASM_MIGRATION_STATUS, array() );
        echo json_encode( $data, $options );
        
        wp_die();
    }
}
?>