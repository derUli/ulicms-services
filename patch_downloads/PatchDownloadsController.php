<?php

class PatchDownloadsController extends Controller
{

    private $moduleName = "patch_downloads";

    public function titleFilter($title)
    {
        $version = Request::getVar("version", null, "str");
        if (containsModule(null, $this->moduleName)) {
            $title = ! $version ? get_translation("please_select_ulicms_version") : get_secure_translation("patches_for_ulicms_x", array(
                "%version%" => $version
            ));
        }
        return $title;
    }

    public function render()
    {
        $version = Request::getVar("version", null, "str");
        if (! $version) {
            $versions = array();
            $path = Path::resolve("ULICMS_ROOT/patches/lists/*.txt");
            $files = glob($path);
            foreach ($files as $file) {
                $versions[] = pathinfo($file, PATHINFO_FILENAME);
            }
			usort($versions, "version_compare");
            ViewBag::set("versions", $versions);
            return Template::executeModuleTemplate($this->moduleName, "versions.php");
        }
        
        $version = basename($version);
        $file = Path::resolve("ULICMS_ROOT/patches/lists/{$version}.txt");
        if (! file_exists($file)) {
            throw new Exception("File not found");
        }
        $lines = StringHelper::linesFromFile($file);
        $patches = array();
        foreach ($lines as $line) {
            $splitted = explode("|", $line);
            $splitted = array_map('trim', $splitted);
            $patch = new PatchDownload();
            $patch->name = $splitted[0];
            $patch->description = $splitted[1];
            $patch->url = $splitted[2];
            $patches[] = $patch;
        }
        
        ViewBag::set("patches", $patches);
        
        return Template::executeModuleTemplate($this->moduleName, "patches.php");
    }
}