<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\NotificationHelper;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    /**
     * view broadcast and student notification form
     *
     * @param no param
     * @return void
     */
    public function index()
    {
        $notifications = Notification::withCount('students')->orderby('time_publish', 'desc')->get();
        return view('pages.notifications.index', compact('notifications'));
    }
    /**
     * view broadcast and student notification form
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        $all = $request->input('all');
        $package = $request->input('package');
        $subject = $request->input('subject');
        $student = $request->input('student');

        if ($package)
            $package = Package::find($package);
        if ($subject)
            $subject = Subject::find($subject);
        if ($student)
            $student = Student::find($student);

        return view('pages.notifications.create', compact('all', 'package', 'subject', 'student'));
    }

    /**
     * store broadcast and student notification 
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:25',
            'description' => 'required|string|max:255',
            'time_publish' => 'required|date',
        ]);
        $validated['time_publish'] = Carbon::parse($validated['time_publish'])->format('Y-m-d H:i');
        $validated['created_at'] = now();

        $all = $request->input('all');
        $package = $request->input('package');
        $subject = $request->input('subject');
        $student = $request->input('student');

        /* ****************** create notification ************** */
        $notification = Notification::create($validated);

        /***************** Attach notification to students ***************** */
        //get student group according to request (all - package - subject - student)
        $students =
            Student::when(
                $all,
                function ($q) {
                    return $q->where('state', 'current');
                }
            )->when(
                $package,
                function ($q) use ($package) {
                    return $q->wherehas('subjects', function ($q) use ($package) {
                        return $q->where('package_id', $package);
                    });
                }
            )->when(
                $subject,
                function ($q) use ($subject) {
                    return $q->wherehas('subjects', function ($q) use ($subject) {
                        return $q->where('subject_id', $subject);
                    });
                }
            )->when(
                $student,
                function ($q) use ($student) {
                    return $q->where('id', $student);
                }
            )->get();
        // Attach students to notification
        foreach ($students as $student)
            $student->notifications()->attach($notification->id);

        /***************** send fire base notification ***************** */
        //get student ids
        $studentIds =  $students->pluck('id');
        // get fcm token from users table that related to student ids we got before
        $tokens = User::select('fcm_token')->whereHas('student', function ($q) use ($studentIds) {
            $q->wherein('id', $studentIds);
        })->get();
        //convert fcm tokens to index array
        foreach ($tokens as $token) {
            $FCMs[] = $token['fcm_token'];
        }
        NotificationHelper::sendNotification($notification, $FCMs);

        /* ************** return to previous page ******************* */
        if ($package)
            return redirect()->route('packages.index')->with('success', 'Notification has been sent successfully');

        else if ($subject)
            return redirect()->route('packages.show', ['package' => Subject::find($subject)->package_id])->with('success', 'Notification has been sent successfully');
        else if ($student)
            return redirect()->route('students.show', ['student' => $student])->with('success', 'Notification has been sent successfully');

        return back()->with('success', 'Notification has been sent successfully');
    }
    /**
     * view broadcast and student notification form
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request, Notification $notification)
    {
        return view('pages.notifications.edit', compact('notification'));
    }

    /**
     * store broadcast and student notification 
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:25',
            'description' => 'required|string|max:255',
            'time_publish' => 'required|date',
        ]);
        $validated['time_publish'] = Carbon::parse($validated['time_publish'])->format('Y-m-d H:i');

        $notification->update($validated);

        return redirect('notification.index')->with('success', 'Notification has been updated successfully');
    }
    /**
     * store broadcast and student notification 
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification has been updated successfully');
    }
}
