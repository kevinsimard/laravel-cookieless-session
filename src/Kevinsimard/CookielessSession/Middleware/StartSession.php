<?php

namespace Kevinsimard\CookielessSession\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession as OriginalStartSession;
use Illuminate\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;

class StartSession extends OriginalStartSession
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->sessionHandled = true;

        // If a session driver has been configured, we will need to start the session here
        // so that the data is ready for an application. Note that the Laravel sessions
        // do not make use of PHP "native" sessions in any way since they are crappy.
        if ($this->sessionConfigured()) {
            $session = $this->startSession($request);

            $request->setSession($session);
        }

        $response = $next($request);

        // Again, if the session has been configured we will need to close out the session
        // so that the attributes may be persisted to some storage medium. We will also
        // add the session identifier to the application response headers now.
        if ($this->sessionConfigured()) {
            $this->storeCurrentUrl($request, $session);
            $this->collectGarbage($session);
            $this->addIdentifierToResponse($response, $session);
        }

        return $response;
    }

    /**
     * Get the session implementation from the manager.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Session\SessionInterface
     */
    public function getSession(Request $request)
    {
        $session = $this->manager->driver();

        $session->setId($request->headers->get('X-Session-Token'));

        return $session;
    }

    /**
     * Add the session identifier to the application response.
     *
     * @param \Symfony\Component\HttpFoundation\Response $response
     * @param \Illuminate\Session\SessionInterface $session
     *
     * @return void
     */
    protected function addIdentifierToResponse(Response $response, SessionInterface $session)
    {
        if ($this->sessionIsPersistent($config = $this->manager->getSessionConfig())) {
            $response->headers->set('X-Session-Token', $session->getId());
        }
    }
}
