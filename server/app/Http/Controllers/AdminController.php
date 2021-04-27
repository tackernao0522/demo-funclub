<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contact;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function contactList(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $keyword = '%' . $this->escape($request->input('keyword')) . '%';
            $query->where(function ($query) use ($keyword) {
                $query->where('your_name', 'LIKE', $keyword);
                $query->orWhere('status', 'LIKE', $keyword);
            });
        }

        $defaults = [
            'keyword' => $request->input('keyword'),
        ];

        $contacts = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin/contacts.list')
            ->with('contacts', $contacts)
            ->with('defaults', $defaults);
    }

    public function contactEditForm(Contact $contact)
    {
        return view('admin/contacts.list_form', ['contact' => $contact]);
    }

    public function EditStatus(Request $request, Contact $contact)
    {
        $contact->status = $request->status;
        $contact->save();

        return redirect()->route('contact.list')
            ->with('status', '状態を更新しました。');
    }

    public function destroy(Contact $id)
    {
        if ($id->status == '2') {
            $id->delete();

            return redirect()->route('contact.list')
                ->with('status', '削除しました。');
        } else {
            return redirect()->route('contact.list')
                ->with('status', '未対応リストは削除できません。');
        }
    }

    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }
}
