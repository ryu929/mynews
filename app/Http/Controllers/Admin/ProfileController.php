<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\History;
use Carbon\Carbon;
class ProfileController extends Controller
{
    //

    public function add()
    {
        return view('admin.profile.create');
    }
 

    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);

        $news = new Profile;
        $form = $request->all();

    // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
    //if (isset($form['image'])) {
    //  $path = $request->file('image')->store('public/image');
    //  $news->image_path = basename($path);
    //} else {
    //    $news->image_path = null;
    //}

    // フォームから送信されてきた_tokenを削除する
    unset($form['_token']);
    // フォームから送信されてきたimageを削除する
    unset($form['image']);

    // データベースに保存する
    $news->fill($form);
    $news->save();

          // admin/news/createにリダイレクトする ここでどのページに戻るのか決めてるの
          return redirect('admin/profile');
    }

    public function index(Request $request)
    {
    $cond_shimei = $request->cond_shimei;
    if ($cond_shimei != '') {
        // 検索されたら検索結果を取得する
        $posts = Profile::where('shimei', $cond_shimei)->get();
    } else {
        // それ以外はすべてのニュースを取得する
        $posts = Profile::all();
    }
    return view('admin.profile.index', ['posts' => $posts, 'cond_shimei' => $cond_shimei]);
  }

  public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $news = Profile::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
      return view('admin.profile.edit', ['profile_form' => $news]);
  }

  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      // News Modelからデータを取得する
      $news = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $news_form = $request->all();

    //  if (isset($news_form['image'])) {
    //    $path = $request->file('image')->store('public/image');
    //    $news->image_path = basename($path);
    //    unset($news_form['image']);
    //  } elseif (0 == strcmp($request->remove, 'true')) {
    //    $news->image_path = null;
    //  }

      unset($news_form['_token']);
      unset($news_form['remove']);
      // 該当するデータを上書きして保存する
      $news->fill($profile_form)->save();
      $history = new History;
      $history->news_id = $news->id;
      $history->edited_at = Carbon::now();
      $history->save();


      return redirect('admin/profile/');
  }

}  