<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if (!session()->has('npm_user')) {
            // return redirect()->to("/");

            return redirect()->to(base_url('/'))->with('msg', 'Anda harus Login terlebih dahulu');
        }
        // Do something here
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

        // Do something here
    }
}
