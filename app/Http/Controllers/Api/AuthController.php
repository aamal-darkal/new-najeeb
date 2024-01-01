<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\SettingsHelper;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\UserInfoResource;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Traits\SubcribeTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use SubcribeTrait;

    public function registerStudent(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());
        if (!$student) return response()->json([
            'data' => $student,
            'errors' => 'error in register student',
        ]);
        $subjectIds = $request->subjects_ids;
        $result = $this->subcribe(
           $subjectIds,
            $request->amount,
            $request->bill_number,
            $request->payment_method_id,
            $student
        );
        if ($result['status'] = 'success')
            return ResponseHelper::success($subjectIds , 'Subscribed successfully');
        else
            return response()->json($result['message']);
    }

    public function login(Request $request)
    {
        $request['user_name'] = $request->username;
        if (!Auth::attempt($request->only('user_name', 'password'))) {
            return response()->json([
                'message' => 'Login information is invalid.'
            ], 401);
        }

        $user = User::where('user_name', $request['user_name'])->firstOrFail();
        $banPeriod = SettingsHelper::getSetting('min_count_days_before_relogin');
        if ($user->token_birth && Carbon::make($user->token_birth)->diffInDays(Carbon::now()) <= $banPeriod)
            return response()->json([
                'message' => "لا يمكن تسجبل الدخول أكثر من مرةخلال $banPeriod بوم"
            ], 401);

        $user->update(['fcm_token' => $request->fcm_token, 'token_birth' => Carbon::now()]);
        $token = $user->createToken('authToken')->plainTextToken;
        $student = Student::where('user_id', $user->id)->first();
        $user['photo'] = null;
        $user['name'] = $student->first_name . ' ' . $student->last_name;
        $user['phone'] = $student->phone;
        $user['token'] = $token;
        return response()->json([
            'status' => 200,
            'data' => $user,
        ]);
    }

    public function getUserInfo(Request $request)
    {
        $user = User::with('student')->find(Auth::id());
        $user['token'] = $request->bearerToken();
        return new UserInfoResource($user);
    }

    public function myPayments()
    {
        $studentId = Student::select('id')->where('user_id', Auth::id())->first()->id;

        $payments = Payment::whereHas('order', function ($q) use ($studentId) {
            return $q->where('student_id', $studentId);
        })
            ->get();
        return  PaymentResource::collection($payments);
    }


    public function resetTokenDate() {
        $userId = Auth::id();
        User::find($userId)->update(['token_birth' => null]);
        return ['success' => 'Token birth is reset successfuly'];

    }
}
