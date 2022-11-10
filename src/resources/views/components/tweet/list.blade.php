@props([
    'tweets' => []
])
<div class="bg-white rounded-md shadow-lg mt-5 md-5">
    <ul>
        @foreach($tweets as $tweet)
            <li class="border-b list:broder-b-0 border-gray-200 p-4 flex items-start justify-detween">
                <div>
                    <span class="inline-block rounded-full text-gray-600 bg-gray-100 px-2 py-1 text-xs mb-2">
                        {{ $tweet->user->name }}
                    </span>
                    <p class="text-gray-600">{!! nl2br(e($tweet->content)) !!}</p>
                </div>    
                <div>
                    <!-- TODO 編集と削除 -->
                </div>
            </li>
        @endforeach
    </ul>
</div>
