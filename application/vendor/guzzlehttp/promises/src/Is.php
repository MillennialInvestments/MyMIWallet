<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
namespace GuzzleHttp\Promise;

final class Is
{
    /**
     * Returns true if a promise is pending.
<<<<<<< HEAD
     */
    public static function pending(PromiseInterface $promise): bool
=======
     *
     * @return bool
     */
    public static function pending(PromiseInterface $promise)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return $promise->getState() === PromiseInterface::PENDING;
    }

    /**
     * Returns true if a promise is fulfilled or rejected.
<<<<<<< HEAD
     */
    public static function settled(PromiseInterface $promise): bool
=======
     *
     * @return bool
     */
    public static function settled(PromiseInterface $promise)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return $promise->getState() !== PromiseInterface::PENDING;
    }

    /**
     * Returns true if a promise is fulfilled.
<<<<<<< HEAD
     */
    public static function fulfilled(PromiseInterface $promise): bool
=======
     *
     * @return bool
     */
    public static function fulfilled(PromiseInterface $promise)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return $promise->getState() === PromiseInterface::FULFILLED;
    }

    /**
     * Returns true if a promise is rejected.
<<<<<<< HEAD
     */
    public static function rejected(PromiseInterface $promise): bool
=======
     *
     * @return bool
     */
    public static function rejected(PromiseInterface $promise)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return $promise->getState() === PromiseInterface::REJECTED;
    }
}
