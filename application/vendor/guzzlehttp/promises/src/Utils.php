<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
namespace GuzzleHttp\Promise;

final class Utils
{
    /**
     * Get the global task queue used for promise resolution.
     *
     * This task queue MUST be run in an event loop in order for promises to be
     * settled asynchronously. It will be automatically run when synchronously
     * waiting on a promise.
     *
     * <code>
     * while ($eventLoop->isRunning()) {
     *     GuzzleHttp\Promise\Utils::queue()->run();
     * }
     * </code>
     *
<<<<<<< HEAD
     * @param TaskQueueInterface|null $assign Optionally specify a new queue instance.
     */
    public static function queue(TaskQueueInterface $assign = null): TaskQueueInterface
=======
     * @param TaskQueueInterface $assign Optionally specify a new queue instance.
     *
     * @return TaskQueueInterface
     */
    public static function queue(TaskQueueInterface $assign = null)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        static $queue;

        if ($assign) {
            $queue = $assign;
        } elseif (!$queue) {
            $queue = new TaskQueue();
        }

        return $queue;
    }

    /**
     * Adds a function to run in the task queue when it is next `run()` and
     * returns a promise that is fulfilled or rejected with the result.
     *
     * @param callable $task Task function to run.
<<<<<<< HEAD
     */
    public static function task(callable $task): PromiseInterface
    {
        $queue = self::queue();
        $promise = new Promise([$queue, 'run']);
        $queue->add(function () use ($task, $promise): void {
=======
     *
     * @return PromiseInterface
     */
    public static function task(callable $task)
    {
        $queue = self::queue();
        $promise = new Promise([$queue, 'run']);
        $queue->add(function () use ($task, $promise) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            try {
                if (Is::pending($promise)) {
                    $promise->resolve($task());
                }
            } catch (\Throwable $e) {
                $promise->reject($e);
<<<<<<< HEAD
=======
            } catch (\Exception $e) {
                $promise->reject($e);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            }
        });

        return $promise;
    }

    /**
     * Synchronously waits on a promise to resolve and returns an inspection
     * state array.
     *
     * Returns a state associative array containing a "state" key mapping to a
     * valid promise state. If the state of the promise is "fulfilled", the
     * array will contain a "value" key mapping to the fulfilled value of the
     * promise. If the promise is rejected, the array will contain a "reason"
     * key mapping to the rejection reason of the promise.
     *
     * @param PromiseInterface $promise Promise or value.
<<<<<<< HEAD
     */
    public static function inspect(PromiseInterface $promise): array
=======
     *
     * @return array
     */
    public static function inspect(PromiseInterface $promise)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        try {
            return [
                'state' => PromiseInterface::FULFILLED,
<<<<<<< HEAD
                'value' => $promise->wait(),
=======
                'value' => $promise->wait()
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            ];
        } catch (RejectionException $e) {
            return ['state' => PromiseInterface::REJECTED, 'reason' => $e->getReason()];
        } catch (\Throwable $e) {
            return ['state' => PromiseInterface::REJECTED, 'reason' => $e];
<<<<<<< HEAD
=======
        } catch (\Exception $e) {
            return ['state' => PromiseInterface::REJECTED, 'reason' => $e];
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        }
    }

    /**
     * Waits on all of the provided promises, but does not unwrap rejected
     * promises as thrown exception.
     *
     * Returns an array of inspection state arrays.
     *
     * @see inspect for the inspection state array format.
     *
     * @param PromiseInterface[] $promises Traversable of promises to wait upon.
<<<<<<< HEAD
     */
    public static function inspectAll($promises): array
    {
        $results = [];
        foreach ($promises as $key => $promise) {
            $results[$key] = self::inspect($promise);
=======
     *
     * @return array
     */
    public static function inspectAll($promises)
    {
        $results = [];
        foreach ($promises as $key => $promise) {
            $results[$key] = inspect($promise);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        }

        return $results;
    }

    /**
     * Waits on all of the provided promises and returns the fulfilled values.
     *
     * Returns an array that contains the value of each promise (in the same
     * order the promises were provided). An exception is thrown if any of the
     * promises are rejected.
     *
     * @param iterable<PromiseInterface> $promises Iterable of PromiseInterface objects to wait on.
     *
<<<<<<< HEAD
     * @throws \Throwable on error
     */
    public static function unwrap($promises): array
=======
     * @return array
     *
     * @throws \Exception on error
     * @throws \Throwable on error in PHP >=7
     */
    public static function unwrap($promises)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        $results = [];
        foreach ($promises as $key => $promise) {
            $results[$key] = $promise->wait();
        }

        return $results;
    }

    /**
     * Given an array of promises, return a promise that is fulfilled when all
     * the items in the array are fulfilled.
     *
     * The promise's fulfillment value is an array with fulfillment values at
     * respective positions to the original array. If any promise in the array
     * rejects, the returned promise is rejected with the rejection reason.
     *
     * @param mixed $promises  Promises or values.
     * @param bool  $recursive If true, resolves new promises that might have been added to the stack during its own resolution.
<<<<<<< HEAD
     */
    public static function all($promises, bool $recursive = false): PromiseInterface
=======
     *
     * @return PromiseInterface
     */
    public static function all($promises, $recursive = false)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        $results = [];
        $promise = Each::of(
            $promises,
<<<<<<< HEAD
            function ($value, $idx) use (&$results): void {
                $results[$idx] = $value;
            },
            function ($reason, $idx, Promise $aggregate): void {
=======
            function ($value, $idx) use (&$results) {
                $results[$idx] = $value;
            },
            function ($reason, $idx, Promise $aggregate) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                $aggregate->reject($reason);
            }
        )->then(function () use (&$results) {
            ksort($results);
<<<<<<< HEAD

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            return $results;
        });

        if (true === $recursive) {
            $promise = $promise->then(function ($results) use ($recursive, &$promises) {
                foreach ($promises as $promise) {
                    if (Is::pending($promise)) {
                        return self::all($promises, $recursive);
                    }
                }
<<<<<<< HEAD

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                return $results;
            });
        }

        return $promise;
    }

    /**
     * Initiate a competitive race between multiple promises or values (values
     * will become immediately fulfilled promises).
     *
     * When count amount of promises have been fulfilled, the returned promise
     * is fulfilled with an array that contains the fulfillment values of the
     * winners in order of resolution.
     *
     * This promise is rejected with a {@see AggregateException} if the number
     * of fulfilled promises is less than the desired $count.
     *
     * @param int   $count    Total number of promises.
     * @param mixed $promises Promises or values.
<<<<<<< HEAD
     */
    public static function some(int $count, $promises): PromiseInterface
=======
     *
     * @return PromiseInterface
     */
    public static function some($count, $promises)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        $results = [];
        $rejections = [];

        return Each::of(
            $promises,
<<<<<<< HEAD
            function ($value, $idx, PromiseInterface $p) use (&$results, $count): void {
=======
            function ($value, $idx, PromiseInterface $p) use (&$results, $count) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                if (Is::settled($p)) {
                    return;
                }
                $results[$idx] = $value;
                if (count($results) >= $count) {
                    $p->resolve(null);
                }
            },
<<<<<<< HEAD
            function ($reason) use (&$rejections): void {
=======
            function ($reason) use (&$rejections) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                $rejections[] = $reason;
            }
        )->then(
            function () use (&$results, &$rejections, $count) {
                if (count($results) !== $count) {
                    throw new AggregateException(
                        'Not enough promises to fulfill count',
                        $rejections
                    );
                }
                ksort($results);
<<<<<<< HEAD

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                return array_values($results);
            }
        );
    }

    /**
     * Like some(), with 1 as count. However, if the promise fulfills, the
     * fulfillment value is not an array of 1 but the value directly.
     *
     * @param mixed $promises Promises or values.
<<<<<<< HEAD
     */
    public static function any($promises): PromiseInterface
=======
     *
     * @return PromiseInterface
     */
    public static function any($promises)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return self::some(1, $promises)->then(function ($values) {
            return $values[0];
        });
    }

    /**
     * Returns a promise that is fulfilled when all of the provided promises have
     * been fulfilled or rejected.
     *
     * The returned promise is fulfilled with an array of inspection state arrays.
     *
     * @see inspect for the inspection state array format.
     *
     * @param mixed $promises Promises or values.
<<<<<<< HEAD
     */
    public static function settle($promises): PromiseInterface
=======
     *
     * @return PromiseInterface
     */
    public static function settle($promises)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        $results = [];

        return Each::of(
            $promises,
<<<<<<< HEAD
            function ($value, $idx) use (&$results): void {
                $results[$idx] = ['state' => PromiseInterface::FULFILLED, 'value' => $value];
            },
            function ($reason, $idx) use (&$results): void {
=======
            function ($value, $idx) use (&$results) {
                $results[$idx] = ['state' => PromiseInterface::FULFILLED, 'value' => $value];
            },
            function ($reason, $idx) use (&$results) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                $results[$idx] = ['state' => PromiseInterface::REJECTED, 'reason' => $reason];
            }
        )->then(function () use (&$results) {
            ksort($results);
<<<<<<< HEAD

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            return $results;
        });
    }
}
