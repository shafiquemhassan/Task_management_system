<div class="space-y-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">My Assigned Tasks</h1>
        <div class="text-sm text-gray-500">
            {{ $tasks->count() }} total tasks
        </div>
    </div>

    @if($tasks->isEmpty())
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No tasks assigned</h3>
            <p class="mt-1 text-sm text-gray-500">You currently have no tasks assigned to you. Enjoy your day!</p>
        </div>
    @else
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($tasks as $task)
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200 flex flex-col h-full transition hover:shadow-md">
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-medium text-gray-900 line-clamp-2 leading-tight">{{ $task->title }}</h3>
                            
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium shrink-0 ml-3
                                @if($task->status === 'completed') bg-green-100 text-green-800
                                @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                                @else bg-yellow-100 text-yellow-800
                                @endif
                            ">
                                {{ $task->status_label }}
                            </span>
                        </div>
                        
                        @if($task->description)
                            <p class="text-sm text-gray-500 mb-4 line-clamp-3 flex-1">{{ $task->description }}</p>
                        @endif
                        
                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="flex-shrink-0 mr-1.5 h-4 w-4 @if($task->isOverdue()) text-red-500 @else text-gray-400 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="@if($task->isOverdue()) text-red-600 font-medium @endif">
                                    {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-5 py-3 border-t border-gray-200">
                        <div class="flex justify-end gap-2 text-sm">
                            @if($task->status !== 'pending')
                                <button wire:click="updateStatus({{ $task->id }}, 'pending')" class="text-gray-600 hover:text-yellow-600 font-medium transition-colors">
                                    Mark Pending
                                </button>
                            @endif
                            
                            @if($task->status !== 'in_progress')
                                <button wire:click="updateStatus({{ $task->id }}, 'in_progress')" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">
                                    Start Progress
                                </button>
                            @endif
                            
                            @if($task->status !== 'completed')
                                <button wire:click="updateStatus({{ $task->id }}, 'completed')" class="text-gray-600 hover:text-green-600 font-medium transition-colors ml-auto">
                                    Complete Task
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-4 text-center" wire:loading>
            <span class="inline-flex items-center px-4 py-2 text-sm font-medium leading-6 text-indigo-600 transition duration-150 ease-in-out">
                <svg class="w-5 h-5 mr-3 -ml-1 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Updating status...
            </span>
        </div>
    @endif
</div>
