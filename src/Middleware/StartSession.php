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
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function getSession(Request $request)
    {
        $sessionToken = $request->headers->get("X-Session-Token",
            $request->input("_session-token"));

        $session = $this->manager->driver();
        $session->setId($sessionToken);

        return $session;
    }

    /**
     * {@inheritdoc}
     */
    protected function addIdentifierToResponse(Response $response, SessionInterface $session)
    {
        if ($this->sessionIsPersistent($config = $this->manager->getSessionConfig())) {
            $response->headers->set("X-Session-Token", $session->getId());
        }
    }
}
