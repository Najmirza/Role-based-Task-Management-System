<x-app-layout>
    <div class="card card-dark" style="max-width: 600px; margin: 0 auto;">
        @if ($errors->any())
            <div style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('goals.update', $goal) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Goal Title</label>
                <input type="text" name="title" value="{{ old('title', $goal->title) }}" required
                       style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
            </div>
            
            <div style="margin-bottom: 20px;">
                 <label style="display: flex; align-items: center; gap: 10px; color: #fff; font-size: 14px; cursor: pointer;">
                    <input type="hidden" name="is_completed" value="0">
                    <input type="checkbox" name="is_completed" value="1" {{ $goal->is_completed ? 'checked' : '' }} style="width: 18px; height: 18px;">
                    Mark as Completed
                </label>
            </div>

            <div style="text-align: right;">
                <button type="submit" class="create-btn" style="display: inline-flex; border: none;">
                    Update Goal
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
