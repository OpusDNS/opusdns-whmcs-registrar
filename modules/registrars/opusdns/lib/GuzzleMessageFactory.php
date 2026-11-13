<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Stream;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use RuntimeException;

/**
 * Creates PSR-7 requests and streams with the guzzlehttp/psr7 classes that WHMCS bundles, in version 1 and 2 alike.
 */
final class GuzzleMessageFactory implements RequestFactoryInterface, StreamFactoryInterface
{
    public function createRequest(string $method, $uri): RequestInterface
    {
        return new Request($method, $uri);
    }

    public function createStream(string $content = ''): StreamInterface
    {
        $resource = self::open('php://temp', 'r+');
        fwrite($resource, $content);
        rewind($resource);

        return new Stream($resource);
    }

    public function createStreamFromFile(string $filename, string $mode = 'r'): StreamInterface
    {
        return new Stream(self::open($filename, $mode));
    }

    public function createStreamFromResource($resource): StreamInterface
    {
        return new Stream($resource);
    }

    /**
     * @return resource
     */
    private static function open(string $filename, string $mode)
    {
        $resource = @fopen($filename, $mode);

        if ($resource === false) {
            throw new RuntimeException("Unable to open {$filename} in mode {$mode}.");
        }

        return $resource;
    }
}
