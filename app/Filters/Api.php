<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Api implements FilterInterface
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
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        //
        try {
            $session = session();
            helper(['rol']);
            if (!$session->isLoggedIn)
                return Services::response()
                    ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED, 'Unauthorized')
                    ->setJSON([
                        'status' => ResponseInterface::HTTP_UNAUTHORIZED,
                        'message' => 'You need to sign in or sign up before continuing.',
                        'data' => null
                    ]);
            if (is_array($arguments))
                if (!validate_access($arguments, session()->user_id))
                    return Services::response()
                        ->setStatusCode(ResponseInterface::HTTP_FORBIDDEN, 'Forbidden')
                        ->setJSON([
                            'status' => ResponseInterface::HTTP_FORBIDDEN,
                            'message' => 'Forbidden',
                            'data' => null
                        ]);
        } catch (\Exception $e) {
            $data = [
                'status' => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Server Error'
            ];
            return Services::response()
                ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR, 'Server Error')
                ->setJSON($data);
        }
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
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
