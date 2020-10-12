<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use CodeIgniter\API\ResponseTrait;

class TokenFilter implements FilterInterface
{


    public function before(RequestInterface $request, $arguments = null)
    {
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
