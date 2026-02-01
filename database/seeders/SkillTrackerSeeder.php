<?php

namespace Database\Seeders;

use App\Models\Goal;
use App\Models\LearningResource;
use App\Models\Milestone;
use App\Models\Practice;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class SkillTrackerSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories for Full-Stack Development
        $frontend = SkillCategory::create([
            'name' => 'Frontend Development',
            'description' => 'Client-side web development technologies and frameworks',
            'icon' => 'code-bracket',
            'color' => '#3B82F6',
            'order' => 1,
        ]);

        $backend = SkillCategory::create([
            'name' => 'Backend Development',
            'description' => 'Server-side development and APIs',
            'icon' => 'server',
            'color' => '#10B981',
            'order' => 2,
        ]);

        $database = SkillCategory::create([
            'name' => 'Databases',
            'description' => 'Database design and management',
            'icon' => 'circle-stack',
            'color' => '#F59E0B',
            'order' => 3,
        ]);

        $devops = SkillCategory::create([
            'name' => 'DevOps & Cloud',
            'description' => 'Deployment, CI/CD, and cloud infrastructure',
            'icon' => 'cloud',
            'color' => '#8B5CF6',
            'order' => 4,
        ]);

        $mobile = SkillCategory::create([
            'name' => 'Mobile Development',
            'description' => 'Native and cross-platform mobile apps',
            'icon' => 'device-phone-mobile',
            'color' => '#EC4899',
            'order' => 5,
        ]);

        $tools = SkillCategory::create([
            'name' => 'Tools & Practices',
            'description' => 'Development tools, version control, and best practices',
            'icon' => 'wrench-screwdriver',
            'color' => '#6366F1',
            'order' => 6,
        ]);

        // Frontend Skills
        $html = Skill::create([
            'category_id' => $frontend->id,
            'name' => 'HTML5',
            'description' => 'Semantic HTML, accessibility, and modern HTML features',
            'current_level' => 4,
            'target_level' => 5,
            'importance' => 5,
            'status' => 'proficient',
            'started_at' => now()->subMonths(24),
        ]);

        $css = Skill::create([
            'category_id' => $frontend->id,
            'name' => 'CSS3 & Tailwind',
            'description' => 'Modern CSS, Flexbox, Grid, animations, and Tailwind CSS',
            'current_level' => 4,
            'target_level' => 5,
            'importance' => 5,
            'status' => 'proficient',
            'started_at' => now()->subMonths(24),
        ]);

        $javascript = Skill::create([
            'category_id' => $frontend->id,
            'name' => 'JavaScript (ES6+)',
            'description' => 'Modern JavaScript, async/await, modules, and DOM manipulation',
            'current_level' => 4,
            'target_level' => 5,
            'importance' => 5,
            'status' => 'proficient',
            'started_at' => now()->subMonths(20),
        ]);

        $react = Skill::create([
            'category_id' => $frontend->id,
            'name' => 'React',
            'description' => 'React hooks, context, performance optimization',
            'current_level' => 3,
            'target_level' => 5,
            'importance' => 5,
            'status' => 'practicing',
            'started_at' => now()->subMonths(12),
        ]);

        $vue = Skill::create([
            'category_id' => $frontend->id,
            'name' => 'Vue.js',
            'description' => 'Vue 3, Composition API, Pinia',
            'current_level' => 2,
            'target_level' => 4,
            'importance' => 4,
            'status' => 'learning',
            'started_at' => now()->subMonths(3),
        ]);

        // Backend Skills
        $php = Skill::create([
            'category_id' => $backend->id,
            'name' => 'PHP',
            'description' => 'Modern PHP 8.x features, OOP, namespaces',
            'current_level' => 4,
            'target_level' => 5,
            'importance' => 5,
            'status' => 'proficient',
            'started_at' => now()->subMonths(18),
        ]);

        $laravel = Skill::create([
            'category_id' => $backend->id,
            'name' => 'Laravel',
            'description' => 'Laravel framework, Eloquent, queues, events',
            'current_level' => 4,
            'target_level' => 5,
            'importance' => 5,
            'status' => 'proficient',
            'started_at' => now()->subMonths(15),
        ]);

        $nodejs = Skill::create([
            'category_id' => $backend->id,
            'name' => 'Node.js & Express',
            'description' => 'Backend JavaScript with Node and Express',
            'current_level' => 3,
            'target_level' => 4,
            'importance' => 4,
            'status' => 'practicing',
            'started_at' => now()->subMonths(8),
        ]);

        $python = Skill::create([
            'category_id' => $backend->id,
            'name' => 'Python',
            'description' => 'Python programming and scripting',
            'current_level' => 2,
            'target_level' => 4,
            'importance' => 4,
            'status' => 'learning',
            'started_at' => now()->subMonths(4),
        ]);

        // Database Skills
        $mysql = Skill::create([
            'category_id' => $database->id,
            'name' => 'MySQL',
            'description' => 'Relational database design, queries, optimization',
            'current_level' => 4,
            'target_level' => 5,
            'importance' => 5,
            'status' => 'proficient',
            'started_at' => now()->subMonths(18),
        ]);

        $postgresql = Skill::create([
            'category_id' => $database->id,
            'name' => 'PostgreSQL',
            'description' => 'Advanced PostgreSQL features',
            'current_level' => 2,
            'target_level' => 4,
            'importance' => 4,
            'status' => 'learning',
            'started_at' => now()->subMonths(2),
        ]);

        $mongodb = Skill::create([
            'category_id' => $database->id,
            'name' => 'MongoDB',
            'description' => 'NoSQL database for flexible data storage',
            'current_level' => 2,
            'target_level' => 3,
            'importance' => 3,
            'status' => 'learning',
            'started_at' => now()->subMonth(),
        ]);

        // DevOps Skills
        $git = Skill::create([
            'category_id' => $devops->id,
            'name' => 'Git & GitHub',
            'description' => 'Version control, branching, collaboration',
            'current_level' => 4,
            'target_level' => 5,
            'importance' => 5,
            'status' => 'proficient',
            'started_at' => now()->subMonths(24),
        ]);

        $docker = Skill::create([
            'category_id' => $devops->id,
            'name' => 'Docker',
            'description' => 'Containerization and Docker Compose',
            'current_level' => 3,
            'target_level' => 4,
            'importance' => 5,
            'status' => 'practicing',
            'started_at' => now()->subMonths(6),
        ]);

        $aws = Skill::create([
            'category_id' => $devops->id,
            'name' => 'AWS',
            'description' => 'EC2, S3, RDS, Lambda basics',
            'current_level' => 1,
            'target_level' => 4,
            'importance' => 5,
            'status' => 'learning',
            'started_at' => now()->subMonths(2),
        ]);

        // Mobile Skills
        $reactNative = Skill::create([
            'category_id' => $mobile->id,
            'name' => 'React Native',
            'description' => 'Cross-platform mobile development',
            'current_level' => 1,
            'target_level' => 4,
            'importance' => 4,
            'status' => 'learning',
            'started_at' => now()->subMonth(),
        ]);

        // Tools Skills
        $vscode = Skill::create([
            'category_id' => $tools->id,
            'name' => 'VS Code',
            'description' => 'IDE mastery, extensions, shortcuts',
            'current_level' => 4,
            'target_level' => 5,
            'importance' => 4,
            'status' => 'proficient',
            'started_at' => now()->subMonths(24),
        ]);

        $testing = Skill::create([
            'category_id' => $tools->id,
            'name' => 'Testing (PHPUnit, Jest)',
            'description' => 'Unit testing, integration testing, TDD',
            'current_level' => 2,
            'target_level' => 4,
            'importance' => 5,
            'status' => 'learning',
            'started_at' => now()->subMonths(5),
        ]);

        // Add Learning Resources
        LearningResource::create([
            'skill_id' => $react->id,
            'title' => 'React - The Complete Guide',
            'type' => 'course',
            'url' => 'https://www.udemy.com/course/react-the-complete-guide',
            'description' => 'Comprehensive React course covering hooks, context, and more',
            'status' => 'in_progress',
            'rating' => 5,
            'started_at' => now()->subMonths(3),
        ]);

        LearningResource::create([
            'skill_id' => $laravel->id,
            'title' => 'Laravel Documentation',
            'type' => 'documentation',
            'url' => 'https://laravel.com/docs',
            'description' => 'Official Laravel documentation',
            'status' => 'completed',
            'rating' => 5,
            'started_at' => now()->subMonths(15),
            'completed_at' => now()->subMonths(10),
        ]);

        LearningResource::create([
            'skill_id' => $docker->id,
            'title' => 'Docker Mastery',
            'type' => 'course',
            'url' => 'https://www.udemy.com/course/docker-mastery',
            'description' => 'Docker and Kubernetes hands-on course',
            'status' => 'in_progress',
            'started_at' => now()->subMonths(2),
        ]);

        LearningResource::create([
            'skill_id' => $aws->id,
            'title' => 'AWS Certified Solutions Architect',
            'type' => 'course',
            'url' => 'https://aws.amazon.com/certification',
            'description' => 'AWS certification preparation',
            'status' => 'planned',
        ]);

        // Add Practice Sessions
        Practice::create([
            'skill_id' => $react->id,
            'title' => 'Built Todo App with React Hooks',
            'description' => 'Created a full-featured todo application using useState and useEffect',
            'duration_minutes' => 180,
            'practiced_at' => now()->subDays(2),
            'difficulty' => 3,
            'quality_rating' => 4,
            'repository_url' => 'https://github.com/username/react-todo-app',
        ]);

        Practice::create([
            'skill_id' => $laravel->id,
            'title' => 'API Development with Laravel',
            'description' => 'Built RESTful API with authentication',
            'duration_minutes' => 240,
            'practiced_at' => now()->subDays(5),
            'difficulty' => 4,
            'quality_rating' => 5,
            'repository_url' => 'https://github.com/username/laravel-api',
        ]);

        Practice::create([
            'skill_id' => $docker->id,
            'title' => 'Dockerized Laravel App',
            'description' => 'Set up Docker containers for Laravel with Nginx and MySQL',
            'duration_minutes' => 120,
            'practiced_at' => now()->subDays(7),
            'difficulty' => 4,
            'quality_rating' => 3,
        ]);

        Practice::create([
            'skill_id' => $javascript->id,
            'title' => 'Async JavaScript Practice',
            'description' => 'Practiced promises, async/await, and fetch API',
            'duration_minutes' => 90,
            'practiced_at' => now()->subDays(10),
            'difficulty' => 3,
            'quality_rating' => 4,
        ]);

        // Add Milestones
        Milestone::create([
            'skill_id' => $react->id,
            'title' => 'Build First React Project',
            'description' => 'Complete a full React application from scratch',
            'is_completed' => true,
            'target_date' => now()->subMonths(2),
            'completed_at' => now()->subMonths(1),
            'proof_url' => 'https://github.com/username/react-project',
        ]);

        Milestone::create([
            'skill_id' => $laravel->id,
            'title' => 'Deploy Laravel App to Production',
            'description' => 'Successfully deploy a Laravel application',
            'is_completed' => true,
            'target_date' => now()->subMonths(6),
            'completed_at' => now()->subMonths(5),
        ]);

        Milestone::create([
            'skill_id' => $docker->id,
            'title' => 'Master Docker Compose',
            'description' => 'Create multi-container applications',
            'is_completed' => false,
            'target_date' => now()->addMonth(),
        ]);

        Milestone::create([
            'skill_id' => $aws->id,
            'title' => 'AWS Certification',
            'description' => 'Pass AWS Solutions Architect Associate exam',
            'is_completed' => false,
            'target_date' => now()->addMonths(6),
        ]);

        // Add Goals
        Goal::create([
            'title' => 'Master React and Build 5 Projects',
            'description' => 'Become proficient in React by building various types of applications',
            'type' => 'quarterly',
            'status' => 'in_progress',
            'priority' => 5,
            'start_date' => now()->subMonths(2),
            'target_date' => now()->addMonth(),
            'progress_percentage' => 60,
        ]);

        Goal::create([
            'title' => 'Learn DevOps Fundamentals',
            'description' => 'Master Docker, CI/CD, and AWS basics',
            'type' => 'yearly',
            'status' => 'in_progress',
            'priority' => 4,
            'start_date' => now()->subMonths(3),
            'target_date' => now()->addMonths(9),
            'progress_percentage' => 30,
        ]);

        Goal::create([
            'title' => 'Contribute to Open Source',
            'description' => 'Make meaningful contributions to 3 open source projects',
            'type' => 'yearly',
            'status' => 'planned',
            'priority' => 3,
            'start_date' => now(),
            'target_date' => now()->addYear(),
            'progress_percentage' => 0,
        ]);

        Goal::create([
            'title' => 'Build Full-Stack Portfolio',
            'description' => 'Create a comprehensive portfolio showcasing full-stack skills',
            'type' => 'career',
            'status' => 'in_progress',
            'priority' => 5,
            'start_date' => now()->subMonth(),
            'target_date' => now()->addMonths(3),
            'progress_percentage' => 25,
        ]);

        Goal::create([
            'title' => 'Practice Coding Daily',
            'description' => 'Dedicate at least 2 hours daily to coding practice',
            'type' => 'daily',
            'status' => 'in_progress',
            'priority' => 5,
            'start_date' => now()->subMonths(2),
            'target_date' => now()->addYear(),
            'progress_percentage' => 70,
        ]);

        Goal::create([
            'title' => 'Complete 2 Udemy Courses',
            'description' => 'Finish React and Docker courses this month',
            'type' => 'monthly',
            'status' => 'in_progress',
            'priority' => 4,
            'start_date' => now()->startOfMonth(),
            'target_date' => now()->endOfMonth(),
            'progress_percentage' => 50,
        ]);
    }
}
