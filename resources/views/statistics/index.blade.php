<x-app-layout>
    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 24px;
            backdrop-filter: blur(20px);
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #fff;
            font-family: 'Outfit', sans-serif;
        }

        .stat-label {
            font-size: 14px;
            color: #94a3b8;
            font-weight: 500;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .chart-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 32px;
            backdrop-filter: blur(20px);
        }

        .chart-header {
            margin-bottom: 24px;
        }

        .chart-title {
            font-size: 20px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .progress-bar-container {
            margin-bottom: 20px;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
            color: #cbd5e1;
        }

        .progress-track {
            height: 12px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 6px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 6px;
            transition: width 1s ease;
        }

        .recent-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .recent-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            transition: all 0.2s ease;
        }

        .recent-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        /* Color Themes */
        .color-purple { background: rgba(168, 85, 247, 0.2); color: #d8b4fe; }
        .fill-purple { background: linear-gradient(90deg, #a855f7, #d8b4fe); }
        
        .color-blue { background: rgba(59, 130, 246, 0.2); color: #93c5fd; }
        .fill-blue { background: linear-gradient(90deg, #3b82f6, #93c5fd); }

        .color-green { background: rgba(34, 197, 94, 0.2); color: #86efac; }
        .fill-green { background: linear-gradient(90deg, #22c55e, #86efac); }
        
        .color-orange { background: rgba(249, 115, 22, 0.2); color: #fdba74; }
        .fill-orange { background: linear-gradient(90deg, #f97316, #fdba74); }

        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .charts-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>

    <!-- 1. Key Metrics Cards -->
    <div class="stats-grid">
        <!-- Total Tasks -->
        <div class="stat-card">
            <div class="stat-icon color-blue">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg>
            </div>
            <div class="stat-value">{{ $totalTasks }}</div>
            <div class="stat-label">Total Tasks</div>
        </div>

        <!-- Completion Rate -->
        <div class="stat-card">
            <div class="stat-icon color-green">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
            <div class="stat-value">{{ $completionRate }}%</div>
            <div class="stat-label">Completion Rate</div>
        </div>

        <!-- Active Projects -->
        <div class="stat-card">
            <div class="stat-icon color-purple">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l10 6.5v7L12 22 2 15.5v-7L12 2z"></path></svg>
            </div>
            <div class="stat-value">{{ $totalProjects }}</div>
            <div class="stat-label">Active Projects</div>
        </div>

         <!-- Members/Teams -->
         <div class="stat-card">
            <div class="stat-icon color-orange">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div class="stat-value">{{ $totalTeams }}</div>
            <div class="stat-label">Total Teams</div>
        </div>
    </div>

    <div class="charts-grid">
        <!-- 2. Task Breakdown (Bars) -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Task Distribution</h3>
                <p style="color: #64748b; font-size: 14px;">Breakdown by status and priority</p>
            </div>
            
            <!-- Status Rows -->
            <div class="progress-bar-container">
                <div class="progress-label">
                    <span>Completed</span>
                    <span>{{ $tasksByStatus['completed'] }} Tasks</span>
                </div>
                <div class="progress-track">
                    <div class="progress-fill fill-green" style="width: {{ $totalTasks > 0 ? ($tasksByStatus['completed'] / $totalTasks) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div class="progress-bar-container">
                <div class="progress-label">
                    <span>In Progress</span>
                    <span>{{ $tasksByStatus['in_progress'] }} Tasks</span>
                </div>
                <div class="progress-track">
                    <div class="progress-fill fill-blue" style="width: {{ $totalTasks > 0 ? ($tasksByStatus['in_progress'] / $totalTasks) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div class="progress-bar-container">
                <div class="progress-label">
                    <span>To Do</span>
                    <span>{{ $tasksByStatus['todo'] }} Tasks</span>
                </div>
                <div class="progress-track">
                    <div class="progress-fill fill-purple" style="width: {{ $totalTasks > 0 ? ($tasksByStatus['todo'] / $totalTasks) * 100 : 0 }}%"></div>
                </div>
            </div>

             <div style="margin-top: 32px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 24px;">
                <h4 style="color: #fff; font-size: 16px; margin-bottom: 16px;">Priority Breakdown</h4>
                <div style="display: flex; gap: 4px; height: 24px; border-radius: 8px; overflow: hidden;">
                    <div class="fill-orange" style="width: {{ $totalTasks > 0 ? ($tasksByPriority['high'] / $totalTasks) * 100 : 0 }}%" title="High Priority"></div>
                    <div class="fill-blue" style="width: {{ $totalTasks > 0 ? ($tasksByPriority['medium'] / $totalTasks) * 100 : 0 }}%" title="Medium Priority"></div>
                    <div class="fill-purple" style="width: {{ $totalTasks > 0 ? ($tasksByPriority['low'] / $totalTasks) * 100 : 0 }}%" title="Low Priority"></div>
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 8px; font-size: 13px; color: #94a3b8;">
                    <span style="display: flex; align-items: center; gap: 6px;"><span style="width: 8px; height: 8px; border-radius: 50%; background: #fb923c;"></span>High ({{ $tasksByPriority['high'] }})</span>
                    <span style="display: flex; align-items: center; gap: 6px;"><span style="width: 8px; height: 8px; border-radius: 50%; background: #60a5fa;"></span>Medium ({{ $tasksByPriority['medium'] }})</span>
                    <span style="display: flex; align-items: center; gap: 6px;"><span style="width: 8px; height: 8px; border-radius: 50%; background: #a855f7;"></span>Low ({{ $tasksByPriority['low'] }})</span>
                </div>
            </div>
        </div>

        <!-- 3. Recent Activity -->
        <div class="chart-card">
             <div class="chart-header">
                <h3 class="chart-title">Recently Completed</h3>
                <p style="color: #64748b; font-size: 14px;">Last 5 finished tasks</p>
            </div>

            <div class="recent-list">
                @forelse($recentCompleted as $task)
                <div class="recent-item">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: rgba(34, 197, 94, 0.1); color: #4ade80; display: flex; align-items: center; justify-content: center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div style="flex: 1;">
                        <div style="color: #fff; font-weight: 500; font-size: 14px;">{{ Str::limit($task->title, 20) }}</div>
                        <div style="color: #64748b; font-size: 12px;">{{ $task->project->name ?? 'No Project' }}</div>
                    </div>
                     <div style="color: #64748b; font-size: 12px;">{{ $task->updated_at->format('M d') }}</div>
                </div>
                @empty
                <div style="text-align: center; color: #64748b; padding: 20px;">No completed tasks yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
