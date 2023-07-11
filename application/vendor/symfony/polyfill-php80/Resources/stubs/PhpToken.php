<?php

<<<<<<< HEAD
/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (\PHP_VERSION_ID < 80000 && extension_loaded('tokenizer')) {
=======
if (\PHP_VERSION_ID < 80000 && \extension_loaded('tokenizer')) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    class PhpToken extends Symfony\Polyfill\Php80\PhpToken
    {
    }
}
