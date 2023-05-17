<?php

namespace App\Http\Controllers\Shwe_News;

use App\Event;
use App\Http\Controllers\Controller;
use App\News;
use App\Promotions;


class NewsFrontController extends Controller
{
    public function index()
    {
      
        $latest_news = News::latest()->first(); 
        if(!empty($latest_news)){
          $news = News::whereNotIn('id',[$latest_news->id])->latest()->paginate(3);
        }else{
          $news = News::all();
        }
        $promotions = Promotions::orderBy('id', 'DESC')->paginate(4);
        $events = Event::latest()->paginate(3);
        return view('front.news.news',[
          'latestNews' => $latest_news,
          'promotions' => $promotions,
          'events' => $events,
          'news' => $news
        ]);
    }

    public function allNews() {
      $news = News::orderBy('id', 'desc')->get();
      return view('front.news.allnews',compact('news'));
    }
    public function allPromotions() {
      $promotions = Promotions::all();
        return view('front.news.allpromotions',compact('promotions'));
    }
    public function allEvents() {
        $events = Event::orderBy('id', 'desc')->get();
        return view('front.news.allevents' , compact('events'));
    }

    public function NewsDetail($slug) {
      $news = News::where('slug',$slug)->first();
      $other_news = News::whereNotIn('id',[$news->id])->latest()->paginate(2);  
      if(empty($news)){
        return abort(404);
      }
      return view('front.news.news-details',compact('news','other_news'));
    }

    public function PromotionDetail($slug) {
        $promotion = Promotions::where('slug',$slug)->first();
        if(empty($promotion)){
          return abort(404);
        }
        $other_promotions = Promotions::whereNotIn('id',[$promotion->id])->latest()->paginate(2);
        return view('front.news.promo-details',compact('promotion','other_promotions'));
    }
    public function EventDetail($slug) {
        $event = Event::where('slug',$slug)->first();
        $other_events = Event::whereNotIn('id', [$event->id])->latest()->paginate(2);
        return view('front.news.event-details',compact('event','other_events'));
    }
}
