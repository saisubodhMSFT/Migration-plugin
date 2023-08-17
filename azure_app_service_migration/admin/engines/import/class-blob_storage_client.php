<?php

use MicrosoftAzure\Storage\Blob\BlobRestProxy;

class AASM_Blob_Storage_Client {

    private $blob_storage_client;

    public function __construct( $storage_account_name, $storage_account_key ) {
        $connectionString = "DefaultEndpointsProtocol=https;AccountName=$storage_account_name;AccountKey=$storage_account_key";
        $this->blob_storage_client = BlobRestProxy::createBlobService($connectionString);
    }

    public function upload_file($file_path, $blob_container) {
        if (!is_file($file_path))
            return;
        
        // remove ABSPATH (/home/site/wwwroot) from $file_path to get blob name
        $blob_name = str_starts_with($file_path, ABSPATH)
                    ? substr($file_path, strlen(ABSPATH))
                    : $file_path;

        // TO DO: Include Blob storage library for exceptions and add exception handling here 
        try {
            $this->blob_storage_client->createBlockBlob($blob_container, $blob_name, $file_path);
        } catch( Exception $ex) {
            Azure_app_service_migration_Custom_Logger::handleException($ex, false);
        }
    }

    public static function get_blob_storage_settings() {
        Azure_app_service_migration_Custom_Logger::logInfo(AASM_IMPORT_SERVICE_TYPE, 'Retrieving Azure Storage account credentials.', true);
        $w3tc_config_filepath = AASM_W3TC_CONFIG_MASTER_PATH;
        
        // Return empty array if w3tc config file not found
        if (!file_exists($w3tc_config_filepath))
            return [];
        
        // Read the file contents
        $fileContents = file_get_contents($w3tc_config_filepath);
    
        // Remove the PHP exit tag at the beginning of the file
        $jsonString = substr($fileContents, strpos($fileContents, '{'));
        
        // Decode the JSON string into a PHP object
        $jsonData = json_decode($jsonString);
        
        // Access the values inside the JSON object
        $cdn_engine = isset($jsonData->{'cdn.engine'}) ? $jsonData->{'cdn.engine'} : null;
        $storage_account = isset($jsonData->{'cdn.azure.user'}) ? $jsonData->{'cdn.azure.user'} : null;
        $storage_account_key = isset($jsonData->{'cdn.azure.key'}) ? $jsonData->{'cdn.azure.key'} : null;
        $blob_container = isset($jsonData->{'cdn.azure.container'}) ? $jsonData->{'cdn.azure.container'} : null;

        if (is_null($cdn_engine) 
            || is_null($storage_account) 
            || is_null($storage_account_key) 
            || is_null($blob_container) 
            || $cdn_engine != "azure")
        {
            Azure_app_service_migration_Custom_Logger::logInfo(AASM_IMPORT_SERVICE_TYPE, 'Failed to retrieve Azure Blob Storage Settings.', true);
            return [];
        }
        
        Azure_app_service_migration_Custom_Logger::logInfo(AASM_IMPORT_SERVICE_TYPE, 'Successfully retrieved Azure Storage account credentials.', true);
        // Return an array of blob storage values
        return [
            'storage_account' => $storage_account,
            'storage_account_key' => $storage_account_key,
            'blob_container' => $blob_container
        ];
    }
}