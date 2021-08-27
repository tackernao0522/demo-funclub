<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;

class ShippingAreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function divisionView()
    {
        if (auth()->user()->shipping == 1) {
            $divisions = ShipDivision::orderBy('sort_no', 'ASC')->get();

            return view('admin.shop.ship.division.view_division', compact('divisions'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
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
        if (auth()->user()->shipping == 1) {
            $division = ShipDivision::findOrFail($id);

            return view('admin.shop.ship.division.edit_division', compact('division'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
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
        if (auth()->user()->shipping == 1) {
            $division = ShipDivision::findOrFail($id);
            $division->delete();

            $notification = array(
                'message' => '都道府県名：' . $division->division_name . 'を削除しました。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function districtView()
    {
        if (auth()->user()->shipping == 1) {
            $divisions = ShipDivision::orderBy('sort_no', 'ASC')->get();
            $districts = ShipDistrict::with('division')->orderBy('sort_no', 'ASC')->get();

            return view('admin.shop.ship.district.view_district', compact('divisions', 'districts'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function districtStore(Request $request)
    {
        $validatedData = $request->validate([
            'division_id' => 'required',
            'district_name' => 'required|unique:ship_districts',
            'sort_no' => 'integer|nullable',
        ], [
            'division_id.required' => '都道府県名は必須です。',
            'district_name.unique' => 'この市区町村は既に登録されています。',
            'district_name.required' => '市区町村名は必須です。',
        ]);

        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '市区町村名を作成しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function districtEdit($id)
    {
        if (auth()->user()->shipping == 1) {
            $divisions = ShipDivision::orderBy('sort_no', 'ASC')->get();
            $district = ShipDistrict::findOrFail($id);

            return view('admin.shop.ship.district.edit_district', compact('divisions', 'district'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function districtUpdate(Request $request, $id)
    {
        $district = ShipDistrict::findOrFail($id);
        $validatedData = $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',
        ], [
            'division_id.required' => '都道府県名は必須です。',
            'district_name.required' => '市区町村名は必須です。',
        ]);

        $district->division_id = $request->division_id;
        $district->district_name = $request->district_name;
        $district->updated_at = Carbon::now();
        $district->save();

        $notification = array(
            'message' => '市区町村ID：' . $district->id . 'を更新しました。',
            'alert-type' => 'info',
        );

        return redirect()->route('manage-district')
            ->with($notification);
    }

    public function districtDelete($id)
    {
        if (auth()->user()->shipping == 1) {
            $district = ShipDistrict::findOrFail($id);
            $district->delete();

            $notification = array(
                'message' => '市区町村名：' . $district->district_name . 'を削除しました。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }
}
