<?php

if (! function_exists('get_languages')) {
  function get_languages() {
      return [
          'en' => 'Eng',
          'ru' => 'Рус',
          'ua' => 'Укр'
      ];
  }
}

if (! function_exists('array_multilanguage_formatter')) {
  function array_multilanguage_formatter($arr, $key, $column1, $column2 = '') {
      $result = [];

      foreach ($arr as $item) {
          if($column2 !== '') {
              $column2 = ' ' . $column2;
          }
        $result[$item->$key] = $item->translate->$column1 . $item->translate->$column2;
      }

      return $result;
  }
}

if (! function_exists('array_formatter')) {
  function array_formatter($arr, $format, $keyColumn = false) {
      $result = [];
      foreach ($arr as $arrVal) {
          $item = [];
          foreach ($format as $key => $value) {
              if ($keyColumn) {
                  $item[$arrVal->$key] = $arrVal->$value;
              } else {
                  $item[$key] = $arrVal->$value;
              }
          }
          $result[] = $item;
      }
      return $result;
  }
}

if (! function_exists('array_formatter_index')) {
  function array_formatter_index($arr, $format, $keyColumn = false) {
    $result = [];
    foreach ($arr as $arrVal) {
      $item = [];
      foreach ($format as $key => $value) {
        if ($keyColumn) {
          $item[$arrVal->$key] = $arrVal->$value;
        } else {
          $item[$key] = $arrVal->$value;
        }
      }
      $result[$item['id']] = $item;
    }
    return $result;
  }
}

if (! function_exists('array_diff_assoc_recursive')) {
  function array_diff_assoc_recursive($array1, $array2) {
      foreach ($array1 as $key => $value) {
          if (is_array($value)) {
              if (!isset($array2[$key])) {
                 $difference[$key] = $value;
              }
              else
                if (!is_array($array2[$key])) {
                 $difference[$key] = $value;
              } else {
                  $new_diff = array_diff_assoc_recursive($value, $array2[$key]);
                  if($new_diff != FALSE) {
                    $difference[$key] = $new_diff;
                  }
              }
          } elseif (!isset($array2[$key]) || $array2[$key] != $value) {
              $difference[$key] = $value;
          }
    }
      return $difference ?? 0;
  }
}

if (! function_exists('array_to_index_array')) {
  function array_to_index_array($array)
  {
    $newArray = [];
    if(!is_array($array)) {
      return 0;
    }
    foreach ($array as $value) {
      $newArray[] = $value;
    }
    return $newArray;
  }
}

if (! function_exists('get_scenes')) {
    function get_scenes() {
        return [
            'big' => __('home.big'),
            'small' => __('home.small'),
            'open' => __('home.open'),
            'chamber' => __('home.chamber'),
            'loft' => __('home.loft'),
        ];
    }
}
