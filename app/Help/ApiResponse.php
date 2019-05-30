<?php
namespace App\Help;

use Symfony\Component\HttpFoundation\Response as FoundationResponse;

trait ApiResponse
{
    /**
     * @var int
     */
    protected $statusCode = FoundationResponse::HTTP_OK;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {

        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $data
     * @param array $header
     * @return mixed
     */
    public function message($data)
    {
        return $this->respond($data);
    }

    public function failed($data)
    {
        return $this->respond($data);
    }

    protected function respond($data, $header = [])
    {
        $data = array_merge($data, [
            'status' => $this->getStatusCode()
        ]);
        return response()->json($data, $this->getStatusCode(), $header);
    }





}