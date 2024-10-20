<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\Auth;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // log_message('info', 'AuthFilter arguments: ' . print_r(Auth::user(), true));

        // redirect to profile page if logged in
        if ($arguments[0] == "guest" && Auth::isLoggedIn())
            return redirect()->route("rt.profilepage");

        // redirect to login page if has logged in already
        if ($arguments[0] == "auth" && !Auth::isLoggedIn())
            return redirect()->route("rt.login")->with("fail", "You must logged in to access this!");

        // protect admin specific routes
        if ($arguments[0] == "admin")
            if (!Auth::isLoggedIn())
                return redirect()->route("rt.login")->with("fail", "You must logged in to access this!");
            else if (!Auth::isAdmin())
                // Alert type label for info
                return redirect()->route("rt.profilepage");
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
