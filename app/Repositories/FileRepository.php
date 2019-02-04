<?php

namespace App\Repositories;

use App\Models\Actor;
use App\Models\PerformanceActor;
use App\Models\PerformanceCalendar;
use App\Models\PerformanceTranslation;

class FileRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
      return 'App\Models\File';
    }

    public function saveFile($file, $path)
    {
        $fileName = uniqid('cxid', true) . '.pdf';
        $file->move(public_path($path), $fileName);
        return $this->create([
            'url' => $path . '/' . $fileName
        ]);
    }
}
