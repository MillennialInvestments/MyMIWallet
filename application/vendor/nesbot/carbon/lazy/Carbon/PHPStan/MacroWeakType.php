<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\PHPStan;

if (!class_exists(LazyMacro::class, false)) {
    abstract class LazyMacro extends AbstractReflectionMacro
    {
        /**
         * {@inheritdoc}
         *
         * @return string|false
         */
        public function getFileName()
        {
<<<<<<< HEAD
            $file = $this->reflectionFunction->getFileName();

            return (($file ? realpath($file) : null) ?: $file) ?: null;
=======
            return $this->reflectionFunction->getFileName();
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        }

        /**
         * {@inheritdoc}
         *
         * @return int|false
         */
        public function getStartLine()
        {
            return $this->reflectionFunction->getStartLine();
        }

        /**
         * {@inheritdoc}
         *
         * @return int|false
         */
        public function getEndLine()
        {
            return $this->reflectionFunction->getEndLine();
        }
    }
}
