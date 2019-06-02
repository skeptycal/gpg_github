#!/usr/bin/env php
<?php
/**
 * Use regex to extract gpg secret key from gpg function
 *   Caveat: this will select only the first matching key
 *
 * PHP version 7.3.1 (cli) (built: Jan 10 2019 13:15:37)
 *
 * gpg (GnuPG) 2.2.12
 * libgcrypt 1.8.4
 * License GPLv3+: GNU GPL version 3 or later
 * <https://gnu.org/licenses/gpl.html>
 * This is free software: you are free to change and redistribute it.
 * There is NO WARRANTY, to the extent permitted by law.
 *
 * @author    Michael Treanor  <skeptycal@gmail.com>
 * @copyright 2018 (C) Michael Treanor
 * @license   GPLv3+: GNU GPL version 3 or later <https://gnu.org/licenses/gpl.html>
 * @version   Git <2.21>
 * @link      https://github.com/skeptycal
 */

/**
  * A summary informing the user what the associated element does.
  *
  * A *description*, that can span multiple lines, to go _in-depth_ into the details of this element
  * and to provide some background information or textual references.
  *
  * @param string $myArgument With a *description* of this argument, these may also
  *    span multiple lines.
  *
  * @return void
  */

function Func_Get_gpg()
{
    $pattern = '/^.*sec.{3}rsa4096\/(\w{16}+)/im';
    $target = `gpg --list-secret-keys --keyid-format LONG`;
    $gpg_out = "";
    preg_match_all($pattern, $target, $gpg_out);
    return implode("", $gpg_out[1]);
}

// $gpg_code = func_get_gpg();

// If CLI echo $gpg_code
if (php_sapi_name() == 'cli-server') {
    echo func_get_gpg();
    return true; // exit with resource unchanged.
}

/*
 * Based on GitHub instructions "Telling Git about your signing key"
 * https://help.github.com/articles/telling-git-about-your-signing-key/
 *
 * And: "Generating a new GPG key"
 * https://help.github.com/articles/generating-a-new-gpg-key/
 *
 * This works with 4096 keys:
 *   if you wish to use it with other keys,
 *   replace 'rsa4096' in $patterh with the appropriate number
 */

/* Changelog:
 * 1.1 Refactored and created a function that returns the value
 * instead of a local string. Added CLI codeblock to echo value
 * if run from command line
 *
 * 1.0 Creates a variable that contains the extracted gpg private
 * code from the local key.
 */
