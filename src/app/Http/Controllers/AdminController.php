<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
// 管理画面の表示
    public function index()
    {
        $categories = Category::all(); // お問い合わせの種類を取得
        $contacts = Contact::paginate(10); // 連絡先情報をページネーションで取得
        return view('admin', compact('contacts', 'categories'));
    }

    // 検索処理
    public function search(Request $request)
    {
        $query = Contact::query();

        // 検索条件を追加
        if ($request->filled('name')) {
            $query->where('first_name', 'like', '%' . $request->name . '%')->orWhere('last_name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(10); // ページネーションで取得

        $categories = Category::all(); // カテゴリ情報を再度取得

        return view('admin', compact('contacts', 'categories'));
    }

    // 削除処理
    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.index')->with('success', 'お問い合わせが削除されました');
    }
}
