<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CoupenController extends Controller
{


    function tocoupen()
    {
        $coupons = Coupon::paginate(12);
        return view('admin.coupon.coupon', compact('coupons'));
    }

    function tocoupencreate(Request $request)
    {
        $this->validate($request, [
            'coupen_amount' => 'required|numeric'
        ]);
        $coupon = new Coupon();
        $coupon->coupen_name = $request->coupen_name;
        $coupon->coupen_amount = $request->coupen_amount;
        $coupon->valid_for_date = now()->addDays(1);

        if ($coupon->save()) {
            return redirect()->back()->with('success', 'Coupen Create Successfully');
        }
        return redirect()->back()->with('error', 'Some thing is wrong');
    }

    function tocoupendelete($id)
    {
        $file = Coupon::find($id);
        if ($file) {
            $file->delete();
            return redirect()->back()->with('success', 'Delete Successfully');
        }
        return redirect()->back()->with('error', 'Does Not Exist in Database');
    }

    function tocoupenedit(Request $request)
    {
        $this->validate($request, [
            "id" => "required|numeric",
            "coupen_amount" => "required|numeric",
            "status" => "required|numeric",
            'valid_for_date' => 'required|date|after:now',
        ]);
        $coupon = Coupon::find($request->id);
        $coupon->coupen_amount = $request->coupen_amount;
        $coupon->coupen_name = $request->coupen_name;
        $coupon->valid_for_date = $request->valid_for_date;
        $coupon->status = $request->status;
        if ($coupon->save()) {
            return redirect()->back()->with('success', 'Coupen Create Successfully');
        }
        return redirect()->back()->with('error', 'Coupon Doesnot Exist In Database');
    }
}
