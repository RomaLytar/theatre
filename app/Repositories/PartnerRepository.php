<?php

namespace App\Repositories;

use App\Models\Partner;
use App\Models\PartnerTranslation;

class PartnerRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return Partner::class;
  }

  public function createPartners($data)
  {
    $partner = [
      'category_id' => $data['category_id'],
      'is_active' => $data['is_active'] ?? null,
      'in_footer' => $data['in_footer'] ?? null,
      'is_main' => $data['is_main'] ?? null,
      'is_middle' => $data['is_middle'] ?? null,
      'url_partner' => $data['url_partner'] ?? null,
      'url' => $data['url'] ?? null,
    ];

    $partner = $this->create($partner);

    $this->addTranslationPartner($data, $partner);

    return $partner;
  }

  public function editPartner($data, $partner):void
  {
    $array = [
      'category_id' => $data['category_id'],
      'is_active' => $data['is_active'] ?? null,
      'in_footer' => $data['in_footer'] ?? null,
      'is_main' => $data['is_main'] ?? null,
      'is_middle' => $data['is_middle'] ?? null,
      'url_partner' => $data['url_partner'] ?? null,
      'url' => $data['url'] ?? null,
    ];
    $this->update($array, ['id' => $partner->id]);
    $this->editTranslationPartner($data, $partner);
  }

  public function addTranslationPartner($data, $partner):void
  {
    foreach(get_languages() as $lang => $val) {
      PartnerTranslation::create([
        'partner_id' => $partner->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'descriptions' => $data['descriptions_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationPartner($data, $partner):void
  {
    foreach(get_languages() as $lang => $val) {
      $partnerTranslation = PartnerTranslation::where(['partner_id' => $partner->id, 'language' => $lang])->first();
      $partnerTranslation->update([
        'partner_id' => $partner->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'descriptions' => $data['descriptions_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
