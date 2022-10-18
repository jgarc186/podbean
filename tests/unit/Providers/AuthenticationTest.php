<?php

namespace unit\Providers;

use PHPUnit\Framework\TestCase;
use Garcia\Podbean\Providers\Authentication;
use Garcia\Podbean\Exceptions\NotAbleToConnectionException;

class AuthenticationTest extends TestCase
{
    /** @test */
    function it_can_connect_to_podbean_api()
    {
        try {
            $response = new Authentication("https://api.podbean.com", "", "");

            $this->assertEquals(200, $response->getStatus());
        } catch (NotAbleToConnectionException $e) {
            $this->fail("Was not able to connect to podbean API");
        }
    }

    /** @test */
    function it_cannot_connect_to_podbean_api()
    {
        try {
            $auth = new Authentication("https://api.podbean.com", "", "");
        } catch (NotAbleToConnectionException $e) {
            $this->assertEquals(
                "Not able to connect to the Podbean, API. Invalid credentials.",
                $e->getMessage()
            );
            return;
        }

        $this->fail("Was able to connect to podbean API");
    }
}
