<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'ABSPATH undefined.' );
}

class AASM_Export_Exception extends Exception {}
class AASM_Import_Exception extends Exception {}
class AASM_Archive_Exception extends Exception {}
class AASM_Archive_Destination_Dir_Exception extends Exception {}
class AASM_File_Not_Found_Exception extends Exception {}
class AASM_File_Delete_Exception extends Exception {}