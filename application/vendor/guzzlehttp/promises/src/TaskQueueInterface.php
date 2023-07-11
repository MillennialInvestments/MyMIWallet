<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
namespace GuzzleHttp\Promise;

interface TaskQueueInterface
{
    /**
     * Returns true if the queue is empty.
<<<<<<< HEAD
     */
    public function isEmpty(): bool;
=======
     *
     * @return bool
     */
    public function isEmpty();
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

    /**
     * Adds a task to the queue that will be executed the next time run is
     * called.
     */
<<<<<<< HEAD
    public function add(callable $task): void;
=======
    public function add(callable $task);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

    /**
     * Execute all of the pending task in the queue.
     */
<<<<<<< HEAD
    public function run(): void;
=======
    public function run();
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
}
