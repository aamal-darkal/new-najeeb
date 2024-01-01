<?php

namespace App\Traits;

use App\Http\Helpers\MessagingHelper;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait SubcribeTrait
{

    public function subcribe($subjects_ids, $amount, $bill_number, $payment_method_id, $student)
    {
        
        $subjects = Subject::find($subjects_ids);        

        $totalCost = $subjects->sum('cost');

        if ($totalCost > $amount) {
            return [
                'status' => 'error',
                'message' => 'the amount you paid is less than the cost'
            ];            
        }

        $order = $student->orders()->create(
            [
                'amount' => $amount,
            ]
        );

        foreach ($subjects as $subject) {
            $order->subjects()->attach($subject->id, ['cost' => $subject->cost]);
        }
        $order->payments()->create([
            'bill_number' => $bill_number,
            'amount' => $amount,
            'payment_method_id' => $payment_method_id,
            'start_duration_date' => $subjects->first()->package->start_date,
            'payment_date' => Carbon::now(), 
        ]);
        return [
            'status' => 'success',            
        ];
    }
    private function generatePassword($n)
    {
        $characters = '123456789';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    private function createUser($student)
    {
        
        $userName = $student->first_name . $student->id;
        $password = $this->generatePassword(8);

        $user = $student->user()->create([
            'user_name' =>  $userName,
            'password' => Hash::make($password),
        ]);

        //change user state
        $student->update(['state' => 'current', 'user_id' => $user->id]);
        $msg = "مرحباً " . $student->first_name . " لقد تم تأكيد طلبكم لقد أصبح لديك حساب في تطبيق نجيب \n أسم المستخدم: " . $userName . " و كلمة السر : " . $password;
        $to = $student->phone;
        (new MessagingHelper)->sendMessage($msg, $to);
        event(new Registered($user));
    }
}
