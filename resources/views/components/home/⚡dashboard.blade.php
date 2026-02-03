<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Goal;
use App\Models\Practice;
use App\Models\Skill;
use App\Models\SkillCategory;

new #[Layout('layouts::app'), Title('My Skill Dashboard - SkillUpx')] class extends Component {
    public int $refreshCount = 0;

    /**
     * Get user statistics
     * Cached and only recalculates when needed
     */
    #[Computed]
    public function stats()
    {
        return [
            'total_skills' => Skill::count(),
            'proficient_skills' => Skill::whereIn('status', ['proficient', 'expert'])->count(),
            'learning_skills' => Skill::whereIn('status', ['learning', 'practicing'])->count(),
            'total_practice_hours' => round(Practice::sum('duration_minutes') / 60, 1),
            'this_week_hours' => round(
                Practice::where('practiced_at', '>=', now()->startOfWeek())
                    ->sum('duration_minutes') / 60,
                1
            ),
            'active_goals' => Goal::where('status', 'in_progress')->count(),
            'avg_practice_quality' => round(Practice::avg('quality_rating'), 1),
            'current_streak' => $this->calculateStreak(),
        ];
    }

    /**
     * Get recent practice sessions
     * Updates independently via island
     */
    #[Computed]
    public function recentPractices()
    {
        return Practice::with('skill')
            ->latest('practiced_at')
            ->limit(5)
            ->get();
    }

    /**
     * Get upcoming goals
     */
    #[Computed]
    public function upcomingGoals()
    {
        return Goal::whereIn('status', ['planned', 'in_progress'])
            ->whereNotNull('target_date')
            ->orderBy('target_date')
            ->limit(3)
            ->get();
    }

    /**
     * Get categories with progress calculation
     * This is expensive, so it's isolated in an island
     */
    #[Computed]
    public function categories()
    {
        return SkillCategory::withCount('skills')
            ->orderBy('order')
            ->get()
            ->map(function ($category) {
                $category->progress = $this->calculateCategoryProgress($category);
                return $category;
            });
    }

    /**
     * Get skills by proficiency level for chart
     */
    #[Computed]
    public function skillsByLevel()
    {
        $levels = Skill::selectRaw('current_level, COUNT(*) as count')
            ->groupBy('current_level')
            ->get()
            ->pluck('count', 'current_level');

        // Ensure all levels 0-5 exist
        $result = collect([]);
        for ($i = 0; $i <= 5; $i++) {
            $result[$i] = $levels->get($i, 0);
        }

        return $result;
    }

    /**
     * Calculate user's practice streak
     */
    private function calculateStreak(): int
    {
        $practices = Practice::orderBy('practiced_at', 'desc')->get();

        if ($practices->isEmpty()) {
            return 0;
        }

        $streak = 0;
        $currentDate = now()->startOfDay();

        foreach ($practices as $practice) {
            $practiceDate = $practice->practiced_at->startOfDay();

            if ($practiceDate->equalTo($currentDate) ||
                $practiceDate->equalTo($currentDate->copy()->subDay())) {
                $streak++;
                $currentDate = $practiceDate;
            } else {
                break;
            }
        }

        return $streak;
    }

    /**
     * Calculate category progress percentage
     */
    private function calculateCategoryProgress(?SkillCategory $category = null): float
    {
        if (!$category) return 0;

        $skills = $category->skills;

        if ($skills->isEmpty()) {
            return 0;
        }

        $totalProgress = $skills->sum('current_level');
        $maxProgress = $skills->count() * 5; // Assuming max level is 5

        return round(($totalProgress / $maxProgress) * 100, 2);
    }

    /**
     * Refresh all dashboard data
     */
    public function refreshDashboard()
    {
        $this->refreshCount++;

        // Clear computed properties cache
        unset($this->stats);
        unset($this->recentPractices);
        unset($this->upcomingGoals);
        unset($this->categories);
        unset($this->skillsByLevel);
    }

    /**
     * Quick action to mark a goal as completed
     */
    public function completeGoal($goalId)
    {
        $goal = Goal::find($goalId);

        if ($goal) {
            $goal->update([
                'status' => 'completed',
                'completed_at' => now(),
                'progress_percentage' => 100,
            ]);

            $this->dispatch('goal-completed', goalId: $goalId);
        }
    }
};
?>

    <!-- Ocean Glow Background -->
<div class="min-h-screen w-full bg-black relative overflow-x-hidden">
    <!-- Deep Ocean Glow -->
    <div
        class="fixed inset-0 z-0"
        style="background: radial-gradient(70% 55% at 50% 50%, #2a5d77 0%, #184058 18%, #0f2a43 34%, #0a1b30 50%, #071226 66%, #040d1c 80%, #020814 92%, #01040d 97%, #000309 100%), radial-gradient(160% 130% at 10% 10%, rgba(0,0,0,0) 38%, #000309 76%, #000208 100%), radial-gradient(160% 130% at 90% 90%, rgba(0,0,0,0) 38%, #000309 76%, #000208 100%)"
    ></div>

    <!-- Ambient Orbs -->
    <div class="fixed top-20 left-10 w-96 h-96 bg-cyan-500/5 rounded-full blur-3xl"></div>
    <div class="fixed bottom-20 right-10 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl"></div>

    <!-- Content Container -->
    <div class="relative z-10">
        <!-- Navigation -->
        <nav class="sticky top-0 z-50 bg-black/40 backdrop-blur-xl border-b border-white/10">
            <div class="px-6 lg:px-12 py-4">
                <div class="flex items-center justify-between">
                    <div class="text-2xl font-black tracking-tight">
                        <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                            SkillUpx
                        </span>
                    </div>

                    <div class="flex items-center gap-4">
                        <button
                            wire:click="refreshDashboard"
                            class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 text-gray-300 rounded-lg hover:bg-white/10 hover:text-white transition-all text-sm font-medium">
                            <svg wire:loading.remove wire:target="refreshDashboard" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <svg wire:loading wire:target="refreshDashboard" class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span wire:loading.remove wire:target="refreshDashboard">Refresh</span>
                            <span wire:loading wire:target="refreshDashboard">Refreshing...</span>
                        </button>

                        <a href="{{ route('filament.admin.pages.dashboard') }}"
                           class="hidden sm:inline-block px-5 py-2 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg font-semibold hover:shadow-lg hover:shadow-cyan-500/30 transition-all text-sm">
                            Full Dashboard
                        </a>

                        <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="px-5 py-2 bg-white/5 border border-white/10 text-gray-300 rounded-lg hover:bg-white/10 hover:text-white transition-all text-sm font-medium">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="px-6 lg:px-12 py-8 lg:py-12">
            <div class="max-w-7xl mx-auto space-y-8">

                <!-- Welcome Section -->
                <div class="space-y-2 opacity-0 animate-fade-in">
                    <h1 class="text-4xl lg:text-5xl font-black">
                        <span class="text-white">Welcome back, </span>
                        <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                            {{ auth()->user()->name }}
                        </span>
                        <span class="text-4xl">👋</span>
                    </h1>
                    <p class="text-gray-400 text-lg">Here's your skill development overview</p>
                </div>

                <!-- Stats Grid - Island with auto-refresh every 30 seconds -->
                @island
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                    <!-- Stat Card 1 - Total Skills -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 hover:bg-white/10 hover:border-cyan-500/30 transition-all opacity-0 animate-slide-up"
                         style="animation-delay: 0.1s;"
                         x-data="{ count: 0 }"
                         x-init="setTimeout(() => {
                                 let end = {{ $this->stats['total_skills'] }};
                                 let duration = 1500;
                                 let start = 0;
                                 let increment = end / (duration / 16);
                                 let timer = setInterval(() => {
                                     start += increment;
                                     count = Math.floor(start);
                                     if(start >= end) {
                                         count = end;
                                         clearInterval(timer);
                                     }
                                 }, 16);
                             }, 100)">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center text-2xl">
                                📚
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-3xl font-black text-cyan-400" x-text="count"></div>
                            <div class="text-sm font-medium text-gray-400 uppercase tracking-wide">Total Skills</div>
                            <div class="text-xs text-gray-500 mt-2">{{ $this->stats['proficient_skills'] }} proficient</div>
                        </div>
                    </div>

                    <!-- Stat Card 2 - Practice Hours -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 hover:bg-white/10 hover:border-blue-500/30 transition-all opacity-0 animate-slide-up"
                         style="animation-delay: 0.2s;"
                         x-data="{ count: 0 }"
                         x-init="setTimeout(() => {
                                 let end = {{ $this->stats['total_practice_hours'] }};
                                 let duration = 1500;
                                 let start = 0;
                                 let increment = end / (duration / 16);
                                 let timer = setInterval(() => {
                                     start += increment;
                                     count = start.toFixed(1);
                                     if(start >= end) {
                                         count = end.toFixed(1);
                                         clearInterval(timer);
                                     }
                                 }, 16);
                             }, 200)">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center text-2xl">
                                ⏱️
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-3xl font-black text-blue-400"><span x-text="count"></span>h</div>
                            <div class="text-sm font-medium text-gray-400 uppercase tracking-wide">Practice Hours</div>
                            <div class="text-xs text-gray-500 mt-2">{{ $this->stats['this_week_hours'] }}h this week</div>
                        </div>
                    </div>

                    <!-- Stat Card 3 - Streak -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 hover:bg-white/10 hover:border-orange-500/30 transition-all opacity-0 animate-slide-up"
                         style="animation-delay: 0.3s;"
                         x-data="{ count: 0 }"
                         x-init="setTimeout(() => {
                                 let end = {{ $this->stats['current_streak'] }};
                                 let duration = 1500;
                                 let start = 0;
                                 let increment = end / (duration / 16);
                                 let timer = setInterval(() => {
                                     start += increment;
                                     count = Math.floor(start);
                                     if(start >= end) {
                                         count = end;
                                         clearInterval(timer);
                                     }
                                 }, 16);
                             }, 300)">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center text-2xl">
                                🔥
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-3xl font-black text-orange-400" x-text="count"></div>
                            <div class="text-sm font-medium text-gray-400 uppercase tracking-wide">Day Streak</div>
                            <div class="text-xs text-gray-500 mt-2">Keep it going!</div>
                        </div>
                    </div>

                    <!-- Stat Card 4 - Active Goals -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 hover:bg-white/10 hover:border-purple-500/30 transition-all opacity-0 animate-slide-up"
                         style="animation-delay: 0.4s;"
                         x-data="{ count: 0 }"
                         x-init="setTimeout(() => {
                                 let end = {{ $this->stats['active_goals'] }};
                                 let duration = 1500;
                                 let start = 0;
                                 let increment = end / (duration / 16);
                                 let timer = setInterval(() => {
                                     start += increment;
                                     count = Math.floor(start);
                                     if(start >= end) {
                                         count = end;
                                         clearInterval(timer);
                                     }
                                 }, 16);
                             }, 400)">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center text-2xl">
                                🎯
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-3xl font-black text-purple-400" x-text="count"></div>
                            <div class="text-sm font-medium text-gray-400 uppercase tracking-wide">Active Goals</div>
                            <div class="text-xs text-gray-500 mt-2">{{ $this->stats['avg_practice_quality'] }}/5 avg quality</div>
                        </div>
                    </div>
                </div>
                @endisland

                <!-- Main Dashboard Grid -->
                <div class="grid lg:grid-cols-3 gap-6">
                    <!-- Recent Practices - Island with polling every 60s -->
                    @island
                    <div class="lg:col-span-2 bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 lg:p-8 opacity-0 animate-slide-up" style="animation-delay: 0.5s;">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-white">Recent Practice Sessions</h2>
                            <span class="px-2 py-1 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold rounded-full">
                                    LIVE
                                </span>
                        </div>

                        <div class="space-y-3">
                            @forelse($this->recentPractices as $practice)
                                <div class="bg-cyan-500/5 border-l-4 border-cyan-500 p-4 rounded-r-lg hover:bg-cyan-500/10 transition-all">
                                    <div class="font-semibold text-white mb-1">{{ $practice->title }}</div>
                                    <div class="text-sm text-cyan-400 font-medium mb-2">{{ $practice->skill->name }}</div>
                                    <div class="flex flex-wrap gap-4 text-xs text-gray-400">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ floor($practice->duration_minutes / 60) }}h {{ $practice->duration_minutes % 60 }}m
                                            </span>
                                        <span class="flex items-center gap-1">
                                                <span class="text-yellow-400">{{ str_repeat('★', $practice->quality_rating) }}</span>
                                            </span>
                                        <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $practice->practiced_at->diffForHumans() }}
                                            </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 text-gray-500">
                                    <div class="text-5xl mb-4">💻</div>
                                    <p>No practice sessions yet. Start coding!</p>
                                    <a href="{{ route('filament.admin.pages.dashboard') }}"
                                       class="inline-block mt-4 px-6 py-2 bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 rounded-lg hover:bg-cyan-500/20 transition-all text-sm font-semibold">
                                        Log Your First Session
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @endisland

                    <!-- Upcoming Goals - Island with interactive actions -->
                    @island
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 lg:p-8 opacity-0 animate-slide-up" style="animation-delay: 0.6s;">
                        <h2 class="text-2xl font-bold text-white mb-6">Upcoming Goals</h2>
                        <div class="space-y-3">
                            @forelse($this->upcomingGoals as $goal)
                                <div class="bg-purple-500/5 border-l-4 border-purple-500 p-4 rounded-r-lg group hover:bg-purple-500/10 transition-all"
                                     x-data="{ showActions: false }">
                                    <div class="font-semibold text-white mb-2">{{ $goal->title }}</div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm text-gray-400">{{ $goal->progress_percentage }}% complete</span>
                                        <span class="px-2 py-1 bg-purple-500/20 border border-purple-500/30 text-purple-400 text-xs font-bold rounded uppercase">
                                                {{ $goal->type }}
                                            </span>
                                    </div>

                                    <!-- Animated Progress Bar -->
                                    <div class="mb-2" x-data="{ width: 0 }" x-init="setTimeout(() => width = {{ $goal->progress_percentage }}, 200)">
                                        <div class="h-1.5 bg-white/5 rounded-full overflow-hidden">
                                            <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full transition-all duration-1000 ease-out"
                                                 :style="`width: ${width}%`"></div>
                                        </div>
                                    </div>

                                    @if($goal->target_date)
                                        <div class="flex items-center justify-between">
                                            <div class="text-xs text-gray-500 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                Due: {{ $goal->target_date->format('M d, Y') }}
                                            </div>

                                            @if($goal->progress_percentage >= 80)
                                                <button
                                                    wire:click="completeGoal({{ $goal->id }})"
                                                    wire:island="upcoming-goals"
                                                    class="text-xs text-green-400 hover:text-green-300 font-medium transition-colors">
                                                    Mark Complete ✓
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-12 text-gray-500">
                                    <div class="text-5xl mb-4">🎯</div>
                                    <p>Set your first goal!</p>
                                    <a href="{{ route('filament.admin.pages.dashboard') }}"
                                       class="inline-block mt-4 px-6 py-2 bg-purple-500/10 border border-purple-500/30 text-purple-400 rounded-lg hover:bg-purple-500/20 transition-all text-sm font-semibold">
                                        Create Goal
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @endisland
                </div>

                <!-- Category Progress - Lazy loaded island -->
                @island
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 lg:p-8 opacity-0 animate-slide-up" style="animation-delay: 0.7s;">
                    <h2 class="text-2xl font-bold text-white mb-6">Category Progress</h2>
                    <div class="space-y-6">
                        @forelse($this->categories as $category)
                            <div x-data="{ width: 0 }" x-init="setTimeout(() => width = {{ $category->progress }}, 300)">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-semibold text-white">{{ $category->name }}</span>
                                    <span class="text-cyan-400 font-bold" x-text="Math.round(width) + '%'"></span>
                                </div>
                                <div class="h-3 bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full transition-all duration-1000 ease-out"
                                         :style="`width: ${width}%`"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500">
                                <div class="text-5xl mb-4">📂</div>
                                <p>Create your first skill category!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                @placeholder
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 lg:p-8">
                    <div class="animate-pulse space-y-6">
                        <div class="h-6 bg-gray-700 rounded w-1/3 mb-6"></div>
                        @for($i = 0; $i < 4; $i++)
                            <div class="space-y-2">
                                <div class="h-4 bg-gray-700 rounded w-1/4"></div>
                                <div class="h-3 bg-gray-700 rounded-full"></div>
                            </div>
                        @endfor
                    </div>
                </div>
                @endplaceholder
                @endisland

                <!-- Skills Distribution Chart - Lazy loaded island -->
                @island
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 lg:p-8 opacity-0 animate-slide-up" style="animation-delay: 0.8s;">
                    <h2 class="text-2xl font-bold text-white mb-8">Skills by Proficiency Level</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                        @php
                            $labels = ['Not Started', 'Beginner', 'Elementary', 'Intermediate', 'Advanced', 'Expert'];
                            $maxCount = $this->skillsByLevel->max() ?: 1;
                        @endphp

                        @foreach($labels as $index => $label)
                            @php
                                $count = $this->skillsByLevel[$index] ?? 0;
                                $percentage = ($count / $maxCount) * 100;
                            @endphp
                            <div class="text-center" x-data="{ height: 0 }" x-init="setTimeout(() => height = {{ $percentage }}, {{ 200 + ($index * 100) }})">
                                <div class="h-32 bg-white/5 rounded-lg mb-2 flex items-end justify-center p-2 overflow-hidden">
                                    <div class="w-full bg-gradient-to-t from-cyan-500 to-blue-500 rounded flex items-center justify-center text-white font-bold transition-all duration-1000 ease-out"
                                         :style="`height: ${height}%`">
                                        <span x-show="height > 20">{{ $count }}</span>
                                    </div>
                                </div>
                                <div class="text-xs text-gray-400 font-medium">{{ $label }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @placeholder
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 lg:p-8">
                    <div class="animate-pulse">
                        <div class="h-6 bg-gray-700 rounded w-1/3 mb-8"></div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                            @for($i = 0; $i < 6; $i++)
                                <div>
                                    <div class="h-32 bg-gray-700 rounded-lg mb-2"></div>
                                    <div class="h-3 bg-gray-700 rounded w-full"></div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                @endplaceholder
                @endisland

            </div>
        </div>
    </div>
</div>

<script>
    // Listen for goal completion events
    this.$wire.on('goal-completed', (event) => {
        // Show success notification
        console.log('Goal completed:', event.goalId);

        // You could trigger a confetti animation or notification here
        // Example: showConfetti();
    });

    // Track time spent on dashboard
    let dashboardStartTime = Date.now();

    window.addEventListener('beforeunload', () => {
        let timeSpent = Math.round((Date.now() - dashboardStartTime) / 1000);
        console.log('Time spent on dashboard:', timeSpent, 'seconds');
    });

    // Console branding
    console.log('%cSkillUpx Dashboard', 'color: #22d3ee; font-size: 20px; font-weight: bold;');
    console.log('%cPowered by Livewire v4 Islands 🏝️', 'color: #60a5fa; font-size: 12px;');
</script>


