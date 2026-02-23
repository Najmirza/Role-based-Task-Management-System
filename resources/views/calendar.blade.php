<x-app-layout>
    <style>
        /* ============================
           CALENDAR — BASE STYLES
           ============================ */
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
            margin-bottom: 24px;
            gap: 12px;
            flex-wrap: wrap;
            z-index: 2;
        }

        .month-display {
            font-family: 'Outfit', sans-serif;
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .month-label {
            white-space: nowrap;
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
            flex-shrink: 0;
        }

        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .calendar-header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-shrink: 0;
        }

        /* Calendar grid */
        .calendar-scroll-wrapper {
            flex: 1;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 16px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            min-width: 420px; /* Prevent cells becoming unusably tiny */
            gap: 1px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
            width: 100%;
        }

        .weekday-header {
            padding: 14px 8px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            font-weight: 600;
            background: rgba(15, 23, 42, 0.6);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            letter-spacing: 0.02em;
        }

        /* Long day name (desktop) */
        .weekday-full { display: inline; }
        /* Short day name (mobile) */
        .weekday-short { display: none; }

        .calendar-day {
            background: rgba(15, 23, 42, 0.4);
            padding: 12px 10px;
            min-height: 90px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 5px;
            overflow: hidden;
        }

        .calendar-day:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .day-number {
            font-size: 14px;
            color: #94a3b8;
            font-weight: 500;
            width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
            flex-shrink: 0;
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
            padding: 3px 6px;
            border-radius: 5px;
            font-size: 10px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 3px;
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            transition: all 0.2s ease;
            line-height: 1.4;
        }

        .event-dot:hover {
            transform: scale(1.02);
            z-index: 2;
        }

        .event-dot span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            min-width: 0;
        }

        .event-purple { background: rgba(168, 85, 247, 0.2); border: 1px solid rgba(168, 85, 247, 0.4); color: #d8b4fe; }
        .event-blue   { background: rgba(59, 130, 246, 0.2);  border: 1px solid rgba(59, 130, 246, 0.4);  color: #93c5fd; }
        .event-green  { background: rgba(34, 197, 94, 0.2);   border: 1px solid rgba(34, 197, 94, 0.4);   color: #86efac; }
        .event-orange { background: rgba(249, 115, 22, 0.2);  border: 1px solid rgba(249, 115, 22, 0.4);  color: #fdba74; }

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

        .top-right  { top: -100px;    right: -100px; }
        .bottom-left { bottom: -100px; left: -100px; }

        /* ============================
           CALENDAR — MOBILE (≤768px)
           ============================ */
        @media (max-width: 768px) {
            .calendar-wrapper {
                padding: 16px 12px;
                border-radius: 18px;
                min-height: auto;
            }

            .calendar-header {
                margin-bottom: 14px;
                gap: 8px;
            }

            .month-display {
                font-size: 20px;
                gap: 8px;
            }

            .nav-btn {
                width: 34px;
                height: 34px;
                border-radius: 10px;
            }

            .calendar-header-actions {
                gap: 6px;
            }

            /* Switch to short day names on mobile */
            .weekday-full  { display: none; }
            .weekday-short { display: inline; }

            .weekday-header {
                padding: 10px 4px;
                font-size: 11px;
            }

            .calendar-day {
                padding: 6px 4px;
                min-height: 64px;
                gap: 3px;
            }

            .day-number {
                font-size: 12px;
                width: 22px;
                height: 22px;
            }

            .event-dot {
                font-size: 9px;
                padding: 2px 4px;
                gap: 2px;
            }

            /* "Today" and "Add Task" buttons shrink */
            .calendar-header-actions .nav-btn {
                font-size: 12px;
                padding: 0 10px;
                width: auto;
            }

            .calendar-header-actions .create-btn {
                height: 36px;
                padding: 0 12px;
                font-size: 13px;
            }
        }

        /* ============================
           CALENDAR — SMALL (≤480px)
           ============================ */
        @media (max-width: 480px) {
            .calendar-wrapper {
                padding: 12px 8px;
            }

            .month-display {
                font-size: 17px;
                gap: 6px;
            }

            .calendar-day {
                min-height: 52px;
                padding: 4px 3px;
            }

            .day-number {
                font-size: 11px;
                width: 20px;
                height: 20px;
            }

            /* Only show 1 event dot per cell on tiny screens */
            .event-dot:not(:first-of-type) {
                display: none;
            }
        }
    </style>

    <div class="calendar-wrapper">
        <div class="decoration-circle top-right"></div>
        <div class="decoration-circle bottom-left"></div>

        <div class="calendar-header">
            <div class="month-display">
                <a href="{{ $prevMonthUrl }}" class="nav-btn" aria-label="Previous month">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                </a>
                <span class="month-label">{{ $currentMonthName }} {{ $currentYear }}</span>
                <a href="{{ $nextMonthUrl }}" class="nav-btn" aria-label="Next month">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                </a>
            </div>

            <div class="calendar-header-actions">
                <a href="{{ route('calendar') }}" class="nav-btn" style="width: auto; padding: 0 14px; font-size: 13px; font-weight: 500;">
                    Today
                </a>
                <a href="{{ route('tasks.create') }}" class="create-btn" style="text-decoration: none;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    <span class="create-btn-label">Add Task</span>
                </a>
            </div>
        </div>

        <div class="calendar-scroll-wrapper">
            <div class="calendar-grid">
                <!-- Weekday Headers — full name on desktop, initial on mobile -->
                <div class="weekday-header"><span class="weekday-full">Sun</span><span class="weekday-short">S</span></div>
                <div class="weekday-header"><span class="weekday-full">Mon</span><span class="weekday-short">M</span></div>
                <div class="weekday-header"><span class="weekday-full">Tue</span><span class="weekday-short">T</span></div>
                <div class="weekday-header"><span class="weekday-full">Wed</span><span class="weekday-short">W</span></div>
                <div class="weekday-header"><span class="weekday-full">Thu</span><span class="weekday-short">T</span></div>
                <div class="weekday-header"><span class="weekday-full">Fri</span><span class="weekday-short">F</span></div>
                <div class="weekday-header"><span class="weekday-full">Sat</span><span class="weekday-short">S</span></div>

                <!-- Day cells -->
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
                                <span>● {{ Str::limit($task->title, 12) }}</span>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

