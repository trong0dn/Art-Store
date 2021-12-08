<?php

include_once 'includes/functions.inc.php';

$memcache = new Memcache;
$memcache->connect('localhost', 11211)
	or die ("Could not connect");

$cacheKey = 'browse-paintings.php';

//Always cache the browse-paintings.php page
if ($browsePage = $memcache->get($cacheKey)) {
	$browsePage;
} else {
	$filename = 'browse-paintings.php';
	$handle = fopen($filename, 'r');
	$contents = fread($handle, filesize($filename));
	$memcache->set($filename, $contents, false, 600);
	$memcache->get($filename);
}

/**
 * Cache the filter selection of previously visited selections via new memcache.
 * Return the selection filter query.
 */
function cacheFilters() {
	$memcache = new Memcache;
	$memcache->connect('localhost', 11211)
		or die ("Could not connect");

	// Display the original top 20 paintings
	$defaultKey = 'default';
	if ($filtered = $memcache->get($defaultKey)) {
	} else {
		$memcache->set($defaultKey, querySelectFilter(), false, 60);
		$filtered = $memcache->get($defaultKey);
	}
	// Otherwise submit button is clicked, apply filter
	if (isset($_POST["submit"])) {
		if (!empty($_POST["Artist"])) {
			if ($filtered = $memcache->get($_POST["Artist"])) {
			} else {
				$memcache->set($_POST["Artist"], querySelectFilter(), false, 60);
				$filtered = $memcache->get($_POST["Artist"]);
			}
		}
		else if (!empty($_POST["Museum"])) {
			if ($filtered = $memcache->get($_POST["Museum"])) {
			} else {
				$memcache->set($_POST["Museum"], querySelectFilter(), false, 60);
				$filtered = $memcache->get($_POST["Museum"]);
			}
		}
		else if (!empty($_POST["Shape"])) {
			if ($filtered = $memcache->get($_POST["Shape"])) {
			} else {
				$memcache->set($_POST["Shape"], querySelectFilter(), false, 60);
				$filtered = $memcache->get($_POST["Shape"]);
			}
		}
	}
	return $filtered;
}

?>