<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillUpx - Track Your Journey to Mastery</title>
      <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 0.9; }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-pulse-glow {
            animation: pulse-glow 4s ease-in-out infinite;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
<!-- Ocean Glow Background -->
<div class="min-h-screen w-full bg-black relative overflow-hidden">
    <!-- Deep Ocean Glow -->
    <div
        class="absolute inset-0 z-0"
        style="background: radial-gradient(70% 55% at 50% 50%, #2a5d77 0%, #184058 18%, #0f2a43 34%, #0a1b30 50%, #071226 66%, #040d1c 80%, #020814 92%, #01040d 97%, #000309 100%), radial-gradient(160% 130% at 10% 10%, rgba(0,0,0,0) 38%, #000309 76%, #000208 100%), radial-gradient(160% 130% at 90% 90%, rgba(0,0,0,0) 38%, #000309 76%, #000208 100%)"
    ></div>

    <!-- Floating Orbs -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-cyan-500/10 rounded-full blur-3xl animate-pulse-glow"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse-glow" style="animation-delay: 2s;"></div>

    <!-- Content Container -->
    <div class="relative z-10">
        <!-- Navigation -->
        <nav class="px-6 lg:px-12 py-6">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="text-2xl lg:text-3xl font-black tracking-tight">
                        <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                            SkillUpx
                        </span>
                </div>

                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-gray-300 hover:text-cyan-400 transition-colors text-sm font-medium">Features</a>
                    <a href="#how-it-works" class="text-gray-300 hover:text-cyan-400 transition-colors text-sm font-medium">How It Works</a>
                    <a href="{{ route('filament.admin.auth.login') }}"
                       class="px-6 py-2.5 bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 rounded-lg hover:bg-cyan-500/20 transition-all text-sm font-semibold">
                        Login
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="px-6 lg:px-12 py-12 lg:py-20">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <!-- Left Content -->
                    <div class="space-y-8">
                        <div class="space-y-6">
                            <h1 class="text-5xl lg:text-7xl font-black leading-tight tracking-tight">
                                <span class="text-white">Master Your</span>
                                <br>
                                <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                                        Tech Journey
                                    </span>
                            </h1>

                            <p class="text-lg lg:text-xl text-gray-400 leading-relaxed max-w-xl">
                                Track skills, log practice sessions, set milestones, and visualize your progress
                                from beginner to expert. Built for developers who take their growth seriously.
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('filament.admin.auth.login') }}"
                               class="px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg font-bold hover:shadow-lg hover:shadow-cyan-500/50 transition-all text-center">
                                Start Tracking Free
                            </a>
                            <a href="#features"
                               class="px-8 py-4 bg-white/5 border border-white/10 text-white rounded-lg font-bold hover:bg-white/10 transition-all text-center backdrop-blur-sm">
                                See Features
                            </a>
                        </div>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-2 gap-6 pt-8">
                            <div>
                                <div class="text-3xl font-black bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">
                                    500+
                                </div>
                                <div class="text-sm text-gray-500 font-medium">Active Developers</div>
                            </div>
                            <div>
                                <div class="text-3xl font-black bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                                    10K+
                                </div>
                                <div class="text-sm text-gray-500 font-medium">Skills Tracked</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Stats Card -->
                    <div class="relative">
                        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-2xl animate-float">
                            <div class="absolute -top-1 -left-1 -right-1 h-px bg-gradient-to-r from-transparent via-cyan-400 to-transparent"></div>

                            <div class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-400 text-sm font-medium">Your Progress Dashboard</span>
                                    <span class="px-3 py-1 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold rounded-full">
                                            LIVE
                                        </span>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-cyan-500/5 border border-cyan-500/20 rounded-xl p-4">
                                        <div class="text-3xl font-black text-cyan-400">18</div>
                                        <div class="text-xs text-gray-500 font-medium mt-1">Skills Tracked</div>
                                    </div>

                                    <div class="bg-blue-500/5 border border-blue-500/20 rounded-xl p-4">
                                        <div class="text-3xl font-black text-blue-400">250+</div>
                                        <div class="text-xs text-gray-500 font-medium mt-1">Practice Hours</div>
                                    </div>

                                    <div class="bg-purple-500/5 border border-purple-500/20 rounded-xl p-4">
                                        <div class="text-3xl font-black text-purple-400">5</div>
                                        <div class="text-xs text-gray-500 font-medium mt-1">Certifications</div>
                                    </div>

                                    <div class="bg-pink-500/5 border border-pink-500/20 rounded-xl p-4">
                                        <div class="text-3xl font-black text-pink-400">85%</div>
                                        <div class="text-xs text-gray-500 font-medium mt-1">Goal Progress</div>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-400 font-medium">Monthly Goal</span>
                                        <span class="text-cyan-400 font-bold">85%</span>
                                    </div>
                                    <div class="h-2 bg-white/5 rounded-full overflow-hidden">
                                        <div class="h-full w-[85%] bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="px-6 lg:px-12 py-20 lg:py-32">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-6xl font-black mb-4">
                        <span class="text-white">Everything You Need to </span>
                        <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                                Level Up
                            </span>
                    </h2>
                    <p class="text-gray-400 text-lg mt-4 max-w-2xl mx-auto">
                        Comprehensive tools designed to accelerate your development journey
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Feature Card 1 -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 hover:border-cyan-500/30 transition-all group">
                        <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Skill Progression</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Track your journey from beginner to expert across frontend, backend, databases, DevOps, and more with detailed analytics.
                        </p>
                    </div>

                    <!-- Feature Card 2 -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 hover:border-blue-500/30 transition-all group">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Practice Logging</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Record every coding session with duration, difficulty, and quality ratings. Link repositories and track patterns.
                        </p>
                    </div>

                    <!-- Feature Card 3 -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 hover:border-purple-500/30 transition-all group">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Goal Management</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Set daily, weekly, monthly, and career goals. Monitor deadlines, track progress, and stay accountable.
                        </p>
                    </div>

                    <!-- Feature Card 4 -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 hover:border-green-500/30 transition-all group">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Learning Resources</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Organize courses, books, tutorials, and documentation. Rate completed materials and build your knowledge base.
                        </p>
                    </div>

                    <!-- Feature Card 5 -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 hover:border-yellow-500/30 transition-all group">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Milestones</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Celebrate achievements with skill-specific milestones. Store proof of completion and track your wins.
                        </p>
                    </div>

                    <!-- Feature Card 6 -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 hover:border-pink-500/30 transition-all group">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-red-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Visual Analytics</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Beautiful charts and dashboards showing practice trends, skill distribution, and category-wise progress.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="px-6 lg:px-12 py-20">
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-r from-cyan-500/10 via-blue-500/10 to-purple-500/10 border border-white/10 rounded-3xl p-12 text-center backdrop-blur-sm">
                    <h2 class="text-3xl lg:text-5xl font-black mb-6">
                            <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                                Start Your Journey Today
                            </span>
                    </h2>
                    <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto">
                        Join hundreds of developers who are accelerating their growth with SkillUpx.
                        It's free to get started.
                    </p>
                    <a href="{{ route('filament.admin.auth.login') }}"
                       class="inline-block px-10 py-4 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg font-bold hover:shadow-lg hover:shadow-cyan-500/50 transition-all">
                        Create Free Account
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="px-6 lg:px-12 py-12 border-t border-white/10">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-2xl font-black">
                            <span class="bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">
                                SkillUpx
                            </span>
                    </div>
                    <p class="text-gray-500 text-sm">
                        © 2024 SkillUpx. Built for developers, by developers.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</div>

<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>
</body>
</html>
