<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipTown;

class ShippingAreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function divisionView()
    {
        $divisions = ShipDivision::orderBy('sort_no')->get();

        return view('admin.shop.ship.division.view_division', compact('divisions'));
    }

    public function divisionStore(Request $request)
    {
        $validatedData = $request->validate([
            'division_name' => 'required|string|unique:ship_divisions',
        ], [
            'division_name.required' => '都道府県名は必須です。',
            'division_name.unique' => 'この都道府県名は既に登録されています。',
        ]);

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '都道府県名を作成しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function divisionEdit($id)
    {
        $division = ShipDivision::findOrFail($id);

        return view('admin.shop.ship.division.edit_division', compact('division'));
    }

    public function divisionUpdate(Request $request, $id)
    {
        $division = ShipDivision::findOrFail($id);
        $validatedData = $request->validate([
            'division_name' => 'required',
        ], [
            'division_name.required' => '都道府県名は必須です。',
        ]);

        $division->division_name = $request->division_name;
        $division->updated_at = Carbon::now();
        $division->save();

        $notification = array(
            'message' => '都道府県名ID：' . $division->id . 'を更新しました。',
            'alert-type' => 'info',
        );

        return redirect()->route('manage-division')
            ->with($notification);
    }

    public function divisionDelete($id)
    {
        $division = ShipDivision::findOrFail($id);
        $division->delete();

        $notification = array(
            'message' => '都道府県名：' . $division->division_name . 'を削除しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }
}
