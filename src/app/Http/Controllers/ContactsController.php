<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Category モデルを追加
use App\Models\Contact; // Contact モデルを追加

class ContactsController extends Controller
{
    // お問い合わせフォームの入力画面
    public function index()
    {
        // カテゴリを取得してビューに渡す
        $categories = Category::all();
        return view('index', compact('categories')); // 入力画面のビューにカテゴリを渡す
    }

    // お問い合わせ内容の確認画面
    public function confirm(Request $request)
    {
         // フォームデータをバリデーション
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'gender' => 'required|in:1,2,3',
        'email' => 'required|email|max:255',
        'tel' => 'required|numeric',
        'address' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'detail' => 'required|string|max:2000',
    ]);

    // データをセッションに保存
    $request->session()->put('contact_data', $validatedData);

    // 確認画面にデータを渡す
    return view('confirm', ['data' => $validatedData]);
    }

    // お問い合わせフォームの送信処理
    public function store(Request $request)
    {
        // セッションからデータを取得
        $data = $request->session()->get('contact_data');

        // セッションにデータが存在しない場合
        if (!$data) {
            return redirect()->route('contacts.index')->with('error', '入力データが見つかりません。最初からやり直してください。');
        }

        // データ保存
        $contact = new Contact();
        $contact->first_name = $data['first_name'];
        $contact->last_name = $data['last_name'];
        $contact->email = $data['email'];
        $contact->gender = $data['gender'];
        $contact->category_id = $data['category_id'];
        $contact->detail = $data['detail'];
        $contact->tel = $data['tel'];
        $contact->address = $data['address'];
        $contact->save();

        // セッションから保存したデータを削除
        $request->session()->forget('contact_data');

        // サンクスページにリダイレクト
        return redirect()->route('contacts.thanks');
    }

    // サンクスページ
    public function thanks()
    {
        return view('thanks'); // サンクスページのビュー
    }
}
