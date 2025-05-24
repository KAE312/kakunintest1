<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
{
    $query = Contact::query();
    
    
    if ($request->filled('keyword')) {
        $query->where(function($q) use ($request) {
            $q->where('fullname', 'like', '%' . $request->keyword . '%')
              ->orWhere('email', 'like', '%' . $request->keyword . '%');
        });
    }

    // 性別
    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    // お問い合わせの種類
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    // 日付
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    // 7件ずつページネーション（検索条件も維持）
    $contacts = $query->paginate(7)->appends($request->all());

    return view('admin.index', compact('contacts'));
}

public function destroy($id)
{
    Contact::findOrFail($id)->delete();

    return redirect()->route('admin.index')->with('success', '削除しました');
}

public function export(Request $request): StreamedResponse
{
    $query = Contact::query();

    if ($request->filled('fullname')) {
        $query->where('fullname', 'like', '%' . $request->fullname . '%');
    }
    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }
    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }
    if ($request->filled('from_date')) {
        $query->whereDate('created_at', '>=', $request->from_date);
    }
    if ($request->filled('to_date')) {
        $query->whereDate('created_at', '<=', $request->to_date);
    }

    $contacts = $query->get();

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="contacts.csv"',
    ];

    $callback = function () use ($contacts) {
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['名前', '性別', 'メールアドレス', '住所', '建物名', 'お問い合わせ種別', '内容', '登録日時']);

        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->fullname,
                $contact->gender,
                $contact->email,
                $contact->address,
                $contact->building_name,
                $contact->category,
                $contact->content,
                $contact->created_at,
            ]);
        }

        fclose($handle);
    };

    return response()->stream($callback, 200, $headers);
}


}
