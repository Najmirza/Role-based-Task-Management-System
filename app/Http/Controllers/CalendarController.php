<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Task;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // 1. Determine current month/year
        $month = $request->input('month');
        $year = $request->input('year');

        if ($month && $year && is_numeric($month) && is_numeric($year)) {
            $date = Carbon::createFromDate((int)$year, (int)$month, 1);
        } else {
            $date = Carbon::now();
        }

        $currentMonth = $date->month;
        $currentYear = $date->year;
        $currentMonthName = $date->format('F');

        // 2. Navigation Links
        $prevDate = $date->copy()->subMonth();
        $nextDate = $date->copy()->addMonth();

        $prevMonthUrl = route('calendar', ['month' => $prevDate->month, 'year' => $prevDate->year]);
        $nextMonthUrl = route('calendar', ['month' => $nextDate->month, 'year' => $nextDate->year]);

        // 3. Generate Calendar Grid (6 weeks usually covers everything)
        // Start from the Sunday before the first day of the month
        $startOfGrid = $date->copy()->startOfMonth()->startOfWeek(Carbon::SUNDAY);
        $endOfGrid = $startOfGrid->copy()->addDays(41); // 42 days total (7 * 6)

        // 4. Fetch Tasks for this range
        $tasks = Task::where('created_by', auth()->id())
            ->whereBetween('due_date', [$startOfGrid->format('Y-m-d'), $endOfGrid->format('Y-m-d')])
            ->get()
            ->groupBy(function($task) {
                return Carbon::parse($task->due_date)->format('Y-m-d');
            });

        // 5. Build Grid Array
        $calendarGrid = [];
        $currentDay = $startOfGrid->copy();

        while ($currentDay <= $endOfGrid) {
            $dayString = $currentDay->format('Y-m-d');
            
            $calendarGrid[] = [
                'date' => $dayString,
                'day' => $currentDay->day,
                'isCurrentMonth' => $currentDay->month === $currentMonth,
                'isToday' => $currentDay->isToday(),
                'tasks' => $tasks->get($dayString, collect([]))
            ];

            $currentDay->addDay();
        }

        return view('calendar', compact(
            'currentMonthName', 
            'currentYear', 
            'calendarGrid', 
            'prevMonthUrl', 
            'nextMonthUrl'
        ));
    }
}
