# gene-template
Gene PHP Template Engine
遺伝子雛形エンジン
(legacy compat name:"htsrc X v1" or "htsrcV10.1")
## License
GNU AGPL v3
## How to use
* Include "gene.php" with `include` or `require` Statement
* Make Replaceindex(array) `["aaa"] => "AaA"`
* Call and echo out `parse_htsrcx1` , `parse_htsrcx1fr` or `parse_htsrcx1s`.
## Tags
`{$varname}` - Replaceindex["varname"]<br>
`{$_gvarname}` - GeneGlobalVariable["gvarname"]<br>
`\{` - Escape from Replace
## Example
```index.php
include realpath(__DIR__ . DIRECTORY_SEPARATOR . "TemplateEngine" . DIRECTORY_SEPARATOR . "gene.php");
$menu = getMenuhtml("headermenu.json"); // Material Only
$htmlsrc = file_get_contents("source.index.html");
$mapdata = array(
	"title.titletag" => "Title for Title tag and OGP",
	"title.menuhead" => "Title for Menuheader(material only)",
	"title.toolbar" => "Title for Page Top Toolbar(material only)",
	"url" => "https://example.com/your-page-url/",
	"desc" => "your page description",
	"ogptype" => "website",
	"menu" => $menu,
	"content" => $htmlsrc,
);
echo parse_htsrcx1fr("base.htsrcx", $mapdata);
