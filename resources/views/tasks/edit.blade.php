<x-app-layout>
<div class="card card-dark" style="width: 100%; max-width: 1000px;">
            @if ($errors->any())
            <div style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('tasks.update',$task) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Task Title</label>
                <input type="text" name="title" value="{{ old('title', $task->title) }}" required
                       style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Description</label>
                <textarea name="description" rows="4"
                          style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">{{ old('description', $task->description) }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Status</label>
                    <select name="status" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
                        <option value="todo" {{ old('status', $task->status) == 'todo' ? 'selected' : '' }} style="background: #0f172a; color: #fff;">To Do</option>
                        <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }} style="background: #0f172a; color: #fff;">In Progress</option>
                        <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }} style="background: #0f172a; color: #fff;">Completed</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Priority</label>
                    <select name="priority" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
                        <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }} style="background: #0f172a; color: #fff;">Low</option>
                        <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }} style="background: #0f172a; color: #fff;">Medium</option>
                        <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }} style="background: #0f172a; color: #fff;">High</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Project</label>
                    <select name="project_id" required style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
                        <option value="" style="background: #0f172a; color: #94a3b8;">Select Project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }} style="background: #0f172a; color: #fff;">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Due Date</label>
                    <input type="date" name="due_date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                           style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
                </div>
            </div>

             <div style="margin-bottom: 24px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Assignees</label>
                <div style="max-height: 150px; overflow-y: auto; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px;">
                    @foreach($users as $user)
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                            <input type="checkbox" name="assignees[]" value="{{ $user->id }}" id="user_{{ $user->id }}" 
                                   {{ in_array($user->id, $task->assignees->pluck('id')->toArray()) ? 'checked' : '' }}
                                   class="checkbox-input" style="width: 16px; height: 16px; cursor: pointer;">
                            <label for="user_{{ $user->id }}" style="color: #fff; font-size: 14px; cursor: pointer;">{{ $user->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div style="text-align: right;">
                <button type="submit" class="create-btn" style="display: inline-flex; border: none;">
                    Update Task
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
