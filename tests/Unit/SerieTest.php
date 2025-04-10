<?php

namespace Tests\Unit;

use App\Helpers\DefaultVideosHelper;
use App\Helpers\SeriesHelper;
use App\Models\Serie;
use App\Models\Videos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SerieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testSerieHasVideos()
    {
        $serie = SeriesHelper::createDefaultSerie1();

        $video1 = DefaultVideosHelper::createDefaultVideo();
        $video2 = DefaultVideosHelper::createDefaultVideo2();

        $video1->series_id = $serie->id;
        $video1->save();

        $video2->series_id = $serie->id;
        $video2->save();

        $this->assertCount(2, $serie->videos);
        $this->assertTrue($serie->videos->contains($video1));
        $this->assertTrue($serie->videos->contains($video2));
    }
}
