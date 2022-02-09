<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Models\Link;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function save(StoreLinkRequest $req){
        $req['token'] = $this->getUniqueLinkToken();
        $req['lifetime'] = $this->getLifeTime($req['time']);

        Link::create($req->all());

        $req->session()->flash('success', "Ссылка {$req['token']} была добавлена!");

        return redirect()->route('home');
    }

    public function showAll(){
        $links = Link::all()->sortDesc();

        return view('links-show', compact('links'));
    }

    public function redirect($url){
        $link = Link::where('token', '=', $url)->firstOrFail();

        if(!$this->isLifeTimeActual($link->lifetime) || !$this->maxVisitsNotExceeded($link)){
            abort(404);
        }
        $link->current_visits++;
        $link->save();

        return redirect($link->uri);
    }

    private function getUniqueLinkToken(){
        do{
            $token = Str::random(8);
            $link = DB::table('links')->where('token', $token)->first();
        } while($link);

        return $token;
    }

    private function getLifeTime($time){
        $time = date_parse($time);

        $current = Carbon::now();
        $current->addHour($time['hour']);
        $current->addMinute($time['minute']);

        return $current;
    }

    private function isLifeTimeActual($lifetime){
        $now = Carbon::now();

        return $now->lessThan($lifetime) ? true : false;
    }

    private function maxVisitsNotExceeded($link){
        if($link->max_visits === 0){
            return true;
        }else{
            return ($link->max_visits - $link->current_visits > 0);
        }
    }
}
