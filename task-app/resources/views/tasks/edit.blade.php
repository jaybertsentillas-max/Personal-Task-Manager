<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen flex items-center justify-center p-4 font-sans">

    <div class="w-full max-w-xl bg-gray-900 border border-gray-800 rounded-2xl shadow-2xl p-6 sm:p-8">
        <!-- Header -->
        <div class="mb-6 flex items-center gap-3 border-b border-gray-800 pb-4">
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                <i class="fa-solid fa-pen-to-square text-lg"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold text-white">Edit Task</h1>
                <p class="text-xs text-gray-400">Update the details of your task.</p>
            </div>
        </div>

        <!-- Form -->
        <form action="/tasks/{{ $task->id }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Task Name -->
            <div>
                <label class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Task Name <span class="text-rose-500">*</span></label>
                <input type="text" name="task_name" value="{{ $task->task_name }}" required 
                       class="w-full bg-gray-950 border border-gray-800 rounded-lg px-4 py-2.5 text-sm text-gray-100 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Description</label>
                <textarea name="description" rows="3" 
                          class="w-full bg-gray-950 border border-gray-800 rounded-lg px-4 py-2.5 text-sm text-gray-100 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all resize-none">{{ $task->description }}</textarea>
            </div>

            <!-- Grid for Status and Due Date -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Status -->
                <div>
                    <label class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Status</label>
                    <select name="status" class="w-full bg-gray-950 border border-gray-800 rounded-lg px-4 py-2.5 text-sm text-gray-100 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all">
                        <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <!-- Due Date -->
                <div>
                    <label class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Due Date</label>
                    <input type="date" name="due_date" value="{{ $task->due_date }}" 
                           class="w-full bg-gray-950 border border-gray-800 rounded-lg px-4 py-2.5 text-sm text-gray-100 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all [color-scheme:dark]">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-800">
                <a href="/" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-800 transition-all">
                    Cancel
                </a>
                <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white text-sm font-medium px-5 py-2 rounded-lg shadow-lg shadow-amber-500/20 transition-all">
                    Update Task
                </button>
            </div>
        </form>
    </div>

</body>
</html>