<?php

/*
 * This file is part of Chrome PHP.
 *
 * (c) Soufiane Ghzal <sghzal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HeadlessChromium;

class AutoDiscover
{
    /**
     * @var callable(): string
     */
    private $osFamily;

    /**
     * @param (callable(): string)|null $osFamily
     */
    public function __construct(?callable $osFamily = null)
    {
        $this->osFamily = $osFamily ?? function (): string {
            return \PHP_OS_FAMILY;
        };
    }

    public function guessChromeBinaryPath(): string
    {
        if (\array_key_exists('CHROME_PATH', $_SERVER)) {
            return $_SERVER['CHROME_PATH'];
        }

        switch (($this->osFamily)()) {
            case 'Darwin':
                return '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome';
            case 'Windows':
                return self::getFromRegistry() ?? '%ProgramFiles(x86)%\Google\Chrome\Application\chrome.exe';
            default:
<<<<<<< HEAD
                return null === self::shellExec('command -v google-chrome') ? 'chrome' : 'google-chrome';
=======
                return 'chrome';
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        }
    }

    private static function getFromRegistry(): ?string
    {
<<<<<<< HEAD
        $registryKey = self::shellExec(
            'reg query "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\App Paths\chrome.exe" /ve'
        );

        if (null === $registryKey) {
            return null;
        }

        \preg_match('/.:(?!.*:).*/', $registryKey, $matches);

        return $matches[0] ?? null;
    }

    private static function shellExec(string $command): ?string
    {
        try {
            $result = @\shell_exec($command);

            return \is_string($result) ? $result : null;
        } catch (\Throwable $e) {
            return null;
        }
=======
        try {
            $registryKey = \shell_exec(
                'reg query "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\App Paths\chrome.exe" /ve'
            );

            \preg_match('/.:(?!.*:).*/', $registryKey, $matches);

            if (isset($matches[0])) {
                return $matches[0];
            }
        } catch (\Throwable $e) {
        }

        return null;
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    }
}
