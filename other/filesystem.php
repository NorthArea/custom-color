<?php
/*
$path = "/dir1/page1.php";
$file = "./file1.txt";
// Return filename
echo basename($path); //page1.php

// Return filename without ext
echo basename($path,'.php');  //page1 

// Return dir name
echo dirname($path);  //"/dir1"

// Check file
echo file_exists($file);  // 1

// Check dir
echo file_exists(dirname($path));  // 1

// Get the absilut path
echo realpath($file); //"/home/ubuntu/workspace/website/file1.txt"

// Chmod
// Check writeable file
echo is_writable($file);  //1

// Chesk readable
echo is_readable($file);  //1

// Get filesize
echo filesize($file)." bytes"; //12 bytes

// Create a directory
echo mkdir("hello");  //1

// Remove dir if it is empty
echo rmdir("hello");  //1

// Remove dir if it is NOT empy
function delTree($dir) { 
  $files = array_diff(scandir($dir), array('.','..')); 
  foreach ($files as $file) { 
    (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
  } 
  return rmdir($dir); 
}
delTree('./tmp/');  //1

// Copy file
echo copy($file,'file2.txt'); //1

// Rename
echo rename('file2.txt','file3.txt'); //1

// Delete file
echo unlink('file.txt');  //1

// Read from file to string
echo file_get_contents($file);  //"Hello world!!"

// Write to the file(rewrite)
echo file_put_contents($file,"Helllo!!"); // new aize of the file

// Add string to the file
$current = file_get_contents($file);
echo file_put_contents($file, $current."\n"."Helllo!!");

// Open file fo reading
$handle = fopen($file,'r');
echo $data = fread($handle,filesize($file));
fclose($handle);

// Open file for writing
$handle = fopen('file2.txt','w');
$txt = "John Dow";
fwrite($handle,$txt);
fclose($handle);
*/






