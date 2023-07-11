<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
namespace GuzzleHttp\Promise;

/**
 * A promise that has been rejected.
 *
 * Thenning off of this promise will invoke the onRejected callback
 * immediately and ignore other callbacks.
<<<<<<< HEAD
 *
 * @final
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
 */
class RejectedPromise implements PromiseInterface
{
    private $reason;

<<<<<<< HEAD
    /**
     * @param mixed $reason
     */
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    public function __construct($reason)
    {
        if (is_object($reason) && method_exists($reason, 'then')) {
            throw new \InvalidArgumentException(
                'You cannot create a RejectedPromise with a promise.'
            );
        }

        $this->reason = $reason;
    }

    public function then(
        callable $onFulfilled = null,
        callable $onRejected = null
<<<<<<< HEAD
    ): PromiseInterface {
=======
    ) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        // If there's no onRejected callback then just return self.
        if (!$onRejected) {
            return $this;
        }

        $queue = Utils::queue();
        $reason = $this->reason;
        $p = new Promise([$queue, 'run']);
<<<<<<< HEAD
        $queue->add(static function () use ($p, $reason, $onRejected): void {
=======
        $queue->add(static function () use ($p, $reason, $onRejected) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            if (Is::pending($p)) {
                try {
                    // Return a resolved promise if onRejected does not throw.
                    $p->resolve($onRejected($reason));
                } catch (\Throwable $e) {
                    // onRejected threw, so return a rejected promise.
                    $p->reject($e);
<<<<<<< HEAD
=======
                } catch (\Exception $e) {
                    // onRejected threw, so return a rejected promise.
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
        if ($unwrap) {
            throw Create::exceptionFor($this->reason);
        }

        return null;
    }

<<<<<<< HEAD
    public function getState(): string
=======
    public function getState()
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return self::REJECTED;
    }

<<<<<<< HEAD
    public function resolve($value): void
    {
        throw new \LogicException('Cannot resolve a rejected promise');
    }

    public function reject($reason): void
    {
        if ($reason !== $this->reason) {
            throw new \LogicException('Cannot reject a rejected promise');
        }
    }

    public function cancel(): void
=======
    public function resolve($value)
    {
        throw new \LogicException("Cannot resolve a rejected promise");
    }

    public function reject($reason)
    {
        if ($reason !== $this->reason) {
            throw new \LogicException("Cannot reject a rejected promise");
        }
    }

    public function cancel()
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        // pass
    }
}
