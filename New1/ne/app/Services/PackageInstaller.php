<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.1   |
    |              on 2022-03-02 18:17:50              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
/*
* Copyright (C) Incevio Systems, Inc - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Munna Khan <help.zcart@gmail.com>, September 2018
*/
 namespace App\Services; use App\Models\Package; use Illuminate\Support\Facades\DB; use Illuminate\Http\Request; use Illuminate\Support\Arr; use Illuminate\Support\Str; use Illuminate\Support\Facades\Log; use Illuminate\Support\Facades\Artisan; use Illuminate\Support\MessageBag; class PackageInstaller { public $package; public $slug; public $namespace; public $path; public $migrations; public function __construct(Request $request, array $installable) { $this->package = array_merge($installable, $request->all()); $this->slug = $installable["\163\x6c\165\147"]; $this->namespace = "\134\x49\x6e\143\x65\x76\x69\157\134\120\x61\143\153\141\x67\145\x5c" . Str::studly(Str::replace("\55", "\x5f", $this->slug)); $this->path = $installable["\x70\x61\x74\x68"]; $this->migrations = str_replace(base_path(), '', $this->path . "\x2f\x64\x61\x74\x61\142\x61\163\145\57\x6d\x69\147\162\141\x74\151\157\x6e\163"); } public function install() { Log::info("\111\x6e\x73\x74\141\x6c\x6c\151\156\x67\x20\160\141\x63\153\141\147\145\40" . $this->slug); try { $package_data = array_merge($this->package, preparePackageInstallation($this->package)); Package::create($package_data); $this->migrate()->seed(); } catch (\Exception $exception) { Log::info("\120\141\x63\153\x61\x67\145\40\x69\156\x73\164\141\154\154\x61\164\151\157\x6e\40\x66\141\x69\x6c\x65\x64\40" . $this->slug); Log::error(get_exception_message($exception)); throw new \Exception("\120\x61\143\x6b\141\x67\x65\40\111\x6e\x73\164\141\x6c\154\x61\x74\151\x6f\156\40\106\x61\x69\x6c\145\144\x20" . $this->slug); } Log::info("\x53\x75\143\x63\145\x73\163\x66\x75\154\154\x79\x20\151\156\x73\x74\141\x6c\154\145\144\40\160\141\x63\x6b\x61\x67\145\x20" . $this->slug); return true; } private function migrate() { Log::info("\x4d\x69\x67\x72\141\x74\151\x6f\x6e\x20\163\x74\x61\162\x74\145\x64\x20\x66\157\x72\x20" . $this->slug); Artisan::call("\x6d\x69\147\162\141\164\x65", ["\55\55\x70\141\164\x68" => $this->migrations, "\55\x2d\146\x6f\x72\143\x65" => true]); Log::info(Artisan::output()); return $this; } private function seed() { Log::info("\x53\x65\x65\x64\x69\156\147\x20\x70\x61\x63\153\141\x67\145\x20\x64\x61\164\141\40\x66\x6f\162\x20" . $this->slug); foreach (glob($this->path . "\57\144\x61\x74\141\x62\141\x73\x65\57\163\145\x65\144\163\57\52\56\x70\150\160") as $filename) { $classes = get_declared_classes(); include $filename; $temp = array_diff(get_declared_classes(), $classes); $migration = Arr::last($temp, function ($value, $key) { return $value !== "\111\154\154\x75\155\151\156\141\164\145\134\x44\x61\164\141\142\x61\163\x65\134\123\145\x65\x64\x65\x72"; }); Artisan::call("\x64\142\72\163\145\x65\144", ["\x2d\x2d\x63\x6c\x61\x73\x73" => $migration, "\x2d\55\x66\157\x72\143\145" => true]); Log::info(Artisan::output()); iayRw: } J53sx: return $this; } public function uninstall() { Log::info("\x55\156\151\x6e\x73\x74\x61\154\x6c\151\x6e\x67\x20\x50\141\143\153\141\147\x65\72\x20" . $this->slug); $file = $this->path . "\57\163\162\x63\57\x55\156\x69\x6e\x73\164\x61\x6c\154\x65\162\56\160\x68\160"; if (!file_exists($file)) { goto IK_bS; } include $file; IK_bS: $class = $this->namespace . "\x5c\x55\156\151\x6e\163\164\x61\x6c\x6c\145\x72"; if (class_exists($class)) { goto f4Lqc; } Log::info("\x55\x6e\151\156\163\x74\x61\x6c\154\x65\162\x20\x6e\157\x74\40\146\x6f\165\x6e\x64\x20\151\156\40\164\x68\x65\x20\x70\141\x63\153\x61\147\145\40\144\x69\162\x20\x66\x6f\162\40" . $this->slug); throw new \Exception("\x55\156\151\x6e\163\x74\x61\x6c\154\x65\162\x20\156\x6f\x74\40\x66\x6f\165\x6e\144\40\146\x6f\x72\x20\164\x68\x65\x20\x70\141\143\153\141\147\145\40" . $this->slug); f4Lqc: try { (new $class())->cleanDatabase(); $this->rollback(); } catch (\Exception $e) { Log::info("\x50\x61\x63\x6b\x61\x67\x65\40\165\x6e\x69\156\x73\x74\141\154\x6c\x61\164\151\157\156\x20\x66\x61\x69\154\x65\x64\x3a\x20" . $this->slug); throw new \Exception("\x55\x6e\x69\156\x73\164\x61\154\x6c\141\x74\x69\x6f\156\x20\x66\141\x69\x6c\x65\144\x3a\x20" . $this->slug); } Log::info("\x53\165\143\143\x65\163\163\x66\x75\154\x6c\x79\x20\165\156\151\x6e\163\x74\141\154\x6c\145\x64\x20\x70\141\143\153\141\x67\x65\x20" . $this->slug); return $this; } private function rollback() { Log::info("\x52\157\154\154\40\142\x61\x63\x6b\x20\x63\x61\154\154\x65\x64\56\x2e\x2e"); $migrations = array_reverse(glob($this->path . "\57\x64\141\164\141\x62\x61\163\145\57\155\151\147\162\x61\164\x69\x6f\156\163\x2f\x2a\x5f\52\x2e\160\x68\160")); if (!empty($migrations)) { goto ZuVtl; } Log::info("\116\x6f\40\155\x69\x67\x72\x61\x74\151\x6f\156\40\x74\x6f\x20\x72\157\x6c\x6c\x20\142\x61\x63\153\40\146\157\x72\x20\x70\x61\143\x6b\x61\x67\145\x20" . $this->slug); return $this; ZuVtl: foreach ($migrations as $filename) { $migration = str_replace("\56\160\150\x70", '', basename($filename)); Log::info("\122\x6f\x6c\154\151\x6e\x67\40\x62\141\x63\x6b\x3a\x20" . $migration); $class = Str::studly(implode("\137", array_slice(explode("\x5f", $migration), 4))); if (class_exists($class)) { goto QxQ1B; } include $filename; QxQ1B: (new $class())->down(); if (DB::table("\x6d\x69\147\162\x61\164\x69\157\156\163")->where("\x6d\x69\x67\x72\141\x74\x69\x6f\156", $migration)->delete()) { goto o5XN6; } Log::info("\x52\x6f\x6c\x6c\142\141\x63\153\40\x46\x41\111\114\x45\x44\x3a\x20" . $migration); throw new \Exception("\x4d\x69\x67\162\x61\x74\x69\157\156\40\x72\x6f\x6c\154\x62\141\143\153\40\x66\141\x69\x6c\145\x64\72\40" . $this->slug); goto Oa709; o5XN6: Log::info("\122\x6f\154\x6c\145\x64\x20\x62\x61\143\x6b\72\x20" . $migration); Oa709: MgWgS: } lpfsM: Log::info("\x41\154\154\x20\155\x69\x67\162\x61\164\x69\x6f\x6e\163\x20\150\x61\x73\x20\142\145\145\156\40\162\157\154\x6c\x65\x64\x20\142\x61\x63\x6b\40\x66\x6f\162\40\x70\141\143\153\141\147\x65\40" . $this->slug); return $this; } }