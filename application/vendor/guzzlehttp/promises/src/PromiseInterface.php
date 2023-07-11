<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
namespace GuzzleHttp\Promise;

/**
 * A promise represents the eventual result of an asynchronous operation.
 *
 * The primary way of interacting with a promise is through its then method,
 * which registers callbacks to receive either a promise’s eventual value or
 * the reason why the promise cannot be fulfilled.
 *
<<<<<<< HEAD
 * @see https://promisesaplus.com/
 */
interface PromiseInterface
{
    public const PENDING = 'pending';
    public const FULFILLED = 'fulfilled';
    public const REJECTED = 'rejected';
=======
 * @link https://promisesaplus.com/
 */
interface PromiseInterface
{
    const PENDING = 'pending';
    const FULFILLED = 'fulfilled';
    const REJECTED = 'rejected';
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

    /**
     * Appends fulfillment and rejection handlers to the promise, and returns
     * a new promise resolving to the return value of the called handler.
     *
     * @param callable $onFulfilled Invoked when the promise fulfills.
     * @param callable $onRejected  Invoked when the promise is rejected.
<<<<<<< HEAD
=======
     *
     * @return PromiseInterface
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
     */
    public function then(
        callable $onFulfilled = null,
        callable $onRejected = null
<<<<<<< HEAD
    ): PromiseInterface;
=======
    );
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

    /**
     * Appends a rejection handler callback to the promise, and returns a new
     * promise resolving to the return value of the callback if it is called,
     * or to its original fulfillment value if the promise is instead
     * fulfilled.
     *
     * @param callable $onRejected Invoked when the promise is rejected.
<<<<<<< HEAD
     */
    public function otherwise(callable $onRejected): PromiseInterface;
=======
     *
     * @return PromiseInterface
     */
    public function otherwise(callable $onRejected);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

    /**
     * Get the state of the promise ("pending", "rejected", or "fulfilled").
     *
     * The three states can be checked against the constants defined on
     * PromiseInterface: PENDING, FULFILLED, and REJECTED.
<<<<<<< HEAD
     */
    public function getState(): string;
=======
     *
     * @return string
     */
    public function getState();
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

    /**
     * Resolve the promise with the given value.
     *
     * @param mixed $value
     *
     * @throws \RuntimeException if the promise is already resolved.
     */
<<<<<<< HEAD
    public function resolve($value): void;
=======
    public function resolve($value);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

    /**
     * Reject the promise with the given reason.
     *
     * @param mixed $reason
     *
     * @throws \RuntimeException if the promise is already resolved.
     */
<<<<<<< HEAD
    public function reject($reason): void;
=======
    public function reject($reason);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

    /**
     * Cancels the promise if possible.
     *
<<<<<<< HEAD
     * @see https://github.com/promises-aplus/cancellation-spec/issues/7
     */
    public function cancel(): void;
=======
     * @link https://github.com/promises-aplus/cancellation-spec/issues/7
     */
    public function cancel();
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

    /**
     * Waits until the promise completes if possible.
     *
     * Pass $unwrap as true to unwrap the result of the promise, either
     * returning the resolved value or throwing the rejected exception.
     *
     * If the promise cannot be waited on, then the promise will be rejected.
     *
<<<<<<< HEAD
=======
     * @param bool $unwrap
     *
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
     * @return mixed
     *
     * @throws \LogicException if the promise has no wait function or if the
     *                         promise does not settle after waiting.
     */
<<<<<<< HEAD
    public function wait(bool $unwrap = true);
=======
    public function wait($unwrap = true);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
}
