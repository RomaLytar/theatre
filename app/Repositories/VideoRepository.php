<?php

namespace App\Repositories;


use App\Models\VideoTranslation;

class VideoRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
      return 'App\Models\Video';
    }

    public function createVideos($data)
    {
      $video = [
        'url' => $data['url'],
        'category_id' => $data['category_id'],
        'season_id' => $data['season_id'],
      ];
      $video = $this->create($video);
      $this->addTranslationVideo($data, $video);
      if(isset($data['actors'])):{
      $this->addActorsToVideo($data['actors'], $video);
        }
      endif;
      if(isset($data['performances'])):{
      $this->addPerformancesToVideo($data['performances'], $video);
      }
      endif;
      return $video;
    }

    public function addActorsToVideo($actors, $video) {
      foreach ($actors as $actorId) {
        $video->actors()->attach($actorId);
      }
    }

    public function addPerformancesToVideo($performances, $video) {
      foreach ($performances as $performanceId) {
        $video->performances()->attach($performanceId);
      }
    }

    public function editVideo($data, $video)
    {
      $array = [
        'url' => $data['url'],
        'category_id' => $data['category_id'],
        'season_id' => $data['season_id'],
      ];
      $this->update($array, ['id' => $video->id]);
      $this->editTranslationVideo($data, $video);

      $video->actors()->detach();
      if(isset($data['actors'])) {
        $this->addActorsToVideo($data['actors'], $video);
      }
      $video->performances()->detach();
      if(isset($data['performances'])) {
        $this->addPerformancesToVideo($data['performances'], $video);
      }
    }

    public function addTranslationVideo($data, $video)
    {
      foreach(get_languages() as $lang => $val) {
        VideoTranslation::create([
          'video_id' => $video->id,
          'language' => $lang,
          'title' => $data['title_' . $lang],
          'seo_title' => $data['seo_title_' . $lang],
          'seo_description' => $data['seo_description_' . $lang],
        ]);
      }
    }

    public function editTranslationVideo($data, $video)
    {
      foreach(get_languages() as $lang => $val) {
        $videoTranslation = VideoTranslation::where(['video_id' => $video->id, 'language' => $lang])->first();
        $videoTranslation->update([
          'video_id' => $video->id,
          'language' => $lang,
          'title' => $data['title_' . $lang],
          'seo_title' => $data['seo_title_' . $lang],
          'seo_description' => $data['seo_description_' . $lang],
        ]);
      }
    }

    public function saveVideos($videos)
    {
        $videoArr = [];
        foreach ($videos as $video) {
            if ($video) {
                array_push($videoArr, $this->create(['url' => $video]));
            }
        }
        return $videoArr;
    }
}
