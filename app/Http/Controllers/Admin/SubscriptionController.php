<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Student;
use App\Traits\SubcribeTrait;
use Illuminate\Http\Request;


class SubscriptionController extends Controller
{
    use SubcribeTrait;
    public function index()
    {
        $payments = Payment::with('order.subjects', 'order.student')->with(['order' =>   function ($q) {
            return $q->withCount('subjects');
        }])->get();
        return view('pages.subscriptions.index', compact('payments'));
    }

    public function edit($status)
    {
        $payments = Payment::with('order.subjects', 'order.student')->with(['order' =>   function ($q) {
            return $q->withCount('subjects');
        }])->when($status == 'approved', function ($q) {
            return $q->where('state', 'approved');
        })->when($status == 'rejected', function ($q) {
            return $q->where('state', 'rejected');
        })->when($status == 'pending', function ($q) {
            return $q->where('state', 'pending');
        })->get();

        return view('pages.subscriptions.edit', compact('payments', 'status'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required',
            'ids' => 'required',
            'ids.*' => 'exists:payments,id'
        ]);
        $action = $validated['action'];
        $ids = $validated['ids'];


        if ($action == 'reject') {
        // ********************* reject **************************
            $payments = payment::find($ids);

            foreach ($payments as $payment){
                $order  = $payment->order;
                $student =  $order->student;
                $payment->delete();
                //check if order has no old payments => delete it
                if (! $order->payments->count())
                    $order->delete();
                //check if student new => delete it
                if ($student->state == 'new')
                    $student->delete();

            }                

        } else if ($action == 'approve') {
            // ********************* approve **************************
            $payments = payment::with('order.student.user', 'order.subjects')->find($ids);

            foreach ($payments as $payment) {
                $student = $payment->order->student;
                $subjectsIds = $payment->order->subjects->pluck('id');
                $preSubcribed = $student->subjects()->wherePivotIn('subject_id', $subjectsIds)->get();
                //check if they pre subcribed
                if ($preSubcribed->first()) {
                    $subList = '';
                    foreach ($preSubcribed  as  $sub) {
                        $subList .= "$sub->name ";
                    }
                    return back()->with('error', "$subList subcribed before")->withInput();
                }   

                $payment->update(['state' => 'approved']);
                
                //attach subject to student
                $student->subjects()->attach($subjectsIds);

                //create user if is not exists
                if (!$student->user)
                    $this->createUser($student);
            }
            // ********************* unapprove **************************
        } else if ($action == 'unapprove') {
            $payments = payment::with('order.student', 'order.subjects')->find($ids);
            foreach ($payments as $payment) {
                $payment->update(['state' => 'pending']);

                $student = $payment->order->student;

                //dettach subjects from student
                $subjects = $payment->order->subjects;
                $student->subjects()->detach($subjects);
            }
        }
        return back()->with('success', 'payments updated successfully');
    }
}
