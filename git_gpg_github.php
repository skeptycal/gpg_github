#!/usr/bin/env php
<?php
/**
 * Setup_Gpg_Github.php
 *
 * Setup git environment variable and share public key with GitHub
 *
 * PHP version 7.3.1 (cli) (built: Jan 10 2019 13:15:37) ( NTS )
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
 * @version   1.1
 * @link      https://github.com/Skeptycal
 */
#!/usr/bin/env php

/*
 * @author    Michael Treanor  <skeptycal@gmail.com>
 * @copyright 2018 (C) Michael Treanor
 * @license   GPLv3+: GNU GPL version 3 or later <https://gnu.org/licenses/gpl.html>
 * @version   1.1
 * @link      https://github.com/skeptycal
 */

require_once 'git_gpg.php';

// ! First time key setup add
execit('gpg --edit-key '.$gpg_code);

// export public key
execit("gpg --armor --export ".$gpg_code);

echo "\n\nThis PGP Public Key Block should be shared with GitHub.";
echo "\n\nThe git default userid, email, and signing key have been setup.\n";

// Set git defaults
execit("git config --global user.signingkey ".$gpg_code);

// Setup environment variable
execit("$(export GPG_TTY=$(tty))");

// Bypass if not CLI for some reason
if (php_sapi_name() == 'cli-server') {
    return false; // exit with resource unchanged.
}
/*
 * Based on GitHub instructions "Telling Git about your signing key"
 * https://help.github.com/articles/telling-git-about-your-signing-key/
 *
 * And: "Generating a new GPG key"
 * https://help.github.com/articles/generating-a-new-gpg-key/
 */
