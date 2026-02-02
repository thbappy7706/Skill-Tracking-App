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

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                    <!-- Stat Card 1 -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 hover:bg-white/10 hover:border-cyan-500/30 transition-all opacity-0 animate-slide-up" style="animation-delay: 0.1s;">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center text-2xl">
                                📚
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-3xl font-black text-cyan-400">{{ $stats['total_skills'] }}</div>
                            <div class="text-sm font-medium text-gray-400 uppercase tracking-wide">Total Skills</div>
                            <div class="text-xs text-gray-500 mt-2">{{ $stats['proficient_skills'] }} proficient</div>
                        </div>
                    </div>

                    <!-- Stat Card 2 -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 hover:bg-white/10 hover:border-blue-500/30 transition-all opacity-0 animate-slide-up" style="animation-delay: 0.2s;">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center text-2xl">
                                ⏱️
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-3xl font-black text-blue-400">{{ $stats['total_practice_hours'] }}h</div>
                            <div class="text-sm font-medium text-gray-400 uppercase tracking-wide">Practice Hours</div>
                            <div class="text-xs text-gray-500 mt-2">{{ $stats['this_week_hours'] }}h this week</div>
                        </div>
                    </div>

                    <!-- Stat Card 3 -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 hover:bg-white/10 hover:border-orange-500/30 transition-all opacity-0 animate-slide-up" style="animation-delay: 0.3s;">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center text-2xl">
                                🔥
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-3xl font-black text-orange-400">{{ $stats['current_streak'] }}</div>
                            <div class="text-sm font-medium text-gray-400 uppercase tracking-wide">Day Streak</div>
                            <div class="text-xs text-gray-500 mt-2">Keep it going!</div>
                        </div>
                    </div>

                    <!-- Stat Card 4 -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 hover:bg-white/10 hover:border-purple-500/30 transition-all opacity-0 animate-slide-up" style="animation-delay: 0.4s;">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center text-2xl">
                                🎯
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-3xl font-black text-purple-400">{{ $stats['active_goals'] }}</div>
                            <div class="text-sm font-medium text-gray-400 uppercase tracking-wide">Active Goals</div>
                            <div class="text-xs text-gray-500 mt-2">{{ $stats['avg_practice_quality'] }}/5 avg quality</div>
                        </div>
                    </div>
                </div>

                <!-- Main Dashboard Grid -->
                <div class="grid lg:grid-cols-3 gap-6">
                    <!-- Recent Practices - Takes 2 columns -->
                    <div class="lg:col-span-2 bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 lg:p-8 opacity-0 animate-slide-up" style="animation-delay: 0.5s;">
                        <h2 class="text-2xl font-bold text-white mb-6">Recent Practice Sessions</h2>
                        <div class="space-y-3">
                            @forelse($recentPractices as $practice)
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
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Upcoming Goals -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 lg:p-8 opacity-0 animate-slide-up" style="animation-delay: 0.6s;">
                        <h2 class="text-2xl font-bold text-white mb-6">Upcoming Goals</h2>
                        <div class="space-y-3">
                            @forelse($upcomingGoals as $goal)
                                <div class="bg-purple-500/5 border-l-4 border-purple-500 p-4 rounded-r-lg">
                                    <div class="font-semibold text-white mb-2">{{ $goal->title }}</div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm text-gray-400">{{ $goal->progress_percentage }}% complete</span>
                                        <span class="px-2 py-1 bg-purple-500/20 border border-purple-500/30 text-purple-400 text-xs font-bold rounded uppercase">
                                                {{ $goal->type }}
                                            </span>
                                    </div>
                                    @if($goal->target_date)
                                        <div class="text-xs text-gray-500 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Due: {{ $goal->target_date->format('M d, Y') }}
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-12 text-gray-500">
                                    <div class="text-5xl mb-4">🎯</div>
                                    <p>Set your first goal!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Category Progress -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 lg:p-8 opacity-0 animate-slide-up" style="animation-delay: 0.7s;">
                    <h2 class="text-2xl font-bold text-white mb-6">Category Progress</h2>
                    <div class="space-y-6">
                        @forelse($categories as $category)
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-semibold text-white">{{ $category->name }}</span>
                                    <span class="text-cyan-400 font-bold">{{ round($category->progress) }}%</span>
                                </div>
                                <div class="h-3 bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full progress-bar-animate"
                                         style="width: {{ $category->progress }}%"></div>
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

                <!-- Skills Distribution Chart -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 lg:p-8 opacity-0 animate-slide-up" style="animation-delay: 0.8s;">
                    <h2 class="text-2xl font-bold text-white mb-8">Skills by Proficiency Level</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                        @foreach(['Not Started', 'Beginner', 'Elementary', 'Intermediate', 'Advanced', 'Expert'] as $index => $label)
                            @php
                                $count = $skillsByLevel[$index] ?? 0;
                                $maxCount = $skillsByLevel->max() ?: 1;
                                $percentage = ($count / $maxCount) * 100;
                            @endphp
                            <div class="text-center">
                                <div class="h-32 bg-white/5 rounded-lg mb-2 flex items-end justify-center p-2 overflow-hidden">
                                    <div class="w-full bg-gradient-to-t from-cyan-500 to-blue-500 rounded flex items-center justify-center text-white font-bold bar-fill-animate"
                                         style="height: {{ $percentage }}%">
                                        {{ $count }}
                                    </div>
                                </div>
                                <div class="text-xs text-gray-400 font-medium">{{ $label }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
