# Personal Skill Tracking App with Laravel Filament

A comprehensive skill tracking application built with Laravel and Filament for aspiring full-stack software engineers. Track your skills, learning resources, practice sessions, milestones, and goals all in one place.

## Features

### 📚 Skill Management
- Organize skills into categories (Frontend, Backend, Database, DevOps, Mobile, Tools)
- Track current and target proficiency levels (0-5 scale)
- Monitor learning status and progress
- Set importance levels for prioritization

### 📖 Learning Resources
- Track courses, books, videos, articles, tutorials, and documentation
- Monitor learning status (planned, in progress, completed, abandoned)
- Rate resources for future reference
- Store URLs for easy access

### 💻 Practice Sessions
- Log coding practice sessions with duration
- Rate difficulty and quality of practice
- Link to repositories or projects
- Track practice patterns over time

### 🎯 Milestones
- Set skill-specific achievement goals
- Track completion status
- Store proof (certificates, projects)
- Monitor target dates

### 🏆 Goals
- Create daily, weekly, monthly, quarterly, yearly, and career goals
- Track progress percentage
- Monitor deadlines and overdue items
- Prioritize goals effectively

### 📊 Dashboard Widgets
- Overall statistics overview
- Skills distribution by level chart
- Practice time tracking (last 30 days)
- Category-wise progress table
- Recent practice sessions
- Upcoming goals and deadlines

## Installation

### Requirements
- PHP 8.1 or higher
- Composer
- MySQL/PostgreSQL
- Node.js & NPM

 
 
  **Configure database in `.env`:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=skill_tracker
DB_USERNAME=root
DB_PASSWORD=
```

  **Start the development server:**
```bash
php artisan serve
```

 
 **Access the application:**
    Navigate to `http://localhost:8000/admin` and login with your Filament user credentials.

## Usage Guide

### Getting Started

1. **Set Up Categories:**
    - Navigate to "Skill Categories"
    - Create categories like Frontend, Backend, Database, etc.
    - Assign colors and icons for visual organization

2. **Add Skills:**
    - Go to "Skills"
    - Create individual skills under appropriate categories
    - Set current level, target level, and importance
    - Update status as you progress

3. **Track Learning Resources:**
    - Add courses, books, and tutorials you're using
    - Mark status as you progress through them
    - Rate completed resources for future reference

4. **Log Practice Sessions:**
    - Record your coding practice sessions
    - Track duration, difficulty, and quality
    - Link to GitHub repositories or projects

5. **Set Milestones:**
    - Define achievement goals for each skill
    - Track completion status
    - Add proof URLs (certificates, projects)

6. **Create Goals:**
    - Set short-term and long-term goals
    - Monitor progress with percentage tracking
    - Keep an eye on deadlines

### Dashboard Overview

The dashboard provides:
- **Statistics Cards:** Total skills, practice hours, active resources, goals
- **Charts:** Skills by level, practice time trends
- **Tables:** Category progress, recent practices, upcoming goals

### Best Practices

1. **Regular Updates:**
    - Log practice sessions immediately after completion
    - Update skill levels as you gain proficiency
    - Review and adjust goals monthly

2. **Balanced Learning:**
    - Track both theoretical learning (resources) and practical application (practice)
    - Set realistic milestones to maintain motivation
    - Prioritize skills based on career goals

3. **Progress Monitoring:**
    - Review dashboard weekly
    - Adjust learning strategies based on practice quality ratings
    - Celebrate completed milestones

## Skill Level Guide

- **0 - Not Started:** No knowledge of the skill
- **1 - Beginner:** Basic understanding, following tutorials
- **2 - Elementary:** Can build simple projects with guidance
- **3 - Intermediate:** Can build projects independently
- **4 - Advanced:** Strong proficiency, can solve complex problems
- **5 - Expert:** Mastery level, can teach others

 

## Technology Stack

- **Framework:** Laravel 
- **Admin Panel:** Filament  
- **Database:** MySQL/PostgreSQL
- **Frontend:** Livewire, Alpine.js, Tailwind CSS

 

## Contributing

Feel free to customize this application for your personal needs. Some ideas:
- Add integration with GitHub to auto-track repositories
- Implement time tracking with Pomodoro technique
- Add spaced repetition reminders for skills
- Create mobile app version
- Add team collaboration features

## License

MIT License

## Support

For Laravel documentation: https://laravel.com/docs
For Filament documentation: https://filamentphp.com/docs

---

Happy Coding! 🚀 Track your journey to becoming a full-stack software engineer!
