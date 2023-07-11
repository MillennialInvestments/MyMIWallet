<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\PHPStan;

<<<<<<< HEAD
use PHPStan\Reflection\Assertions;
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Reflection\Php\PhpMethodReflectionFactory;
<<<<<<< HEAD
use PHPStan\Reflection\ReflectionProvider;
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
use PHPStan\Type\TypehintHelper;

/**
 * Class MacroExtension.
 *
 * @codeCoverageIgnore Pure PHPStan wrapper.
 */
final class MacroExtension implements MethodsClassReflectionExtension
{
    /**
     * @var PhpMethodReflectionFactory
     */
    protected $methodReflectionFactory;

    /**
     * @var MacroScanner
     */
    protected $scanner;

    /**
     * Extension constructor.
     *
     * @param PhpMethodReflectionFactory $methodReflectionFactory
<<<<<<< HEAD
     * @param ReflectionProvider         $reflectionProvider
     */
    public function __construct(
        PhpMethodReflectionFactory $methodReflectionFactory,
        ReflectionProvider $reflectionProvider
    ) {
        $this->scanner = new MacroScanner($reflectionProvider);
=======
     */
    public function __construct(PhpMethodReflectionFactory $methodReflectionFactory)
    {
        $this->scanner = new MacroScanner();
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        $this->methodReflectionFactory = $methodReflectionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        return $this->scanner->hasMethod($classReflection->getName(), $methodName);
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        $builtinMacro = $this->scanner->getMethod($classReflection->getName(), $methodName);
<<<<<<< HEAD
        $supportAssertions = class_exists(Assertions::class);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

        return $this->methodReflectionFactory->create(
            $classReflection,
            null,
            $builtinMacro,
            $classReflection->getActiveTemplateTypeMap(),
            [],
            TypehintHelper::decideTypeFromReflection($builtinMacro->getReturnType()),
            null,
            null,
            $builtinMacro->isDeprecated()->yes(),
            $builtinMacro->isInternal(),
            $builtinMacro->isFinal(),
<<<<<<< HEAD
            $supportAssertions ? null : $builtinMacro->getDocComment(),
            $supportAssertions ? Assertions::createEmpty() : null,
            null,
            $builtinMacro->getDocComment(),
            []
=======
            $builtinMacro->getDocComment()
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        );
    }
}
