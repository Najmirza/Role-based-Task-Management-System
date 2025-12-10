<x-app-layout>
    <style>
        .calendar-wrapper {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 32px;
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            min-height: calc(100vh - 140px);
            display: flex;
            flex-direction: column;
            width: 100%;
    box-sizing: border-box;

    overflow-x: hidden;
    overflow-y: auto;
            position: relative;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            z-index: 2;
        }

        .month-display {
            font-family: 'Outfit', sans-serif;
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            flex: 1;
            gap: 1px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .weekday-header {
            padding: 20px;
            text-align: center;
            color: #94a3b8;
            font-size: 14px;
            font-weight: 600;
            background: rgba(15, 23, 42, 0.6);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .calendar-day {
            background: rgba(15, 23, 42, 0.4);
            padding: 16px;
            min-height: 100px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .calendar-day:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .day-number {
            font-size: 16px;
            color: #94a3b8;
            font-weight: 500;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .calendar-day.today .day-number {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            color: #fff;
            box-shadow: 0 2px 10px rgba(124, 58, 237, 0.4);
        }

        .calendar-day.inactive {
            opacity: 0.3;
        }

        .event-dot {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 4px;
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            transition: all 0.2s ease;
        }

        .event-dot:hover {
            transform: scale(1.02);
            z-index: 2;
        }

        .event-purple { background: rgba(168, 85, 247, 0.2); border: 1px solid rgba(168, 85, 247, 0.4); color: #d8b4fe; }
        .event-blue { background: rgba(59, 130, 246, 0.2); border: 1px solid rgba(59, 130, 246, 0.4); color: #93c5fd; }
        .event-green { background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.4); color: #86efac; }
        .event-orange { background: rgba(249, 115, 22, 0.2); border: 1px solid rgba(249, 115, 22, 0.4); color: #fdba74; }

        /* Floating decoration */
        .decoration-circle {
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99,102,241,0.1) 0%, rgba(0,0,0,0) 70%);
            pointer-events: none;
            z-index: 0;
            filter: blur(40px);
        }

        .top-right { top: -100px; right: -100px; }
        .bottom-left { bottom: -100px; left: -100px; }

    </style>

    <div class="calendar-wrapper">
        <div class="decoration-circle top-right"></div>
        <div class="decoration-circle bottom-left"></div>

        <div class="calendar-header">
            <div class="month-display">
                <a href="{{ $prevMonthUrl }}" class="nav-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                </a>
                <span>{{ $currentMonthName }} {{ $currentYear }}</span>
                <a href="{{ $nextMonthUrl }}" class="nav-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                </a>
            </div>

            <div style="display: flex; gap: 12px;">
                <a href="{{ route('calendar') }}" class="nav-btn" style="width: auto; padding: 0 16px; font-size: 14px; font-weight: 500;">
                    Today
                </a>
                <a href="{{ route('tasks.create') }}" class="create-btn" style="text-decoration: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add Task
                </a>
            </div>
        </div>

        <div class="calendar-grid">
            <!-- Headers -->
            <div class="weekday-header">Sun</div>
            <div class="weekday-header">Mon</div>
            <div class="weekday-header">Tue</div>
            <div class="weekday-header">Wed</div>
            <div class="weekday-header">Thu</div>
            <div class="weekday-header">Fri</div>
            <div class="weekday-header">Sat</div>

            <!-- Loop -->
            @foreach($calendarGrid as $day)
                <div class="calendar-day {{ $day['isCurrentMonth'] ? '' : 'inactive' }} {{ $day['isToday'] ? 'today' : '' }}"
                     onclick="window.location.href='{{ route('tasks.create', ['due_date' => $day['date']]) }}'">
                    
                    <div class="day-number">{{ $day['day'] }}</div>
                    
                    @foreach($day['tasks'] as $task)
                        <div class="event-dot 
                             {{ $task->status == 'completed' ? 'event-green' : 
                                ($task->priority == 'high' ? 'event-orange' : 
                                ($task->status == 'to_do' ? 'event-blue' : 'event-purple')) }}"
                             onclick="event.stopPropagation(); window.location.href='{{ route('tasks.edit', $task->id) }}'">
                            <span>● {{ Str::limit($task->title, 15) }}</span>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
