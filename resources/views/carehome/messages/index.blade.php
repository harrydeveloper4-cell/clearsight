@extends('layouts.app')
@section('page-title', 'Messages')

@section('content')

<div class="section-header">
    <div>
        <div class="section-title">Messages</div>
        <div class="section-sub">Secure communication with ClearSight team</div>
    </div>
</div>

<div class="messages-layout" style="height:calc(100vh - 160px)">

    {{-- Left Panel: Info --}}
    <div class="msg-sidebar">
        <div class="msg-sidebar-header">💬 ClearSight Team</div>
        <div style="padding:16px">
            <div style="display:flex;align-items:center;gap:12px;padding:14px;background:var(--teal-pale);border-radius:10px;border:1px solid rgba(14,165,181,.2)">
                <div style="width:44px;height:44px;background:var(--navy);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:700;color:white;flex-shrink:0">CS</div>
                <div>
                    <div style="font-size:13px;font-weight:700;color:var(--navy)">ClearSight Domiciliary</div>
                    <div style="font-size:12px;color:var(--gray-600)">Eye & Hearing Care Team</div>
                </div>
            </div>

            <div style="margin-top:16px;font-size:12px;color:var(--gray-600);line-height:1.7">
                <div style="font-weight:700;color:var(--navy);margin-bottom:6px"> Contact Details</div>
          
                <div>📞 0333 3355350</div
                <div>📧 Info@clearsightdomiciliary.com</div>
                <div>🌐 <a href="https://clearsightdomiciliary.com/" target="_blank" style="font-size: 12px;color: var(--gray-600);">Clearsight Domiciliary  | Home & Carehome Eyecare | 7 Days A Week | Book Now</a></div>
                
                <div style="margin-top:10px;padding:8px 10px;background:var(--success-light);border-radius:7px;border:1px solid #86efac;font-size:11px;color:#15803d">
                    🔒 This is a secure, encrypted channel. All messages are private between your care home and ClearSight.
                </div>
            </div>
            
        
    </div>

    {{-- Chat Window --}}
    <div class="msg-main">
        <div class="msg-main-header">
            <h3>ClearSight Domiciliary</h3>
            <span style="font-size:12px;color:var(--gray-400)">
                Secure NHS-encrypted channel · {{ auth()->user()->careHome->name ?? '-' }}
            </span>
        </div>

        <div class="msg-thread" id="msg-thread">
            @forelse($thread as $msg)
                @php $isMe = $msg->sender_id === auth()->id(); @endphp
                <div class="msg-bubble-wrap {{ $isMe ? 'me' : '' }}">
                    <div class="msg-bubble {{ $isMe ? 'me' : 'them' }}">
                        {{ $msg->message }}
                    </div>
                    <div class="msg-meta">
                        {{ $isMe ? 'You' : 'ClearSight' }} · {{ $msg->created_at->format('d M, H:i') }}
                    </div>
                </div>
            @empty
                <div style="display:flex;align-items:center;justify-content:center;flex:1;height:100%">
                    <div class="empty-state">
                        <div class="icon">💬</div>
                        <h3>No messages yet</h3>
                        <p>Send a message to the ClearSight team below.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="msg-input-row">
            <form method="POST" action="{{ route('carehome.messages.store') }}"
                  style="display:flex;gap:10px;width:100%">
                @csrf
                <input type="hidden" name="care_home_id" value="{{ $careHomeId }}">
                <input class="msg-input" type="text" name="message"
                       placeholder="Type a message to ClearSight..." required autocomplete="off">
                <button type="submit" class="btn btn-teal"
                        style="padding:10px 18px;font-size:18px">➤</button>
            </form>
        </div>
    </div>

</div>

<script src="https://js.pusher.com/8.0/pusher.min.js"></script>
<script>
    const thread = document.getElementById('msg-thread');
    if (thread) thread.scrollTop = thread.scrollHeight;

    if (typeof Pusher !== 'undefined') {
        const currentUserId = {{ auth()->id() }};
        const careHomeId = {{ $careHomeId }};
        const pusherKey = '{{ env('PUSHER_APP_KEY') }}';
        const pusherCluster = '{{ env('PUSHER_APP_CLUSTER') }}';

        if (careHomeId && pusherKey) {
            const pusher = new Pusher(pusherKey, {
                cluster: pusherCluster,
                forceTLS: true,
            });

            const channel = pusher.subscribe('messages.' + careHomeId);
            channel.bind('new-message', function(data) {
                if (!thread) return;
                appendMessage(data);
            });
        }
    }

    function appendMessage(data) {
        const isMe = data.sender_id === {{ auth()->id() }};
        const bubbleWrap = document.createElement('div');
        bubbleWrap.className = 'msg-bubble-wrap ' + (isMe ? 'me' : '');

        const bubble = document.createElement('div');
        bubble.className = 'msg-bubble ' + (isMe ? 'me' : 'them');
        bubble.textContent = data.message;

        const meta = document.createElement('div');
        meta.className = 'msg-meta';
        meta.textContent = (isMe ? 'You' : data.sender_name) + ' · ' + data.created_at;

        bubbleWrap.appendChild(bubble);
        bubbleWrap.appendChild(meta);
        thread.appendChild(bubbleWrap);
        thread.scrollTop = thread.scrollHeight;
    }
</script>

@endsection
