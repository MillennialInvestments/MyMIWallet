<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
namespace GuzzleHttp\Promise;

/**
 * A promise that has been fulfilled.
 *
 * Thenning off of this promise will invoke the onFulfilled callback
 * immediately and ignore other callbacks.
<<<<<<< HEAD
 *
 * @final
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
 */
class FulfilledPromise implements PromiseInterface
{
    private $value;

<<<<<<< HEAD
    /**
     * @param mixed $value
     */
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    public function __construct($value)
    {
        if (is_object($value) && method_exists($value, 'then')) {
            throw new \InvalidArgumentException(
                'You cannot create a FulfilledPromise with a promise.'
            );
        }

        $this->value = $value;
    }

    public function then(
        callable $onFulfilled = null,
        callable $onRejected = null
<<<<<<< HEAD
    ): PromiseInterface {
=======
    ) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        // Return itself if there is no onFulfilled function.
        if (!$onFulfilled) {
            return $this;
        }

        $queue = Utils::queue();
        $p = new Promise([$queue, 'run']);
        $value = $this->value;
<<<<<<< HEAD
        $queue->add(static function () use ($p, $value, $onFulfilled): void {
=======
        $queue->add(static function () use ($p, $value, $onFulfilled) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            if (Is::pending($p)) {
                try {
                    $p->resolve($onFulfilled($value));
                } catch (\Throwable $e) {
                    $p->reject($e);
<<<<<<< HEAD
=======
                } catch (\Exception $e) {
                    $p->reject($e);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                }
            }
        });

        return $p;
    }

<<<<<<< HEAD
    public function otherwise(callable $onRejected): PromiseInterface
=======
    public function otherwise(callable $onRejected)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return $this->then(null, $onRejected);
    }

<<<<<<< HEAD
    public function wait(bool $unwrap = true)
=======
    public function wait($unwrap = true, $defaultDelivery = null)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return $unwrap ? $this->value : null;
    }

<<<<<<< HEAD
    public function getState(): string
=======
    public function getState()
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return self::FULFILLED;
    }

<<<<<<< HEAD
    public function resolve($value): void
    {
        if ($value !== $this->value) {
            throw new \LogicException('Cannot resolve a fulfilled promise');
        }
    }

    public function reject($reason): void
    {
        throw new \LogicException('Cannot reject a fulfilled promise');
    }

    public function cancel(): void
=======
    public function resolve($value)
    {
        if ($value !== $this->value) {
            throw new \LogicException("Cannot resolve a fulfilled promise");
        }
    }

    public function reject($reason)
    {
        throw new \LogicException("Cannot reject a fulfilled promise");
    }

    public function cancel()
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        // pass
    }
}
