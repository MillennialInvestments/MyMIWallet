<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
namespace GuzzleHttp\Promise;

/**
 * Exception thrown when too many errors occur in the some() or any() methods.
 */
class AggregateException extends RejectionException
{
<<<<<<< HEAD
    public function __construct(string $msg, array $reasons)
=======
    public function __construct($msg, array $reasons)
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    {
        parent::__construct(
            $reasons,
            sprintf('%s; %d rejected promises', $msg, count($reasons))
        );
    }
}
