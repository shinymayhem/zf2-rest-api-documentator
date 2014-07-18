<?php
namespace WidRestApiDocumentator\Resource;

use WidRestApiDocumentator\Body\NullBody;
use WidRestApiDocumentator\BodyInterface;
use WidRestApiDocumentator\HeaderSet\HeaderSet;
use WidRestApiDocumentator\HeaderSetInterface;
use WidRestApiDocumentator\ParamSet\ParamSet;
use WidRestApiDocumentator\ParamSetInterface;
use WidRestApiDocumentator\ResourceInterface;

class StandardResource implements ResourceInterface
{
    protected $method;
    protected $queryParams;
    protected $urlParams;
    protected $description;
    protected $uri;
    protected $headers;
    protected $body;
    protected $requestUri;
    protected $requestHeaders;
    protected $requestBody;
    protected $responseHeaders;
    protected $responseBody;


    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setQueryParams(ParamSetInterface $params)
    {
        $this->queryParams = $params;
    }

    public function getQueryParams()
    {
        if (null === $this->queryParams) {
            $this->queryParams = new ParamSet();
        }
        return $this->queryParams;
    }

    public function setUrlParams(ParamSetInterface $value)
    {
        $this->urlParams = $value;
    }

    public function getUrlParams()
    {
        if (null === $this->urlParams) {
            $this->urlParams = new ParamSet();
        }
        return $this->urlParams;
    }

    public function setUrl($uri)
    {
        $this->uri = $uri;
    }

    public function getUrl()
    {
        return $this->uri;
    }

    public function setHeaders(HeaderSetInterface $headers)
    {
        $this->headers = $headers;
    }

    public function getHeaders()
    {
        if (null === $this->headers) {
            $this->headers = new HeaderSet();
        }
        return $this->headers;
    }

    public function setBody(BodyInterface $body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        if (null === $this->body) {
            $this->body = new NullBody();
        }
        return $this->body;
    }

    public function getRequestUri()
    {
        return $this->requestUri;
    }

    public function setRequestUri($requestUri)
    {
        $this->requestUri = $requestUri;
        return $this;
    }

    public function getRequestHeaders()
    {
        return $this->requestHeaders;
    }

    public function setRequestHeaders($requestHeaders)
    {
        $this->requestHeaders = $requestHeaders;
        return $this;
    }

    public function getRequestBody()
    {
        return $this->requestBody;
    }

    public function setRequestBody($requestBody)
    {
        $this->requestBody = $requestBody;
        return $this;
    }

    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }

    public function setResponseHeaders($responseHeaders)
    {
        $this->responseHeaders = $responseHeaders;
        return $this;
    }

    public function getResponseBody()
    {
        return $this->responseBody;
    }

    public function setResponseBody($responseBody)
    {
        $this->responseBody = $responseBody;
        return $this;
    }
}
