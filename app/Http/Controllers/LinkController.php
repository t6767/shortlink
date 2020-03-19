<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\link;

class LinkController extends Controller
{
    // Вывод индексной страницы с выборкой всех внутренних ссылок
    public function index(){
        $links=link::select("link", "url")->orderBy('created_at', 'desc')->get()->toArray();
        return view('index', ['links'=>$links]);
    }

    // ajax пост запрос на сохранение ссылки
    public function ajaxRequestPost(Request $request)
    {
        $input = $request->all();
        $randomString = $this->chars();
        while (true) {
            $links = link::where("link", $randomString)->get()->toArray();
            if ($links != null) { $randomString = $this->chars(); } else { break; }
        }
        link::insert( ['link' => $randomString, 'url' => $input["url"], "created_at"=>date("Y-m-d"), "updated_at"=>date("Y-m-d")] );
        return json_encode($randomString);
    }

    // Генератор рандомных строк
    public function chars()
    {
        $length=6;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // редирект по ссылке
    public function navigate($link)
    {
        $links = link::where("link", $link)->get()->toArray();
        return redirect($links[0]['url']);
    }
}
