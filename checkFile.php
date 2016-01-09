<?php
/*
 * This file for get file information on the server directly on brower without cpanel or filezilla use
 */
header("Content-type:text/plain");
$fileContent = file_get_contents($_SERVER['DOCUMENT_ROOT']."/phoenix_storefront/".$_GET["file"]);
echo $fileContent;
?>