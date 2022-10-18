<?php

namespace Garcia\Podbean;

use Garcia\Podbean\Providers\Authentication;
use Garcia\Podbean\Exceptions\NoEpisodesAvailableException;

class Episodes extends Authentication
{
    /**
     * @param int $starting
     * @param int $ending
     * @return array
     */
    public function getEpisodes(int $starting = 0, int $ending = 6)
    {
        $response = $this->getClient()
            ->getAsync("/v1/episodes?access_token=" . $this->getAccessToken())
            ->wait();
        $content = json_decode($response->getBody()->getContents());

        if (
            ($response->getStatusCode() >= 400 &&
                $response->getStatusCode() <= 500) ||
            is_null($content)
        ) {
            throw new NoEpisodesAvailableException();
        }

        return array_splice($content->episodes, $starting, $ending);
    }
}
