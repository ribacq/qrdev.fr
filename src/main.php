<?php
/**
 * coriander static website generator
 * @author Quentin RIBAC
 * @since 2020-11-10
 * @license WTFPL
 */

// dependencies
require 'vendor/autoload.php';
use Michelf\MarkdownExtra;

// config
$siteBaseDir = '/';
$dataDir = 'data/';
$outDir = 'docs/';
$ignoredNames = ['static/'];

// output directory option:
// --out "path/"
// -o "path/"
array_shift($argv);
while (!empty($argv[0]) && !empty($argv[1])) {
	if (in_array($argv[0], ['--out', '-o'])) {
		if (!is_dir($argv[1])) {
			die('directory does not exist: ' . $argv[1] . PHP_EOL);
		}
		$outDir = rtrim($argv[1], '/') . '/';
	}
	array_shift($argv);
	array_shift($argv);
}

// header and footer functions
function template($name, $pages, $pageI) {
	$templatesDir = './templates/';
	$page = $pages[$pageI];
	ob_start();
	include rtrim($templatesDir, '/').'/'.$name.'.php';
	return ob_get_clean();
}

// load filenames list
$filenames = [];
exec('tree -fin --noreport '.$dataDir, $filenames);

// reading
echo 'reading metadata' . PHP_EOL;
$pages = [];
foreach ($filenames as $filename) {
	if (is_dir($filename)) {
		echo "> $filename ... ";
		$filename = str_replace($dataDir, $outDir, $filename);
		if (!is_dir($filename)) {
			mkdir($filename, 0775, true);
		}
		echo 'OK' . PHP_EOL;
	} else if (is_file($filename)) {
		echo "> $filename ... ";
		$newFilename = str_replace($dataDir, $outDir, $filename);
		$filenameParts = explode('.', basename($filename));
		$base = $filenameParts[0];
		unset($filenameParts[0]);
		$tail = array_pop($filenameParts);

		if ($tail === 'md') {
			$pageTitle = null;
			$pageDate = date('Y-m-d', filemtime($filename));
			$newBasename = basename($newFilename, '.md') . '.html';
			$newFilename = dirname($newFilename) . '/' . $newBasename;
			$contents = file_get_contents($filename);
			$pageTitle = [];
			preg_match('/^# (.+)$/m', $contents, $pageTitle);
			$pageTitle = $pageTitle[1];
			$inNav = preg_match('/^#!nav$/m', $contents) === 1;
			$draft = preg_match('/^#!draft$/m', $contents) === 1;
			$description = [];
			preg_match('/^#!description:(.+)$/m', $contents, $description) === 1;
			unset($contents);

			if ($inNav) {
				echo '[nav] ';
			}
			echo "[$pageDate] $pageTitle ";
			if ($draft) {
				echo '[draft] ' . PHP_EOL;
				continue;
			}
			if (!empty($description[1])) {
				$description = trim($description[1]);
			}

			$pages []= [
				'mdPath' => $filename,
				'htmlPath' => $newFilename,
				'sitePath' => str_replace($outDir, $siteBaseDir, $newFilename),
				'rootPath' => $siteBaseDir,
				'inNav' => $inNav,
				'title' => $pageTitle,
				'description' => $description,
				'date' => $pageDate,
			];
		} else {
			$ignored = false;
			foreach ($ignoredNames as $ignoredName) {
				if (strpos($filename, $ignoredName) !== false) {
					$ignored = true;
					break;
				}
			}
			if ($ignored) {
				echo '[ignored] ';
			} else {
				copy($filename, $newFilename);
			}
		}

		echo 'OK' . PHP_EOL;
	}
}

// converting
echo 'converting pages' . PHP_EOL;
foreach ($pages as $pageI => $page) {
	echo '> ' . $page['htmlPath'] . ' ... ';
	$outfile = fopen($page['htmlPath'], 'w');
	if (!$outfile) {
		die('[error] could not open file '.$page['htmlPath']);
	}
	if (!fwrite($outfile, template('header', $pages, $pageI))) {
		die('[error] could not write htmlHeader into '.$page['htmlPath']);
	}
	$contents = file_get_contents($page['mdPath']);
	$contents = preg_replace('/^#!.*$/m', '', $contents);
	$contents = MarkdownExtra::defaultTransform($contents);
	if (!fwrite($outfile, $contents)) {
		die('[error] could not write converted markdown contents into '.$page['htmlPath']);
	}
	unset($contents);
	if (!fwrite($outfile, template('footer', $pages, $pageI))) {
		die('[error] could not write htmlFooter into '.$page['htmlPath']);
	}
	if (!fclose($outfile)) {
		die('[error] could not close file '.$page['htmlPath']);
	}
	echo 'OK' . PHP_EOL;
}
