<x-app-layout>
    <div class="card card-dark" style="width: 100%; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 20px;">
            <div>
                <h1 style="font-size: 24px; font-weight: 700; color: #fff; margin: 0;">{{ $task->title }}</h1>
                <div style="color: #94a3b8; font-size: 14px; margin-top: 4px;">Project: {{ $task->project->name ?? 'None' }}</div>
            </div>
            
            <a href="{{ route('tasks.index') }}" style="color: #94a3b8; text-decoration: none; font-size: 14px; display: flex; align-items: center; gap: 4px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"></path><path d="M12 19l-7-7 7-7"></path></svg>
                Back to Tasks
            </a>
        </div>

        <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; padding: 20px; margin-bottom: 24px;">
            <h3 style="color: #fff; font-size: 16px; margin-top: 0; margin-bottom: 12px;">Description</h3>
            <p style="color: #cbd5e1; font-size: 14px; line-height: 1.6; margin: 0;">
                {{ $task->description ?: 'No description provided.' }}
            </p>
            
            <div style="margin-top: 20px; display: flex; gap: 20px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 20px;">
                <div>
                    <div style="color: #64748b; font-size: 12px; margin-bottom: 4px;">Due Date</div>
                    <div style="color: #fff; font-size: 14px;">{{ $task->due_date ? $task->due_date->format('M d, Y') : 'No Date' }}</div>
                </div>
                <div>
                    <div style="color: #64748b; font-size: 12px; margin-bottom: 4px;">Priority</div>
                    <div>
                        @if($task->priority == 'high')
                            <span style="color: #ef4444; background: rgba(239, 68, 68, 0.2); padding: 2px 8px; border-radius: 4px; font-size: 12px;">High</span>
                        @elseif($task->priority == 'medium')
                            <span style="color: #f59e0b; background: rgba(245, 158, 11, 0.2); padding: 2px 8px; border-radius: 4px; font-size: 12px;">Medium</span>
                        @else
                            <span style="color: #10b981; background: rgba(16, 185, 129, 0.2); padding: 2px 8px; border-radius: 4px; font-size: 12px;">Low</span>
                        @endif
                    </div>
                </div>
                <div>
                    <div style="color: #64748b; font-size: 12px; margin-bottom: 4px;">Global Status</div>
                    <div style="color: #fff; font-size: 14px;">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</div>
                </div>
            </div>
        </div>

        <div>
            <h3 style="color: #fff; font-size: 18px; margin-bottom: 16px;">Assigned Users & Status</h3>
            @if($task->assignees->count() > 0)
                <div style="overflow-x: auto; background: rgba(255,255,255,0.02); border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                    <table style="width: 100%; border-collapse: collapse; color: #fff; font-size: 14px;">
                        <thead>
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); text-align: left;">
                                <th style="padding: 12px 16px; color: #94a3b8; font-weight: 500;">User Name</th>
                                <th style="padding: 12px 16px; color: #94a3b8; font-weight: 500;">Email</th>
                                <th style="padding: 12px 16px; color: #94a3b8; font-weight: 500;">Assignee Status</th>
                                <th style="padding: 12px 16px; color: #94a3b8; font-weight: 500;">Assigned At</th>
                                <th style="padding: 12px 16px; color: #94a3b8; font-weight: 500;">Completed At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($task->assignees as $assignee)
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.02);">
                                    <td style="padding: 12px 16px;">{{ $assignee->name }}</td>
                                    <td style="padding: 12px 16px; color: #94a3b8;">{{ $assignee->email }}</td>
                                    <td style="padding: 12px 16px;">
                                        @php
                                            $status = $assignee->pivot->status ?? 'pending';
                                        @endphp
                                        @if($status == 'completed')
                                            <span style="color: #10b981; background: rgba(16, 185, 129, 0.15); padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                                                Completed
                                            </span>
                                        @else
                                            <span style="color: #f59e0b; background: rgba(245, 158, 11, 0.15); padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td style="padding: 12px 16px; color: #64748b; font-size: 12px;">
                                        {{ \Carbon\Carbon::parse($assignee->pivot->assigned_at)->diffForHumans() }}
                                    </td>
                                    <td style="padding: 12px 16px; color: #64748b; font-size: 12px;">
                                        @if($status == 'completed' && $assignee->pivot->updated_at)
                                            {{ \Carbon\Carbon::parse($assignee->pivot->updated_at)->format('M d, Y h:i A') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="padding: 20px; text-align: center; color: #64748b; background: rgba(255,255,255,0.02); border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                    No users assigned to this task.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
