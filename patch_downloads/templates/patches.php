<?php
$page = ModuleHelper::getFirstPageWithModule("patch_downloads");
$pageBaseUrl = ModuleHelper::getFullPageURLByID($page->id);
?>
<form method="get" action="<?php esc($pageBaseUrl); ?>"
      style="margin: 10px 0px">
    <button type="submit" class="btn btn-default"><?php translate("back"); ?></button>
</form>
<blockquote><?php translate("install_patches_help"); ?></blockquote>
<?php foreach (ViewBag::get("patches") as $patch) { ?>
    <form method="get" action="<?php esc($patch->url) ?>">
        <p>
            <strong><?php esc($patch->name) ?></strong> <br />
            <?php echo nl2br(_esc($patch->description)); ?>
            <br />

            <button type="submit" class="btn btn-primary" 
                    style="margin: 10px 0px"><?php translate("download"); ?></button>
        </p>
    </form>

<?php
}?>