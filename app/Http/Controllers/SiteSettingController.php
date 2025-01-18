<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index', [
            'setting' => SiteSetting::find(1)
        ]);
    }

    public function update(Request $request)
    {
        $setting = SiteSetting::find(1);
        $setting->update([
            'payment_active' => !$setting->payment_active
        ]);

        return response('Setting updated', 200);
    }
    public function updateSalesStatus(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'sales_status' => 'required|boolean',  // Ensure the sales_status is either 0 or 1
        ]);
    
        try {
            // Get the first site setting
            $setting = SiteSetting::first();
    
            // If no record exists, create one
            if (!$setting) {
                $setting = SiteSetting::create([
                    'sales_status' => $request->sales_status,  // Use the sent sales_status
                    'payment_active' => true,  // Set other default values if needed
                ]);
            } else {
                // Update the sales status
                $setting->sales_status = $request->sales_status;
                $setting->save();
            }
    
            return response()->json(['success' => true, 'message' => 'Sales status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update sales status.']);
        }
    }
}
