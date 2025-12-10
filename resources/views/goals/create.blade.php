<x-app-layout>
    <div class="card card-dark" style="width: 100%; margin: 0 auto;">
        @if ($errors->any())
            <div style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('goals.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Goal Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g., Complete Project Alpha"
                       style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Month</label>
                    <select name="month" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }} style="background: #0f172a; color: #fff;">{{ date("F", mktime(0, 0, 0, $i, 10)) }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Year</label>
                    <input type="number" name="year" value="{{ date('Y') }}" min="2024"
                           style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
            </div>

            <div style="text-align: right; grid-column: 1 / -1;">
                <button type="submit" class="create-btn" style="display: inline-flex; border: none;">
                    Set Goal
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
