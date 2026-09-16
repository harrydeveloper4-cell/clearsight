<?php

namespace App\Http\Controllers;

use App\Models\CareHome;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class MessageController extends Controller
{
    // ─── Messages Page ───────────────────────────────────────────

    public function index(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            // Admin: sees conversations grouped by care home
            $careHomes = CareHome::with(['messages' => fn($q) => $q->latest()->take(1)])
                ->withCount(['messages as unread_count' => fn($q) => $q->where('is_read', false)->where('sender_id', '!=', Auth::id())])
                ->get();

            $activeCareHomeId = $request->get('home', $careHomes->first()?->id);
            $activeHome       = CareHome::find($activeCareHomeId);

            $thread = $activeHome
                ? Message::with('sender')
                    ->where('care_home_id', $activeCareHomeId)
                    ->oldest()
                    ->get()
                : collect();

            // Mark messages in this thread as read
            if ($activeHome) {
                Message::where('care_home_id', $activeCareHomeId)
                    ->where('sender_id', '!=', Auth::id())
                    ->update(['is_read' => true]);
            }

            return view('admin.messages.index', compact('careHomes', 'activeHome', 'thread'));
        }

        // Care home user: sees their own thread with ClearSight admin
        $careHomeId = Auth::user()->care_home_id;

        $thread = Message::with('sender')
            ->where('care_home_id', $careHomeId)
            ->oldest()
            ->get();

        // Mark admin messages as read
        Message::where('care_home_id', $careHomeId)
            ->where('sender_id', '!=', Auth::id())
            ->update(['is_read' => true]);

        return view('carehome.messages.index', compact('thread', 'careHomeId'));
    }

    // ─── Send Message ────────────────────────────────────────────

    public function store(Request $request)
    {
        $data = $request->validate([
            'message'      => 'required|string|max:2000',
            'care_home_id' => 'required|exists:care_homes,id',
        ]);

        // Care home users can only send to their own thread
        if (Auth::user()->isCareHome() && (int) $data['care_home_id'] !== Auth::user()->care_home_id) {
            abort(403);
        }

        $message = Message::create([
            'care_home_id' => $data['care_home_id'],
            'sender_id'    => Auth::id(),
            'message'      => $data['message'],
        ]);

        if (env('PUSHER_APP_ID') && env('PUSHER_APP_KEY') && env('PUSHER_APP_SECRET')) {
            try {
                $pusher = new Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    [
                        'cluster' => env('PUSHER_APP_CLUSTER'),
                        'useTLS'  => true,
                    ]
                );

                $pusher->trigger('messages.' . $message->care_home_id, 'new-message', [
                    'id'          => $message->id,
                    'care_home_id'=> $message->care_home_id,
                    'sender_id'   => $message->sender_id,
                    'sender_name' => Auth::user()->name,
                    'message'     => $message->message,
                    'created_at'  => $message->created_at->format('d M, H:i'),
                ]);
            } catch (\Exception) {
                // Fall back silently if Pusher is unavailable.
            }
        }

        return back();
    }
}
