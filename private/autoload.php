<?php
spl_autoload_register(function ($className) {
$classFile = str_replace('\\', '/', $className) . '.php';

// Check if the class file exists in Controllers or Managers
if (file_exists(__DIR__ . '/Controllers/' . $classFile)) {
require __DIR__ . '/Controllers/' . $classFile;
} elseif (file_exists(__DIR__ . '/Managers/' . $classFile)) {
require __DIR__ . '/Managers/' . $classFile;
}
});