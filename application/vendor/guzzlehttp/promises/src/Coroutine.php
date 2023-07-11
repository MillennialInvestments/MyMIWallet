<?php

<<<<<<< HEAD
declare(strict_types=1);

namespace GuzzleHttp\Promise;

=======
namespace GuzzleHttp\Promise;

use Exception;
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
use Generator;
use Throwable;

/**
 * Creates a promise that is resolved using a generator that yields values or
 * promises (somewhat similar to C#'s async keyword).
 *
 * When called, the Coroutine::of method will start an instance of the generator
 * and returns a promise that is fulfilled with its final yielded value.
 *
 * Control is returned back to the generator when the yielded promise settles.
 * This can lead to less verbose code when doing lots of sequential async calls
 * with minimal processing in between.
 *
 *     use GuzzleHttp\Promise;
 *
 *     function createPromise($value) {
 *         return new Promise\FulfilledPromise($value);
 *     }
 *
 *     $promise = Promise\Coroutine::of(function () {
 *         $value = (yield createPromise('a'));
 *         try {
 *             $value = (yield createPromise($value . 'b'));
<<<<<<< HEAD
 *         } catch (\Throwable $e) {
=======
 *         } catch (\Exception $e) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
 *             // The promise was rejected.
 *         }
 *         yield $value . 'c';
 *     });
 *
 *     // Outputs "abc"
 *     $promise->then(function ($v) { echo $v; });
 *
 * @param callable $generatorFn Generator function to wrap into a promise.
 *
 * @return Promise
 *
<<<<<<< HEAD
 * @see https://github.com/petkaantonov/bluebird/blob/master/API.md#generators inspiration
=======
 * @link https://github.com/petkaantonov/bluebird/blob/master/API.md#generators inspiration
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
 */
final class Coroutine implements PromiseInterface
{
    /**
     * @var PromiseInterface|null
     */
    private $currentPromise;

    /**
     * @var Generator
     */
    private $generator;

    /**
     * @var Promise
     */
    private $result;

    public function __construct(callable $generatorFn)
    {
        $this->generator = $generatorFn();
<<<<<<< HEAD
        $this->result = new Promise(function (): void {
=======
        $this->result = new Promise(function () {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            while (isset($this->currentPromise)) {
                $this->currentPromise->wait();
            }
        });
        try {
            $this->nextCoroutine($this->generator->current());
<<<<<<< HEAD
=======
        } catch (\Exception $exception) {
            $this->result->reject($exception);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        } catch (Throwable $throwable) {
            $this->result->reject($throwable);
        }
    }

    /**
     * Create a new coroutine.
<<<<<<< HEAD
     */
    public static function of(callable $generatorFn): self
=======
     *
     * @return self
     */
    public static function of(callable $generatorFn)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return new self($generatorFn);
    }

    public function then(
        callable $onFulfilled = null,
        callable $onRejected = null
<<<<<<< HEAD
    ): PromiseInterface {
        return $this->result->then($onFulfilled, $onRejected);
    }

    public function otherwise(callable $onRejected): PromiseInterface
=======
    ) {
        return $this->result->then($onFulfilled, $onRejected);
    }

    public function otherwise(callable $onRejected)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return $this->result->otherwise($onRejected);
    }

<<<<<<< HEAD
    public function wait(bool $unwrap = true)
=======
    public function wait($unwrap = true)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return $this->result->wait($unwrap);
    }

<<<<<<< HEAD
    public function getState(): string
=======
    public function getState()
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return $this->result->getState();
    }

<<<<<<< HEAD
    public function resolve($value): void
=======
    public function resolve($value)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        $this->result->resolve($value);
    }

<<<<<<< HEAD
    public function reject($reason): void
=======
    public function reject($reason)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        $this->result->reject($reason);
    }

<<<<<<< HEAD
    public function cancel(): void
=======
    public function cancel()
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        $this->currentPromise->cancel();
        $this->result->cancel();
    }

<<<<<<< HEAD
    private function nextCoroutine($yielded): void
=======
    private function nextCoroutine($yielded)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        $this->currentPromise = Create::promiseFor($yielded)
            ->then([$this, '_handleSuccess'], [$this, '_handleFailure']);
    }

    /**
     * @internal
     */
<<<<<<< HEAD
    public function _handleSuccess($value): void
=======
    public function _handleSuccess($value)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        unset($this->currentPromise);
        try {
            $next = $this->generator->send($value);
            if ($this->generator->valid()) {
                $this->nextCoroutine($next);
            } else {
                $this->result->resolve($value);
            }
<<<<<<< HEAD
=======
        } catch (Exception $exception) {
            $this->result->reject($exception);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        } catch (Throwable $throwable) {
            $this->result->reject($throwable);
        }
    }

    /**
     * @internal
     */
<<<<<<< HEAD
    public function _handleFailure($reason): void
=======
    public function _handleFailure($reason)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        unset($this->currentPromise);
        try {
            $nextYield = $this->generator->throw(Create::exceptionFor($reason));
            // The throw was caught, so keep iterating on the coroutine
            $this->nextCoroutine($nextYield);
<<<<<<< HEAD
=======
        } catch (Exception $exception) {
            $this->result->reject($exception);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        } catch (Throwable $throwable) {
            $this->result->reject($throwable);
        }
    }
}
