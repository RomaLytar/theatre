<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevController extends Controller
{
    public function update(Request $request) {
        switch($request->input('param')) {
            case 'update':
                $this->pull();
                break;
            case 'migrate':
                $this->migrate();
                break;
            case 'update-components':
                $this->updateComponents();
                break;
            default:
                break;
        }
        echo 'Project was successfully updated';
    }

    protected function pull() {
        exec('git stash');
        exec('git pull');
        exec('sudo chmod -R 777 /home/admin/web/the*');
    }

    protected function migrate() {
        exec('php artisan migrate');
    }

    protected function updateComponents() {
        exec('composer install');
    }
}
