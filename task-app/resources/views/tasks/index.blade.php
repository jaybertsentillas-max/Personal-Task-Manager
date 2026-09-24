<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen font-sans">

    <div class="max-w-5xl mx-auto px-4 py-10">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-white flex items-center gap-3">
                    <i class="fa-solid fa-[#6366f1] fa-list-check text-indigo-500"></i> Personal Task Manager
                </h1>
                <p class="text-gray-400 text-sm mt-1">Organize and track your daily tasks effortlessly.</p>
            </div>
            <a href="/tasks/create" 
               class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium px-5 py-2.5 rounded-lg shadow-lg shadow-indigo-500/20 transition-all duration-200">
                <i class="fa-solid fa-plus text-sm"></i> Add New Task
            </a>
        </div>

        <!-- Success Alert Message -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Tasks Table Container -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-800/50 border-b border-gray-800 text-gray-400 text-xs font-semibold uppercase tracking-wider">
                            <th class="py-4 px-6">Task Name</th>
                            <th class="py-4 px-6">Description</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6">Due Date</th>
                            <th class="py-4 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800/60 text-sm">
                        @forelse($tasks as $task)
                            <tr class="hover:bg-gray-800/30 transition-colors duration-150">
                                <td class="py-4 px-6 font-medium text-white">
                                    {{ $task->task_name }}
                                </td>
                                <td class="py-4 px-6 text-gray-400 max-w-xs truncate">
                                    {{ $task->description ?? '—' }}
                                </td>
                                <td class="py-4 px-6">
                                    @if(strtolower($task->status) === 'completed')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Completed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-gray-400">
                                    {{ $task->due_date ? date('M d, Y', strtotime($task->due_date)) : 'No due date' }}
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <a href="/tasks/{{ $task->id }}/edit" 
                                       class="inline-flex items-center gap-1.5 text-xs font-medium text-amber-400 hover:text-amber-300 bg-amber-400/10 hover:bg-amber-400/20 px-3 py-1.5 rounded-md border border-amber-400/20 transition-all">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>

                                    <form action="/tasks/{{ $task->id }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1.5 text-xs font-medium text-rose-400 hover:text-rose-300 bg-rose-400/10 hover:bg-rose-400/20 px-3 py-1.5 rounded-md border border-rose-400/20 transition-all">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <i class="fa-solid fa-inbox text-3xl text-gray-600"></i>
                                        <p class="text-base font-medium">No tasks found</p>
                                        <p class="text-xs text-gray-600">Click "+ Add New Task" above to get started.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>