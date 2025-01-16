<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * 管理画面の表示
     */
    public function index()
    {
        // お問い合わせ種類のリストを取得
        $categories = Category::all();

        // 全てのコンタクトを取得してページネーション
        $contacts = Contact::with('category')->paginate(10);

        // 管理画面ビューにデータを渡す
        return view('admin.index', compact('contacts', 'categories'));
    }

    /**
     * 検索処理
     */
    public function search(Request $request)
    {
        $query = Contact::with('category'); // 'category' を eager load する

        // 名前での検索
        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name . '%');
            });
        }

        // メールアドレスでの検索
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // 性別での検索
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // お問い合わせ種類での検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付での検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 検索結果をページネーションで取得
        $contacts = $query->paginate(10);

        // カテゴリ情報を再取得
        $categories = Category::all();

        // 結果をビューに渡す
        return view('admin.index', compact('contacts', 'categories'));
    }

    /**
     * 削除処理
     */
    public function delete($id)
    {
        // 指定されたIDのデータを取得
        $contact = Contact::findOrFail($id);

        // データを削除
        $contact->delete();

        // 成功をJSON形式で返す
        return response()->json(['success' => true]);
    }

    /**
     * 詳細表示処理
     */
    public function show($id)
    {
        // 指定されたIDのコンタクト情報を取得（categoryを含む）
        $contact = Contact::with('category')->find($id);

        // データが存在しない場合は404エラーを返す
        if (!$contact) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        // データをJSON形式で返す
        return response()->json($contact);
    }
}
