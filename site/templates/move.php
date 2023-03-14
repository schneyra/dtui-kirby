<?php

// https://stackoverflow.com/questions/1833518/remove-empty-subfolders-with-php
function RemoveEmptySubFolders($path)
{
    $empty = true;
    foreach (glob($path . DIRECTORY_SEPARATOR . "*") as $file) {
        $empty &= is_dir($file) && RemoveEmptySubFolders($file);
    }
    return $empty && (is_readable($path) && count(scandir($path)) == 2) && rmdir($path);
}

$years = scandir('./content/blog');

foreach ($years as $year) {
    if ($year === '.' || $year === '..') {
        continue;
    }

    if (is_dir('./content/blog/' . $year)) {
        $months = scandir('./content/blog/' . $year);

        foreach ($months as $month) {
            if ($month === '.' || $month === '..') {
                continue;
            }

            $path = './content/blog/' . $year . '/' . $month;
            if (is_dir($path)) {
                $textfile = $path . '/month.txt';
                if (file_exists($textfile)) {
                    unlink($textfile);
                }

                $days = scandir($path);

                foreach ($days as $day) {
                    if ($day === '.' || $day === '..') {
                        continue;
                    }

                    $path = './content/blog/' . $year . '/' . $month . '/' . $day;
                    if (is_dir($path)) {
                        $textfile = $path . '/day.txt';
                        if (file_exists($textfile)) {
                            unlink($textfile);
                        }

                        $posts = scandir($path);

                        foreach ($posts as $post) {
                            if ($post === '.' || $post === '..') {
                                continue;
                            }

                            if (is_dir('./content/blog/' . $year . '/' . $month . '/' . $day . '/' . $post)) {
                                rename('./content/blog/' . $year . '/' . $month . '/' . $day . '/' . $post, './content/blog/' . $year . '/' . $post);
                            }
                        }
                    }
                }
            }
        }
    }
}

RemoveEmptySubFolders('./content/blog');
