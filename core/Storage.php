<?php

namespace Core;

class Storage {
    private $basePath;
    
    /**
     * Constructor
     * 
     * @param string $basePath Base directory path for storage
     */
    public function __construct() {
        $this->basePath = BASE_PATH . '/public/storage';
    }
    
    /**
     * Get full path to a file
     * 
     * @param string $path File path relative to base path
     * @return string Full file path
     */
    private function getFullPath($path) {
        return $this->basePath . '/' . ltrim($path, '/');
    }
    
    /**
     * Check if a file exists
     * 
     * @param string $path File path
     * @return bool True if file exists
     */
    public function exists($path) {
        return file_exists($this->getFullPath($path));
    }
    
    /**
     * Get the contents of a file
     * 
     * @param string $path File path
     * @return string|bool File contents or false on failure
     */
    public function get($path) {
        $fullPath = $this->getFullPath($path);
        return file_exists($fullPath) ? file_get_contents($fullPath) : false;
    }
    
    /**
     * Write contents to a file
     * 
     * @param string $path File path
     * @param string $contents Content to write
     * @return bool True on success, false on failure
     */
    public function put($path, $contents) {
        $fullPath = $this->getFullPath($path);
        $directory = dirname($fullPath);
        
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        
        return file_put_contents($fullPath, $contents) !== false;
    }
    
    /**
     * Append contents to a file
     * 
     * @param string $path File path
     * @param string $contents Content to append
     * @return bool True on success, false on failure
     */
    public function append($path, $contents) {
        $fullPath = $this->getFullPath($path);
        
        if (!file_exists($fullPath)) {
            return $this->put($path, $contents);
        }
        
        return file_put_contents($fullPath, $contents, FILE_APPEND) !== false;
    }
    
    /**
     * Delete a file
     * 
     * @param string $path File path
     * @return bool True on success, false on failure
     */
    public function delete($path) {
        $fullPath = $this->getFullPath($path);
        return file_exists($fullPath) && unlink($fullPath);
    }
    
    /**
     * Get the size of a file
     * 
     * @param string $path File path
     * @return int|bool File size in bytes or false on failure
     */
    public function size($path) {
        $fullPath = $this->getFullPath($path);
        return file_exists($fullPath) ? filesize($fullPath) : false;
    }
    
    /**
     * Get the last modification time of a file
     * 
     * @param string $path File path
     * @return int|bool Unix timestamp or false on failure
     */
    public function lastModified($path) {
        $fullPath = $this->getFullPath($path);
        return file_exists($fullPath) ? filemtime($fullPath) : false;
    }
    
    /**
     * Get all files in a directory
     * 
     * @param string $directory Directory path
     * @param bool $recursive Whether to scan recursively
     * @return array List of files
     */
    public function files($directory = '', $recursive = false) {
        $fullPath = $this->getFullPath($directory);
        $result = [];
        
        if (!is_dir($fullPath)) {
            return $result;
        }
        
        $items = scandir($fullPath);
        
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            
            $itemPath = $fullPath . '/' . $item;
            $relativePath = ($directory ? $directory . '/' : '') . $item;
            
            if (is_file($itemPath)) {
                $result[] = $relativePath;
            } elseif (is_dir($itemPath) && $recursive) {
                $result = array_merge($result, $this->files($relativePath, true));
            }
        }
        
        return $result;
    }
    
    /**
     * Create a directory
     * 
     * @param string $path Directory path
     * @return bool True on success, false on failure
     */
    public function makeDirectory($path) {
        $fullPath = $this->getFullPath($path);
        return !is_dir($fullPath) && mkdir($fullPath, 0755, true);
    }
    
    /**
     * Delete a directory
     * 
     * @param string $directory Directory path
     * @return bool True on success, false on failure
     */
    public function deleteDirectory($directory) {
        $fullPath = $this->getFullPath($directory);
        
        if (!is_dir($fullPath)) {
            return false;
        }
        
        $items = scandir($fullPath);
        
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            
            $itemPath = $fullPath . '/' . $item;
            
            if (is_dir($itemPath)) {
                $this->deleteDirectory($directory . '/' . $item);
            } else {
                unlink($itemPath);
            }
        }
        
        return rmdir($fullPath);
    }
}