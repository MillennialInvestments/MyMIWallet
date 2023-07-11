<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
namespace GuzzleHttp\Promise;

/**
 * A task queue that executes tasks in a FIFO order.
 *
 * This task queue class is used to settle promises asynchronously and
 * maintains a constant stack size. You can use the task queue asynchronously
 * by calling the `run()` function of the global task queue in an event loop.
 *
 *     GuzzleHttp\Promise\Utils::queue()->run();
<<<<<<< HEAD
 *
 * @final
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
 */
class TaskQueue implements TaskQueueInterface
{
    private $enableShutdown = true;
    private $queue = [];

<<<<<<< HEAD
    public function __construct(bool $withShutdown = true)
    {
        if ($withShutdown) {
            register_shutdown_function(function (): void {
=======
    public function __construct($withShutdown = true)
    {
        if ($withShutdown) {
            register_shutdown_function(function () {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                if ($this->enableShutdown) {
                    // Only run the tasks if an E_ERROR didn't occur.
                    $err = error_get_last();
                    if (!$err || ($err['type'] ^ E_ERROR)) {
                        $this->run();
                    }
                }
            });
        }
    }

<<<<<<< HEAD
    public function isEmpty(): bool
=======
    public function isEmpty()
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        return !$this->queue;
    }

<<<<<<< HEAD
    public function add(callable $task): void
=======
    public function add(callable $task)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        $this->queue[] = $task;
    }

<<<<<<< HEAD
    public function run(): void
=======
    public function run()
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        while ($task = array_shift($this->queue)) {
            /** @var callable $task */
            $task();
        }
    }

    /**
     * The task queue will be run and exhausted by default when the process
     * exits IFF the exit is not the result of a PHP E_ERROR error.
     *
     * You can disable running the automatic shutdown of the queue by calling
     * this function. If you disable the task queue shutdown process, then you
     * MUST either run the task queue (as a result of running your event loop
     * or manually using the run() method) or wait on each outstanding promise.
     *
     * Note: This shutdown will occur before any destructors are triggered.
     */
<<<<<<< HEAD
    public function disableShutdown(): void
=======
    public function disableShutdown()
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        $this->enableShutdown = false;
    }
}
