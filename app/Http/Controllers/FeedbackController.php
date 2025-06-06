<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('user')->latest()->get();
        return view('feedback.index', compact('feedbacks'));
    }

    public function store(StoreFeedbackRequest $request)
    {
        $feedback = Feedback::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'rating' => $request->rating
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        $feedback->update($request->validated());
        return redirect()->back()->with('success', 'Feedback updated successfully!');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->back()->with('success', 'Feedback deleted successfully!');
    }
}
