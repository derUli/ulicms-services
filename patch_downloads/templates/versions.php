<?php
$page = ModuleHelper::getFirstPageWithModule("patch_downloads");
$pageBaseUrl = ModuleHelper::getFullPageURLByID($page->id) . "?version=";
?>

<p><?php translate("select_version_help");?></p>
<ul>
	<?php foreach(ViewBag::get("versions") as $version){?>
	<li><a href="<?php esc($pageBaseUrl."$version")?>"><?php esc($version);?></a></li>
<?php }?>
</ul>