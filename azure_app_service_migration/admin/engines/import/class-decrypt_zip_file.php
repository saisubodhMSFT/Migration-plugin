<?php
// To Do: Remove this file since it is redundant here. 
// Zip encryption check to be done on client side javascript
class Azure_app_service_migration_Zip_Decrypt {

    public static function is_password_valid($zip_file_path, $password)
    {
        //Open/read a zip file. Return true if password is correct
        if (!$zip_file_path || !$password) {
            return false;
        }

        $zip = new ZipArchive();
        if ($zip->open($zip_file_path) === true) {
            $zip->setPassword($password);
            $zipfile = zip_read($zip);
            $zip->close();

            return !$zipfile;   // Return true if unable to read inside, indicating wrong password
        }
        else
            return false;
    }

    public static function check_zip_encrypted($zip_file) {
        //Open/read a zip file. Return true if password protected
        if (!$zip_file) {
            return false;
        }
    
        $zip = zip_open($zip_file);
    
        if (is_resource($zip)) {
            $zipfile = zip_read($zip);
            zip_close($zip);
            return !$zipfile; // Return true if unable to read inside, indicating password protection
        } 
        else {
            return true; // Couldn't open the file, might be password protected
        }
    
        return false; // File exists, but not password protected
    }
}