<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
namespace GuzzleHttp\Promise;

final class Create
{
    /**
     * Creates a promise for a value if the value is not a promise.
     *
     * @param mixed $value Promise or value.
<<<<<<< HEAD
     */
    public static function promiseFor($value): PromiseInterface
=======
     *
     * @return PromiseInterface
     */
    public static function promiseFor($value)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        if ($value instanceof PromiseInterface) {
            return $value;
        }

        // Return a Guzzle promise that shadows the given promise.
        if (is_object($value) && method_exists($value, 'then')) {
            $wfn = method_exists($value, 'wait') ? [$value, 'wait'] : null;
            $cfn = method_exists($value, 'cancel') ? [$value, 'cancel'] : null;
            $promise = new Promise($wfn, $cfn);
            $value->then([$promise, 'resolve'], [$promise, 'reject']);
<<<<<<< HEAD

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            return $promise;
        }

        return new FulfilledPromise($value);
    }

    /**
     * Creates a rejected promise for a reason if the reason is not a promise.
     * If the provided reason is a promise, then it is returned as-is.
     *
     * @param mixed $reason Promise or reason.
<<<<<<< HEAD
     */
    public static function rejectionFor($reason): PromiseInterface
=======
     *
     * @return PromiseInterface
     */
    public static function rejectionFor($reason)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        if ($reason instanceof PromiseInterface) {
            return $reason;
        }

        return new RejectedPromise($reason);
    }

    /**
     * Create an exception for a rejected promise value.
     *
     * @param mixed $reason
<<<<<<< HEAD
     */
    public static function exceptionFor($reason): \Throwable
    {
        if ($reason instanceof \Throwable) {
=======
     *
     * @return \Exception|\Throwable
     */
    public static function exceptionFor($reason)
    {
        if ($reason instanceof \Exception || $reason instanceof \Throwable) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            return $reason;
        }

        return new RejectionException($reason);
    }

    /**
     * Returns an iterator for the given value.
     *
     * @param mixed $value
<<<<<<< HEAD
     */
    public static function iterFor($value): \Iterator
=======
     *
     * @return \Iterator
     */
    public static function iterFor($value)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        if ($value instanceof \Iterator) {
            return $value;
        }

        if (is_array($value)) {
            return new \ArrayIterator($value);
        }

        return new \ArrayIterator([$value]);
    }
}
