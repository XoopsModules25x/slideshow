<?php
/*
Usage:
    Copy modulerename.php in <xoops_root>
    Change current working directory to <xoops_root>
    Update mappings as per new modulename.

Warning:
    Only one module original or renamed in action !!!

*/

// ##########################################################
//    Define your mapping here
// ##########################################################
$patterns = array(
    // first one must be module directory name
    'slideshow' => 'newname',
    'SLIDESHOW' => 'NEWNAME',
    'Slideshow' => 'Newname',
);

$patKeys   = array_keys($patterns);
$patValues = array_values($patterns);

// work around for PHP < 5.0.x
if (!function_exists('file_put_contents')) {
    function file_put_contents($filename, $data, $file_append = false)
    {
        $fp = fopen($filename, (!$file_append ? 'w+' : 'a+'));
        if (!$fp) {
            trigger_error('file_put_contents cannot write in file.', E_USER_ERROR);

            return;
        }
        fwrite($fp, $data);
        fclose($fp);
    }
}

// recursive clonning script
function renameFileFolder($path)
{
    global $patKeys;
    global $patValues;

    $newPath = str_replace($patKeys[0], $patValues[0], $path);

    if (is_dir($path)) {
        // create new dir
        mkdir($newPath);

        // check all files in dir, and process it
        if ($handle = opendir($path)) {
            while ($file = readdir($handle)) {
                if ($file != '.' && $file != '..') {
                    renameFileFolder("$path/$file");
                }
            }
            closedir($handle);
        }
    } else {
        if (preg_match('/(.jpg|.gif|.png|.zip)$/i', $path)) {
            copy($path, $newPath);
        } else {
            // file, read it
            $content = file_get_contents($path);
            $content = str_replace($patKeys, $patValues, $content);
            file_put_contents($newPath, $content);
        }
    }
}

renameFileFolder('modules/slideshow');

echo '<p>Happy renaming...<br><br>';
echo 'Check directory modules/' . $patterns['slideshow'] . ' for renomed module <br></br>';
echo 'Consider modifying renomed module by editing assets/images/' . $patterns['slideshow'] . '_slogo.png manually (if you care) <br><br>';
echo 'Please now, DELETE THIS FILE!!</p>';
