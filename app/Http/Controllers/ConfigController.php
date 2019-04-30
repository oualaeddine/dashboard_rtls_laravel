<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigRequest;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index() {

        $config = Config::getConfig();

        return view('administration.config.config')
            ->with('config', $config);
    }

    public function update(ConfigRequest $request) {

        $config = Config::getConfig();

        if($config) {
            $config->update($request->all());
        }
        else {
            $this->createConfig($request);
        }

        $success = "les confifurations est modifier avec success";
        return redirect()->back()->withSuccess($success);
    }

    private function createConfig(ConfigRequest $request) {

        Config::create($request->all());
    }
}
