<?php

// Set environment
define('ENVIRONMENT', 'development');

// Display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

// LOAD OUR PATHS CONFIG FILE
require FCPATH . '../app/Config/Paths.php';

// Initialize Paths
$paths = new Config\Paths();

// LOAD THE FRAMEWORK BOOTSTRAP FILE
require $paths->systemDirectory . '/Boot.php';

// Boot the application
exit(CodeIgniter\Boot::bootWeb($paths));
