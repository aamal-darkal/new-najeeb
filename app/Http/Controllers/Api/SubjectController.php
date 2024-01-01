<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Traits\SubcribeTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    use SubcribeTrait;
    public function subscribe(Request $request)
    {
        $request->validate([
            'subjects_ids' => ['required', 'array'],
            'subjects_ids.*' => ['required', 'exists:subjects,id'],
            'amount' => 'required',
            'bill_number' => 'required',
            'payment_method_id' => 'required'
        ]);
        $subjectIds = $request->subjects_ids;
        $result = $this->subcribe(
            $subjectIds,
            $request->amount,
            $request->bill_number,
            $request->payment_method_id,
            Auth::user()->student
        );
        if ($result['status'] = 'success')
            return ResponseHelper::success($subjectIds, 'Subscribed successfully');
        else
            return response()->json($result['message']);
    }
}
