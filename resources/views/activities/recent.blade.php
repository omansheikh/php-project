<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold leading-tight text-gray-800">
            Recent Activities
        </h1>
    </x-slot>

    <div class="activity-list">
        <ul>
            @forelse ($activities as $activity)
                @if ($activity->description === 'upload')
                    <li>Uploaded a file - {{ $activity->created_at->diffForHumans() }}</li>
                @elseif ($activity->description === 'delete')
                    <li>Deleted a file - {{ $activity->created_at->diffForHumans() }}</li>
                @elseif ($activity->description === 'share')
                    <li>Shared a file - {{ $activity->created_at->diffForHumans() }}</li>
                @endif
            @empty
                <li>No recent activities.</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>
