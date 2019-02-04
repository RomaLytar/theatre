<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\Banner;
use App\Models\BannerTranslation;



class BannerRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Banner';
    }

    public function createBanners($data)
    {
        $banner = [
            'is_calendar' => $data['is_calendar'] ?? 0,
        ];
        $banner = $this->create($banner);
        $this->addTranslationBanner($data, $banner->id);
        return $banner;
    }

    public function editBanners($data, $id)
    {
        $array = [
            'is_calendar' => $data['is_calendar'] ?? 0,
        ];
        $this->update($array, ['id' => $id]);
        $banners = Banner::find($id);
        $this->editTranslationBanner($data, $banners);
    }

    public function addTranslationBanner($data, $bannerId)
    {
        foreach (get_languages() as $lang => $val) {
            BannerTranslation::create([
                'banner_id' => $bannerId,
                'language' => $lang,
                'title' => $data['title_' . $lang],
            ]);
        }
    }

    public function editTranslationBanner($data, $banner)
    {
        foreach (get_languages() as $lang => $val) {
            $bannerTranslation = BannerTranslation::where(['banner_id' => $banner->id, 'language' => $lang])->first();
            $bannerTranslation->update([
                'banner_id' => $banner->id,
                'language' => $lang,
                'title' => $data['title_' . $lang],
            ]);
        }
    }
}
