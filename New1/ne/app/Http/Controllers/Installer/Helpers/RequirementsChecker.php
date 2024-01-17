<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.1   |
    |              on 2022-03-02 18:17:37              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
/*
* Copyright (C) Incevio Systems, Inc - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Munna Khan <help.zcart@gmail.com>, September 2018
*/
 namespace App\Http\Controllers\Installer\Helpers; class RequirementsChecker { private $_minPhpVersion = "\67\56\62\x2e\x30"; public function check(array $requirements) { $results = []; foreach ($requirements as $type => $requirement) { switch ($type) { case "\x70\x68\x70": foreach ($requirements[$type] as $requirement) { $results["\162\x65\161\165\x69\x72\145\155\x65\156\164\163"][$type][$requirement] = true; if (extension_loaded($requirement)) { goto tQOEl; } $results["\x72\x65\161\x75\x69\162\145\x6d\145\x6e\164\163"][$type][$requirement] = false; $results["\x65\x72\162\157\162\163"] = true; tQOEl: zJ74A: } t6p3G: goto Os4OL; case "\141\x70\141\x63\150\x65": foreach ($requirements[$type] as $requirement) { if (!function_exists("\x61\160\141\143\150\x65\137\147\x65\x74\137\x6d\157\x64\165\154\x65\163")) { goto e6yCh; } $results["\162\x65\x71\x75\151\x72\x65\155\x65\x6e\x74\x73"][$type][$requirement] = true; if (in_array($requirement, apache_get_modules())) { goto MjQC8; } $results["\x72\x65\x71\x75\x69\162\x65\x6d\x65\156\x74\163"][$type][$requirement] = false; $results["\x65\x72\162\157\x72\163"] = true; MjQC8: e6yCh: OppCH: } UxdMj: goto Os4OL; } Hy8V2: Os4OL: FWnL1: } Bp1Ow: return $results; } public function checkPHPversion(string $minPhpVersion = null, string $maxPhpVersion = null) { $currentPhpVersion = $this->getPhpVersionInfo(); $supported = false; if (!($minPhpVersion == null)) { goto HdJDi; } $minPhpVersion = $this->getMinPhpVersion(); HdJDi: if ($maxPhpVersion == null && version_compare($currentPhpVersion["\x76\145\162\163\151\157\156"], $minPhpVersion, "\x3e\75")) { goto lD3Jm; } if (version_compare($currentPhpVersion["\166\x65\x72\163\151\157\x6e"], $minPhpVersion, "\76\x3d") && version_compare($currentPhpVersion["\x76\x65\x72\163\151\157\156"], $maxPhpVersion, "\74\x3d")) { goto WrQAX; } goto z054C; lD3Jm: $supported = true; goto z054C; WrQAX: $supported = true; z054C: $phpStatus = ["\x66\165\154\x6c" => $currentPhpVersion["\x66\x75\x6c\x6c"], "\x63\165\162\162\145\x6e\164" => $currentPhpVersion["\166\x65\162\163\x69\157\156"], "\155\151\156\x69\155\x75\x6d" => $minPhpVersion, "\155\141\170\151\x6d\165\155" => $maxPhpVersion, "\x73\165\160\x70\157\x72\164\145\x64" => $supported]; return $phpStatus; } private static function getPhpVersionInfo() { $currentVersionFull = PHP_VERSION; preg_match("\43\x5e\134\x64\53\x28\x5c\x2e\x5c\x64\53\x29\x2a\x23", $currentVersionFull, $filtered); $currentVersion = $filtered[0]; return ["\146\165\x6c\x6c" => $currentVersionFull, "\x76\145\162\163\x69\x6f\x6e" => $currentVersion]; } protected function getMinPhpVersion() { return $this->_minPhpVersion; } }