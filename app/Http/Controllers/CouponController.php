<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'code' => 'required|unique:coupons',
            'discount' => 'required|numeric|min:0|max:100',
            'expiry_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => ['error' => $validator->errors()],
                'status' => 'error',
            ], 422);
        }

        try {
            $coupon = Coupon::create($validator->validated());
            return response()->json([
                'message' => ['success' => $coupon],
                'status' => 'success',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => ['error' => $e->getMessage()],
                'status' => 'error',
            ], 500);
        }
    }

    // Delete a single coupon by ID
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        if (!$coupon) {
            return response()->json(['message' => ['error' => 'Coupon not found.'], 'status' => 'error'], 404);
        }

        $coupon->delete();

        return response()->json(['message' => ['success' => 'Coupon deleted successfully.'], 'status' => 'success']);
    }

    // Delete all coupons
    public function destroyAll()
    {
        Coupon::truncate();
        return response()->json(['message' => ['success' => 'All coupons deleted successfully'], 'status' => 'success']);
    }

    // Fetch all coupons
    public function index()
    {
        $coupons = Coupon::all();
        return response()->json($coupons);
    }
}
