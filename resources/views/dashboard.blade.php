<x-app-layout>
    <!-- Top Cards Row -->
    <div class="cards-grid">
        <!-- Overall Information Card -->
        <div class="card card-dark">
            <div class="card-title">
                <span>Overall Information</span>
                <div style="display: flex; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 12v8a2 2 0 002 2h12a2 2 0 002-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></svg>
                </div>
            </div>

            <div class="overall-stats">
                <div class="overall-stat">
                    <div class="stat-number">{{ $completedTasks }}</div>
                    <div class="stat-label">tasks done<br>all time</div>
                </div>
                <div class="overall-stat">
                    <div class="stat-number">{{ $totalProjects }}</div>
                    <div class="stat-label">total<br>projects</div>
                </div>
            </div>

            <div class="mini-cards">
                <div class="mini-card">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin: 0 auto 8px;"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"></path></svg>
                    <div class="mini-number">{{ $totalProjects }}</div>
                    <div class="mini-label">Projects</div>
                </div>
                <div class="mini-card">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin: 0 auto 8px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <div class="mini-number">{{ $pendingTasks }}</div>
                    <div class="mini-label">In Progress</div>
                </div>
                <div class="mini-card">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin: 0 auto 8px;"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <div class="mini-number">{{ $completedTasks }}</div>
                    <div class="mini-label">Completed</div>
                </div>
            </div>
        </div>

        <!-- Weekly Progress Card (Placeholder) -->
        <div class="card">
             <div class="card-title">
                <span>Weekly progress</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
             <div style="height: 120px; background: rgba(255,255,255,0.03); border-radius: 12px; margin-bottom: 12px; position: relative; overflow: hidden;">
                <svg style="width: 100%; height: 100%;" viewBox="0 0 280 120" preserveAspectRatio="none">
                    <path d="M 0,60 Q 40,80 70,40 T 140,60 T 210,35 T 280,70" fill="none" stroke="#3b82f6" stroke-width="2" opacity="0.8"/>
                     <path d="M 0,75 Q 40,95 70,55 T 140,75 T 210,50 T 280,85" fill="none" stroke="#8b5cf6" stroke-width="2" opacity="0.6"/>
                </svg>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 12px; color: #64748b;">
                <span>M</span><span>T</span><span>W</span><span>T</span><span>F</span><span>S</span><span>S</span>
            </div>
        </div>

        <!-- Task Completion Card -->
        <div class="card">
            <div class="card-title">
                <span>Task Completion</span>
            </div>

            <div style="font-size: 13px; color: #10b981; margin-bottom: 16px;">
                {{ $completionRate }}% completion rate
            </div>

            <div class="progress-circle" style="border-color: #3b82f6;">
                <div class="circle-value">{{ $completionRate }}%</div>
            </div>

            <button style="width: 100%; padding: 10px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                 Download Report
            </button>
        </div>
    </div>

    <!-- Month Goals & Tasks Row -->
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 20px;">
        <!-- Month Goals -->
        <div class="card">
            <div class="card-title">
                <span>Month goals:</span>
                <a href="{{ route('goals.create') }}" style="color: #64748b;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
            </div>

            <div>
                @forelse($monthlyGoals as $goal)
                <div class="goal-item">
                    <div class="checkbox {{ $goal->is_completed ? 'checked' : '' }}"></div>
                    <label style="color: {{ $goal->is_completed ? '#fff' : '#94a3b8' }}; font-size: 14px;">{{ $goal->title }}</label>
                </div>
                @empty
                <div style="color: #64748b; font-size: 13px; padding: 10px 0;">No goals set for this month.</div>
                @endforelse
            </div>
        </div>

        <!-- Task In Process -->
        <div class="card">
            <div class="card-title" style="margin-bottom: 20px;">
                <span>Tasks In Progress ({{ $tasksInProgress->count() }})</span>
            </div>

            <div class="task-cards">
                @foreach($tasksInProgress as $task)
                <div class="task-card">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        @if($task->priority == 'high')
                        <span style="color: #ef4444;">●</span>
                        @elseif($task->priority == 'medium')
                        <span style="color: #f59e0b;">●</span>
                        @else
                        <span style="color: #10b981;">●</span>
                        @endif
                    </div>
                    <h4 style="color: #fff; font-size: 15px; margin-bottom: 12px;">{{ $task->title }}</h4>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 13px; color: #64748b;">{{ $task->due_date ? $task->due_date->format('M d') : 'No due date' }}</span>
                        <a href="{{ route('tasks.edit', $task) }}" class="icon-btn" style="width: 32px; height: 32px; background: rgba(15,23,42,0.9); text-decoration: none; color: white;">
                             <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach

                <a href="{{ route('tasks.create') }}" class="add-task-card" style="text-decoration: none;">
                    <div style="text-align: center; color: #64748b;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin: 0 auto 8px;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        <div style="font-weight: 600; font-size: 14px;">Add task</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Last Projects Section -->
    <div class="card" style="margin-top: 20px;">
        <div class="card-title" style="margin-bottom: 20px;">
            <span>Last Projects</span>
        </div>

        <div class="projects-grid">
            @forelse($recentProjects as $project)
            <div class="project-card">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;">
                    <div>
                        <h4 style="color: #fff; font-size: 16px; margin-bottom: 8px;">{{ $project->name }}</h4>
                        <div class="project-status {{ $project->status == 'completed' ? 'status-completed' : 'status-progress' }}">
                            ● {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </div>
                    </div>
                </div>
                <p style="font-size: 13px; color: #94a3b8; line-height: 1.6;">
                    {{ Str::limit($project->description, 60) }}
                </p>
            </div>
            @empty
            <div style="color: #64748b; font-size: 14px;">No recent projects.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>
