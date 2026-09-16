@extends('layouts.app')
@section('page-title', 'Messages')

@section('content')

<div class="messages-layout" style="height:calc(100vh - 120px)">

    {{-- Conversations List --}}
    <div class="msg-sidebar">
        <div class="msg-sidebar-header">
            💬 Conversations
            @php $totalUnread = $careHomes->sum('unread_count'); @endphp
            @if($totalUnread > 0)
                <span style="float:right;background:var(--teal);color:white;font-size:10px;padding:2px 8px;border-radius:20px;font-weight:700">
                    {{ $totalUnread }}
                </span>
            @endif
        </div>

        @foreach($careHomes as $home)
            @php $isActive = $activeHome && $activeHome->id === $home->id; @endphp
            <a href="{{ route('admin.messages.index', ['home' => $home->id]) }}"
               class="msg-conv {{ $isActive ? 'active' : '' }}"
               data-home-id="{{ $home->id }}">
                <div class="msg-conv-avatar">{{ strtoupper(substr($home->name, 0, 2)) }}</div>
                <div style="flex:1;min-width:0">
                    <div class="msg-conv-name">{{ $home->name }}</div>
                    <div class="msg-conv-preview">
                        {{ $home->messages->first()?->message ?? 'No messages yet' }}
                    </div>
                </div>
                <div style="display:flex;flex-direction:column;align-items:flex-end;gap:4px">
                    <div class="msg-conv-time" style="font-size:11px;color:var(--gray-400)">
                        {{ $home->messages->first()?->created_at->format('H:i') ?? '' }}
                    </div>
                    @if($home->unread_count > 0)
                        <div class="msg-unread">{{ $home->unread_count }}</div>
                    @endif
                </div>
            </a>
        @endforeach
    </div>

    {{-- Chat Window --}}
    <div class="msg-main">
        @if($activeHome)
            <div class="msg-main-header">
                <h3>{{ $activeHome->name }}</h3>
                <span style="font-size:12px;color:var(--gray-400)">
                    👤 {{ $activeHome->manager_name }} — Secure encrypted channel
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
                            {{ $msg->sender->name }} · {{ $msg->created_at->format('H:i') }}
                        </div>
                    </div>
                @empty
                    <div class="empty-state" style="margin:auto">
                        <div class="icon">💬</div>
                        <h3>No messages yet</h3>
                        <p>Send the first message below.</p>
                    </div>
                @endforelse
            </div>

            <div class="msg-input-row">
                <form method="POST" action="{{ route('admin.messages.store') }}"
                      style="display:flex;gap:10px;width:100%">
                    @csrf
                    <input type="hidden" name="care_home_id" value="{{ $activeHome->id }}">
                    <input class="msg-input" type="text" name="message"
                           placeholder="Type a message..." required autocomplete="off">
                    <button type="submit" class="btn btn-teal" style="padding:10px 16px;font-size:18px">➤</button>
                </form>
            </div>
        @else
            <div style="display:flex;align-items:center;justify-content:center;flex:1">
                <div class="empty-state">
                    <div class="icon">💬</div>
                    <h3>Select a conversation</h3>
                    <p>Choose a care home from the left to start messaging.</p>
                </div>
            </div>
        @endif
    </div>

</div>

<script src="https://js.pusher.com/8.0/pusher.min.js"></script>
<script>
    const thread = document.getElementById('msg-thread');
    if (thread) thread.scrollTop = thread.scrollHeight;

    if (typeof Pusher !== 'undefined') {
        const currentUserId = {{ auth()->id() }};
        const activeHomeId = {{ $activeHome ? $activeHome->id : 'null' }};
        const pusherKey = '{{ env('PUSHER_APP_KEY') }}';
        const pusherCluster = '{{ env('PUSHER_APP_CLUSTER') }}';

        if (activeHomeId && pusherKey) {
            const pusher = new Pusher(pusherKey, {
                cluster: pusherCluster,
                forceTLS: true,
            });

            const channel = pusher.subscribe('messages.' + activeHomeId);
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
