<?php

namespace GuzzleHttp;

use GuzzleHttp\Promise as P;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Middleware that retries requests based on the boolean result of
 * invoking the provided "decider" function.
 *
 * @final
 */
class RetryMiddleware
{
    /**
     * @var callable(RequestInterface, array): PromiseInterface
     */
    private $nextHandler;

    /**
     * @var callable
     */
    private $decider;

    /**
     * @var callable(int)
     */
    private $delay;

    /**
     * @param callable                                            $decider     Function that accepts the number of retries,
     *                                                                         a request, [response], and [exception] and
     *                                                                         returns true if the request is to be
     *                                                                         retried.
     * @param callable(RequestInterface, array): PromiseInterface $nextHandler Next handler to invoke.
     * @param (callable(int): int)|null                           $delay       Function that accepts the number of retries
     *                                                                         and returns the number of
     *                                                                         milliseconds to delay.
     */
    public function __construct(callable $decider, callable $nextHandler, callable $delay = null)
    {
        $this->decider = $decider;
        $this->nextHandler = $nextHandler;
<<<<<<< HEAD
        $this->delay = $delay ?: __CLASS__.'::exponentialDelay';
=======
        $this->delay = $delay ?: __CLASS__ . '::exponentialDelay';
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    }

    /**
     * Default exponential backoff delay function.
     *
     * @return int milliseconds.
     */
    public static function exponentialDelay(int $retries): int
    {
<<<<<<< HEAD
        return (int) 2 ** ($retries - 1) * 1000;
=======
        return (int) \pow(2, $retries - 1) * 1000;
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    }

    public function __invoke(RequestInterface $request, array $options): PromiseInterface
    {
        if (!isset($options['retries'])) {
            $options['retries'] = 0;
        }

        $fn = $this->nextHandler;
<<<<<<< HEAD

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        return $fn($request, $options)
            ->then(
                $this->onFulfilled($request, $options),
                $this->onRejected($request, $options)
            );
    }

    /**
     * Execute fulfilled closure
     */
    private function onFulfilled(RequestInterface $request, array $options): callable
    {
        return function ($value) use ($request, $options) {
            if (!($this->decider)(
                $options['retries'],
                $request,
                $value,
                null
            )) {
                return $value;
            }
<<<<<<< HEAD

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            return $this->doRetry($request, $options, $value);
        };
    }

    /**
     * Execute rejected closure
     */
    private function onRejected(RequestInterface $req, array $options): callable
    {
        return function ($reason) use ($req, $options) {
            if (!($this->decider)(
                $options['retries'],
                $req,
                null,
                $reason
            )) {
                return P\Create::rejectionFor($reason);
            }
<<<<<<< HEAD

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            return $this->doRetry($req, $options);
        };
    }

    private function doRetry(RequestInterface $request, array $options, ResponseInterface $response = null): PromiseInterface
    {
<<<<<<< HEAD
        $options['delay'] = ($this->delay)(++$options['retries'], $response, $request);
=======
        $options['delay'] = ($this->delay)(++$options['retries'], $response);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

        return $this($request, $options);
    }
}
