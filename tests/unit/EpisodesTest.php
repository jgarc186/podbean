<?php

namespace unit;

use Garcia\Podbean\Episodes;
use PHPUnit\Framework\TestCase;
use Garcia\Podbean\Exceptions\NoEpisodesAvailableException;

class EpisodesTest extends TestCase
{
    /** @test */
    function it_can_get_episodes()
    {
        $episodes = new Episodes("https://api.podbean.com", "", "");

        $response = $episodes->getEpisodes();

        $this->assertIsArray($response);
    }

    /** @test */
    function it_cannot_get_episodes_or_there_are_no_episodes()
    {
        $episodes = new Episodes("https://api.podbean.com", "", "");

        try {
            $episodes->getEpisodes();
        } catch (NoEpisodesAvailableException $e) {
            $this->assertEquals(
                "There are no episodes available.",
                $e->getMessage()
            );
            return;
        }

        $this->assertFail("There were apisodes available");
    }
}
