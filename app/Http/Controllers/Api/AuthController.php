<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MessagingHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\SettingsHelper;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\UserInfoResource;
use App\Models\Payment;
use App\Models\Student;
use App\Models\TempRegister;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * registerStudent using
     * request: mobile,password,first_name,last_name,father_name,parent_phone,governorate,otp
     * @param StoreStudentRequest $request
     * @return void
     */
    public function registerStudent(StoreStudentRequest $request)
    {
        /************ Adding temp register *****************/
        $otp = $this->generateRandomNO(6);
        $request['otp'] = $otp;
        $request['password'] = hash::make($request['password']);
        $tempRegister = TempRegister::create($request->all());
        if (!$tempRegister) return ResponseHelper::error($request->all(), 'Error in register user');

        /****** sending otp *********************/
        try {
            $msg = "إدارة نجيب ترحب بك  " . $tempRegister->first_name . "\n الرمز : " . $otp;
            $mobile = $tempRegister->mobile;
            (new MessagingHelper)->sendMessage($msg, $mobile);
        } catch (Exception $e) {
            return ResponseHelper::error(['exception' => $e->getMessage()], 'Syriatel SMS API not working');
        }

        /******* everything is OK *****/
        return ResponseHelper::success(compact('mobile'), 'otp request successfully sended');
    }
    /**
     * resendOtp to:
     * request: mobile
     *
     * @param [type] $request
     * @return void
     */
    function resendOtp(Request $request)
    {
        $mobile = $request->mobile;
        
        /******* user has already account=> no need for otp *****/
        $userExist = User::where('mobile' , $mobile)->first();
        if($userExist)
            return ResponseHelper::error(compact('mobile'), "$mobile has account no need for otp");

        /******* check if user register  *****/        
        $tempRegister = TempRegister::where('mobile', $mobile)
            ->latest()
            ->first();

        if (!$tempRegister)
            return ResponseHelper::error(compact('mobile'), "$mobile not found in registered records");

        $otp = $this->generateRandomNO(6);
        $tempRegister->update(['otp' => $otp]);

        /****** sending new otp *********************/
        try {
            $msg = "إدارة نجيب ترحب بك  " . $tempRegister->first_name . "\n الرمز : " . $otp;
            (new MessagingHelper)->sendMessage($msg, $mobile);
        } catch (Exception $e) {
            return ResponseHelper::error(['exception' => $e->getMessage()], 'Syriatel SMS API not working');
        }

        /******* everything is OK *****/
        return ResponseHelper::success(compact('mobile'), 'otp request successfully resended');
    }
    /**
     * confirmOtp using: 
     * request: mobile, otp
     * @param Request $request
     * @return void
     */
    public function confirmOtp(Request $request)
    {
        //1-fetch record
        $mobile = $request->mobile;
        $otp = $request->otp;
        $tempRegister = TempRegister::where('mobile', $mobile)
            ->where('otp', $otp)
            ->first();

        if (!$tempRegister)
            return ResponseHelper::error(compact('mobile', 'otp'), 'not found');

        //check otp age
        $otpTimeout = SettingsHelper::getSetting('otp-timeout-in-Minute');
        $otpAge = Carbon::now()->diffInMinutes(Carbon::make($tempRegister->updated_at));

        if ($otpAge > $otpTimeout)
            return ResponseHelper::error(compact('otpAge', 'otpTimeout'), 'otp expire');

        /************ Adding User *****************/
        $data = $tempRegister->only('mobile', 'password');
        $user = User::create($data);

        if (!$user) return ResponseHelper::error($data, 'Error in Adding user');

        /************ Adding Student *****************/
        $tempRegister->user_id = $user->id;
        $data = $tempRegister->only(
            "first_name",
            "last_name",
            "father_name",
            "parent_phone",
            "governorate",
            "user_id"
        );
        $student = Student::create($data);

        if (!$student) return ResponseHelper::error($data, 'Error in Adding student');

        /******* everything is OK *****/
        $data = ['user_id' => $user->id, 'student_id' => $student->id];
        return ResponseHelper::success($data, 'otp Ok');
    }

    /**
     * login using 
     * request: mobile , password
     * in addition to request:fcm_token for firebase
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        /******* check mobile & password *****/
        $data = $request->only('mobile', 'password');
        if (!Auth::attempt($data)) {
            return response()->error($data, 'Login information is invalid.');
        }

        $user = Auth::user();

        /******* check token age *****/
        $banPeriod = SettingsHelper::getSetting('min_count_days_before_relogin');

        if (
            $user->token_birth &&
            Carbon::make($user->token_birth)->diffInDays(Carbon::now()) <= $banPeriod
        ) {
            $data = ['banPeriod' => $banPeriod, 'token_birth' => $user->token_birth];
            return ResponseHelper::error($data,  "لا يمكن تسجبل الدخول أكثر من مرة خلال $banPeriod يوم");
        }

        /******* create sanctum token*****/
        $token = $user->createToken('authToken')->plainTextToken;

        /******* update  fcm_token & token_birth*****/
        $user->update(['fcm_token' => $request->fcm_token, 'token_birth' => Carbon::now()]);

        $student = Student::where('user_id', $user->id)->first();
        $data = [
            'student_id' => $student->id,
            'name' => $student->first_name . ' ' . $student->last_name,
            'token' => $token,
        ];
        return ResponseHelper::success($data, 'login successfully');
    }

    // public function getUserInfo(Request $request)
    // {
    //     $user = User::with('student')->find(Auth::id());
    //     $user['token'] = $request->bearerToken();
    //     return new UserInfoResource($user);
    // }

    // public function myPayments()
    // {
    //     $studentId = Student::select('id')->where('mobile', Auth::id())->first()->id;

    //     $payments = Payment::whereHas('order', function ($q) use ($studentId) {
    //         return $q->where('student_id', $studentId);
    //     })
    //         ->get();
    //     return  PaymentResource::collection($payments);
    // }


    // public function resetTokenDate()
    // {
    //     $userId = Auth::id();
    //     User::find($userId)->update(['token_birth' => null]);
    //     return ['success' => 'Token birth is reset successfuly'];
    // }


    private function generateRandomNO($length)
    {
        $characters = '123456789';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}
