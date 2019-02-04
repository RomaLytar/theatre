<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Performance;
use App\Transformers\Search\ActorTransformer;
use Illuminate\Http\Request;
use App\Models\Actor;
use App\Models\ActorTranslation;
use App\Models\PerformanceTranslation;
use App\Models\Article;
use App\Models\ArticleTranslation;
use App\Models\Album;
use App\Models\AlbumTranslation;
use App\Models\Video;
use Spatie\Url\Url;
use App\Models\VideoTranslation;
use App\Transformers\Search\PerformanceTransformer;
use App\Transformers\Search\ArticleTransform;
use App\Transformers\Search\MediaTransformer;
use Config;




use App\Http\Controllers\Controller;

/**
 * Class SearchController
 * @package App\Http\Controllers\Api\v1
 */
class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     * поиск по сайту по 4 таблицам, актеры, новости, выступления и медия.
     */
    public function index(Request $request)
    {
        /**
         * q=поисковое слово
         * type = тип таблицы по которой нужно искать данные.
         */
        $checkbox = $request->input('type');
        $query = $request->input('q');

        /**
         * поиск по актерам
         */
        if ($checkbox == 'actors') {
            //получаем массив данных из get запроса
            $parts = array_map('trim', explode(' ', $query));

            //парсим строку
            $string = implode(' ', $parts);

            //игнорируем кучу пробелов и убираем пробул вконце
            $searchValues = preg_split('/\s+/', $string, -1, PREG_SPLIT_NO_EMPTY);

            //получаем id актеров
            $actorIds = ActorTranslation::where('language', Config::get('app.locale'))->where(function ($q) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $q->orWhere('firstName', 'like', "%{$value}%")
                    ->orWhere('lastName', 'LIKE', '%' . $value  . '%')
                    ->orWhere('patronymic', 'LIKE', '%' . $value  . '%')
                    ->orWhere('descriptions', 'LIKE', '%' . $value  . '%');
                }
            })->pluck('actor_id');
            //список актеров
            $actors = Actor::with('media', 'translate')->
            whereIn('id', $actorIds)->get();

            return fractal()
                ->collection($actors)
                ->transformWith(new ActorTransformer)
                ->toArray();
        }

        /**
         * поиск по выстулениям
         */

        if ($checkbox == 'performances') {
            $performanceIds = PerformanceTranslation::where('language', Config::get('app.locale'))
                ->where('title', 'LIKE', '%' . $query . '%')
                ->orWhere('descriptions', 'LIKE', '%' . $query . '%')
                ->orWhere('author', 'LIKE', '%' . $query . '%')
                ->orWhere('directors', 'LIKE', '%' . $query . '%')
                ->orWhere('synapsis', 'LIKE', '%' . $query . '%')
                ->orWhere('directors2', 'LIKE', '%' . $query . '%')
                ->orWhere('city', 'LIKE', '%' . $query . '%')
                ->orWhere('place', 'LIKE', '%' . $query . '%')
                ->pluck('performance_id');

            $performances = Performance::with('media', 'translate')
                ->whereIn('id', $performanceIds)
                ->get();

            return fractal()
                ->collection($performances)
                ->transformWith(new PerformanceTransformer)
                ->toArray();
        }

        /**
         * поиск по артистам
         */

        if($checkbox == 'articles'){
            $articleIds = ArticleTranslation::where('language', Config::get('app.locale'))
                ->where('title', 'LIKE', '%' . $query . '%')
                ->orWhere('descriptions', 'LIKE', '%' . $query . '%')
                ->pluck('article_id');

            $articles = Article::with('media', 'translate')
                ->whereIn('id', $articleIds)
                ->get();

            return fractal()
                ->collection($articles)
                ->transformWith(new ArticleTransform)
                ->toArray();
        }

        /**
         * поиск по медиа
         */
        if($checkbox == 'media'){
            $albumIds = AlbumTranslation::where('language', Config::get('app.locale'))
                ->where('title', 'LIKE', '%' . $query . '%')
                ->pluck('album_id');

            $albums = Album::with('media', 'translate')
                ->whereIn('id',  $albumIds)
                ->get();

            $videoIds = VideoTranslation::where('language', Config::get('app.locale'))
                ->where('title', 'LIKE', '%' . $query . '%')
                ->pluck('video_id');

            $videos = Video::with('media', 'translate')
                ->whereIn('id',  $videoIds)
                ->get();

            $medias = $albums->merge($videos ?: collect());

            return fractal()
                ->collection($medias)
                ->transformWith(new MediaTransformer)
                ->toArray();
        }
    }
}
