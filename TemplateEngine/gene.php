<?php
/*
Gene Template System
遺伝子雛形システム
v1(htsrc-x1)
 */
function getSiteconf():array{
	return json_decode(file_get_contents(realpath(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "conf.d" . DIRECTORY_SEPARATOR . "siteconf.json")),true);
}
function getGlobaldata():array{
	$globalsiteconf = getSiteconf();
return array(
	"themecolor" => $globalsiteconf["theme"]["color"] ?? "#ffe0e0",
	"viewport" => $globalsiteconf["meta"]["viewport"] ?? "width=device-width,inital-scale=1.0",
	"sitename" => $globalsiteconf["siteinfo"]["sitename"] ?? "NoTitle",
	"ogptwown" => $globalsiteconf["ogp"]["twitter"]["ownerid"] ?? "",
	"ogpfbapp" => $globalsiteconf["ogp"]["facebook"]["appid"] ?? "",
	"ogplang" => $globalsiteconf["ogp"]["opengraph"]["lang"] ?? "en",
	"generator" => "GeneTemplateSystem(htsrc X) ver:1.0,rv:8"
);
}
function parse_htsrcx1(string $filename,array $mapdata,bool $escaped=false):?string {
	$source = file_get_contents(realpath( __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . $filename));
	if ($escaped){
		$result = preg_replace_callback('/(?!\\\\)\{\$([^_]+)\}/Uu', function ($matches) use ($mapdata) {
			return htmlspecialchars($mapdata[$matches[1]]) ?? "";
		}, $source);
			$result = preg_replace_callback('/(?!\\\\)\{\$_(.+)\}/Uu', function ($matches) {
			$globaldata = getGlobaldata();
			return htmlspecialchars($globaldata[$matches[1]]) ?? "";
		}, $result);
		$result = str_replace("\\{", "{", $result);
	}else {
		$result = preg_replace_callback('/(?!\\\\)\{\$([^_]+)\}/Uu', function ($matches) use ($mapdata) {
			return $mapdata[$matches[1]] ?? "";
		}, $source);
			$result = preg_replace_callback('/(?!\\\\)\{\$_(.+)\}/Uu', function ($matches) {
			$globaldata = getGlobaldata();
			return $globaldata[$matches[1]] ?? "";
		}, $result);
		$result = str_replace("\\{", "{", $result);
	}
	return $result;
}
function parse_htsrcx1s(string $source,array $mapdata,bool $escaped=false):?string {
	if ($escaped){
		$result = preg_replace_callback('/(?!\\\\)\{\$([^_]+)\}/Uu', function ($matches) use ($mapdata) {
			return htmlspecialchars($mapdata[$matches[1]]) ?? "";
		}, $source);
			$result = preg_replace_callback('/(?!\\\\)\{\$_(.+)\}/Uu', function ($matches) {
			$globaldata = getGlobaldata();
			return htmlspecialchars($globaldata[$matches[1]]) ?? "";
		}, $result);
		$result = str_replace("\\{", "{", $result);
	}else {
		$result = preg_replace_callback('/(?!\\\\)\{\$([^_]+)\}/Uu', function ($matches) use ($mapdata) {
			return $mapdata[$matches[1]] ?? "";
		}, $source);
			$result = preg_replace_callback('/(?!\\\\)\{\$_(.+)\}/Uu', function ($matches) {
			$globaldata = getGlobaldata();
			return $globaldata[$matches[1]] ?? "";
		}, $result);
		$result = str_replace("\\{", "{", $result);
	}
	return $result;
}
function parse_htsrcx1fr(string $filename,array $mapdata,bool $escaped=false):?string {
	$source = file_get_contents(realpath( __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Templates" . DIRECTORY_SEPARATOR . $filename));
	if ($escaped){
		$result = preg_replace_callback('/(?!\\\\)\{\$([^_]+)\}/Uu', function ($matches) use ($mapdata) {
			return htmlspecialchars($mapdata[$matches[1]]) ?? "";
		}, $source);
			$result = preg_replace_callback('/(?!\\\\)\{\$_(.+)\}/Uu', function ($matches) {
			$globaldata = getGlobaldata();
			return htmlspecialchars($globaldata[$matches[1]]) ?? "";
		}, $result);
		$result = str_replace("\\{", "{", $result);
	}else {
		$result = preg_replace_callback('/(?!\\\\)\{\$([^_]+)\}/Uu', function ($matches) use ($mapdata) {
			return $mapdata[$matches[1]] ?? "";
		}, $source);
			$result = preg_replace_callback('/(?!\\\\)\{\$_(.+)\}/Uu', function ($matches) {
			$globaldata = getGlobaldata();
			return $globaldata[$matches[1]] ?? "";
		}, $result);
		$result = str_replace("\\{", "{", $result);
	}
	return $result;
}
function getMenuhtml(string $filename):string {
	$source = file_get_contents(realpath( __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "menus" . DIRECTORY_SEPARATOR . $filename));
	$rawmenu = json_decode($source,true);
	$menu = "";
	foreach ($rawmenu["menu"] as $menuitem) {
		if ($menuitem["type"] == "item"){
			$menu .= "<li ripple><a href=\"" . $menuitem["addr"] . "\"><i class=\"material-icons\">" . $menuitem["icon"] . "</i>" . $menuitem["title"] . "</a></li>\n";
		}elseif ($menuitem["type"] == "section"){
			$menu .= "<h2>" . $menuitem["title"] . "</h2>\n";
		}elseif ($menuitem["type"] == "separator"){
			$menu .= "<li class=\"divider\"></li>\n";
		}
	}
	return $menu;
}
